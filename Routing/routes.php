<?php

use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Database\DataAccess\Implementations\PostDAOImpl;
use Response\Render\JSONRenderer;
use Helpers\DatabaseHelper;

return [
    'posts'=>function(): HTTPRenderer{

        $postDao = new PostDAOImpl();
        $posts = $postDao->getAllThreads();

        $postWithReplies = array();
        if($posts === null){
            header('Location:/no-exist');
            exit;
        }
        foreach($posts as $post){
            $postWithReplies[] = $postDao->getReplies($post);
        }

        return new HTMLRenderer('component/posts', ['posts'=>$postWithReplies]);
    },
    'post'=>function(): HTTPRenderer{
        $id = ValidationHelper::integer($_GET['id']??null);

        $postDao = new PostDAOImpl();
        $post = $postDao->getById($id);

        if($post === null){
            header('Location:/no-exist');
            exit;
        }
        $postWithReplies[] = $postDao->getReplies($post);

        return new HTMLRenderer('component/post', ['post'=>$postWithReplies]);
    },
    'create/post' => function(): HTMLRenderer {
        return new HTMLRenderer('component/create-post',[]);
    },
    'form/create/post' => function() {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $imageName = uniqid('',true) .'-'. $_FILES["img"]["name"];
                $imageOriginal = $_FILES["img"]["name"];
                $extension = substr($imageOriginal, strrpos($imageOriginal, '.') + 1);
                $fileSize = filesize($_FILES["img"]["tmp_name"]);

                if ($fileSize > 20971520){
                  throw new Exception('Over 20Mbyte');
                }
                if(!in_array($extension, ['JPEG', 'jpeg', 'JPG', 'jpg', 'PNG', 'png', 'gif', 'GIF', ""])) {
                  throw new Exception('Not Supporte this extention');
                }

                move_uploaded_file($_FILES["img"]["tmp_name"],"Images/" . $imageName);
                DatabaseHelper::setImage($_POST, $imageName);
                return new JSONRenderer(['status' => 'success', 'message' => 'Post createed successfully']);
              }
        } catch (\InvalidArgumentException $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => 'Invalid data.', 'data'=>$_POST]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => 'An error occurred.', 'data'=>$_FILES]);
        }

    },
    'form/create/reply' => function() {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_FILES["img"]["name"]!=""){
                    $imageName = uniqid('',true) .'-'. $_FILES["img"]["name"];
                    $imageOriginal = $_FILES["img"]["name"];
                    $extension = substr($imageOriginal, strrpos($imageOriginal, '.') + 1);
                    $fileSize = filesize($_FILES["img"]["tmp_name"]);
    
                    if ($fileSize > 20971520){
                      throw new Exception('Over 20Mbyte');
                    }
                    if(!in_array($extension, ['JPEG', 'jpeg', 'JPG', 'jpg', 'PNG', 'png', 'gif', 'GIF',""])) {
                      throw new Exception('Not Supporte this extention');
                    }
                    
                    move_uploaded_file($_FILES["img"]["tmp_name"],"Images/" . $imageName);
                }else{
                    $imageName = null;
                }

                DatabaseHelper::setImage($_POST, $imageName);
                return new JSONRenderer(['status' => 'success', 'message' => 'Post createed successfully']);
              }
        } catch (\InvalidArgumentException $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => 'Invalid data.', 'data'=>$_POST]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return new JSONRenderer(['status' => 'error', 'message' => 'An error occurred.', 'data'=>$_FILES]);
        }
    },
    '404'=>function(): HTTPRenderer{
        return new HTMLRenderer('component/404', []);
    },
    'no-exist'=>function(): HTTPRenderer{
        return new HTMLRenderer('component/no-exist', []);
    },
];