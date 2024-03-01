<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
    public static function getRandomComputerPart(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getComputerPartById(int $id): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part) throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function setImage(array $data,string $imagePath){
        $db = new MySQLWrapper();
        
        $reply_to_id = htmlspecialchars($data['reply_to_id'], ENT_QUOTES, "UTF-8");
        $imagePath = htmlspecialchars($imagePath, ENT_QUOTES, "UTF-8");
        $subject = htmlspecialchars($data['subject'], ENT_QUOTES, "UTF-8");
        $content = htmlspecialchars($data['content'], ENT_QUOTES, "UTF-8");

        $stmt = $db->prepare('INSERT INTO posts (reply_to_id, img, subject, content) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('isss', $reply_to_id, $imagePath, $subject, $content);
        $stmt->execute();
    }

}