<?php

namespace Database\DataAccess\Implementations;

use Database\DataAccess\Interfaces\PostDAO;
use Database\DatabaseManager;
use Models\Post;
use Models\DataTimeStamp;

class PostDAOImpl implements PostDAO
{
    public function create(Post $post): bool
    {
        if($post->getId() !== null) throw new \Exception('Cannot create a post with an existing ID. id: ' . $post->getId());
        return $this->createOrUpdate($post);
    }

    public function getById(int $id): ?Post
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        $post = $mysqli->prepareAndFetchAll("SELECT * FROM posts WHERE id = ?",'i',[$id])[0]??null;

        return $post === null ? null : $this->resultToPost($post);
    }

    public function update(Post $post): bool
    {
        if($post->getId() === null) throw new \Exception('Computer part specified has no ID.');

        $current = $this->getById($post->getId());
        if($current === null) throw new \Exception(sprintf("Computer part %s does not exist.", $post->getId()));

        return $this->createOrUpdate($post);
    }

    public function delete(int $id): bool
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        return $mysqli->prepareAndExecute("DELETE FROM posts WHERE id = ?", 'i', [$id]);
    }

    public function getAllThreads(): array
    {
        $mysqli = DatabaseManager::getMysqliConnection();

        $query = "SELECT * FROM posts WHERE reply_to_id IS NULL";

        $results = $mysqli->prepareAndFetchAllWithout($query);

        return $results === null ? [] : $this->resultsToPosts($results);
    }
    public function getReplies(Post $post): array
    {
        $mysqli = DatabaseManager::getMysqliConnection();
        $query = "SELECT * FROM posts WHERE reply_to_id = ?";
        $replys = $mysqli->prepareAndFetchAll($query, 'i', [$post->getId()]);
        
        $replys = $replys === null ? [] : $this->resultsToPosts($replys);

        $Replys = array();
        $Replys[] = $post;

        foreach($replys as $reply){
            if($post->getId() === $reply->getReplyId()){
                $Replys[] = $reply;
            }
        }

        return $Replys;
    }
    public function createOrUpdate(Post $postData): bool
    {
        $mysqli = DatabaseManager::getMysqliConnection();

        $query =
        <<<SQL
            INSERT INTO posts (reply_to_id, subject, img, content)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            reply_to_id = VALUES(reply_to_id),
            subject = VALUES(subject),
            img = VALUES(img),
            content = VALUES(content),
            ;
        SQL;

        $result = $mysqli->prepareAndExecute(
            $query,
            'isss',
            [
                $postData->getReplyId(),
                $postData->getSubject(),
                $postData->getImg(),
                $postData->getContent()
            ],
        );

        if(!$result) return false;

        if($postData->getId() === null){
            $postData->setId($mysqli->insert_id);
            $timeStamp = $postData->getTimeStamp()??new DataTimeStamp(date('Y-m-h'), date('Y-m-h'));
            $postData->setTimeStamp($timeStamp);
        }

        return true;
    }

    private function resultToPost(array $data): Post{
        return new Post(
            id: $data['id'],
            reply_to_id: $data['reply_to_id'],
            subject: $data['subject'],
            img: $data['img'],
            content: $data['content'],
            timeStamp: new DataTimeStamp($data['created_at'], $data['updated_at'])
        );
    }

    private function resultsToPosts(array $results): array{
        $Posts = [];

        foreach($results as $result){
            $Posts[] = $this->resultToPost($result);
        }

        return $Posts;
    }
}