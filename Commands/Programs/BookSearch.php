<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class BookSearch extends AbstractCommand
{
    protected static ?string $alias = 'book';

    public static function getArguments(): array
    {
        return [
          (new Argument('isbn'))->description('search by book isbn')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $url = 'https://openlibrary.org/isbn/9780140328721.json';
        $options = array(
          'http' => array(
              'method'=> 'GET',
              'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
          )
        );
        $mysqli = new MySQLWrapper();
        $context = stream_context_create($options);

        $isbn = $this->getArgumentValue('isbn');

        if ($isbn==true){
          $select =  "select * from books where isbn = " . $isbn . ";";
          $res = $mysqli->query($select);
          $res_arr = $res->fetch_array(MYSQLI_NUM);

          if ($res_arr != NULL){
            $this->log('Already Had Data');
          }else{
            $url = 'https://openlibrary.org/isbn/'. $isbn .'.json';
            $raw_data = file_get_contents($url, false, $context);
            $data = json_decode($raw_data,true);

            $title = $data["title"];
            $insert =  "INSERT INTO books (title, isbn) VALUES ('$title', $isbn);";
            $mysqli->query($insert);

            $this->log('Newly Inserted Data');
          };

        }else{

        }

        return 0;
    }
}