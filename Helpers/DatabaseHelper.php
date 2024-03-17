<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;
class DatabaseHelper
{
    public static function setImage(array $data, string|null $imagePath){
        $db = new MySQLWrapper();
        
        if ($data['reply_to_id']==0){
            $data['reply_to_id']=null;
        }

        $reply_to_id = $data['reply_to_id'];
        if ($imagePath!=null){
            $imagePath = ConvertHelper::encrypt($imagePath);
            $imagePath = htmlspecialchars($imagePath, ENT_QUOTES, "UTF-8");
        }else{
            $imagePath = "";
        }

        if ($data['subject']!=""){
            $subject = htmlspecialchars($data['subject'], ENT_QUOTES, "UTF-8");
        }else{
            $subject = null;
        }

        if ($data['content']!=""){
            $content = htmlspecialchars($data['content'], ENT_QUOTES, "UTF-8");
        }else{
            throw new Exception('content should not be null');
        }

        $stmt = $db->prepare('INSERT INTO posts (reply_to_id, img, subject, content) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('isss', $reply_to_id, $imagePath, $subject, $content);
        $stmt->execute();
    }
}