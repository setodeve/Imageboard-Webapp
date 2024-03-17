<?php

namespace Database\Seeds;

use Database\AbstractSeeder;

class PostsSeeder extends AbstractSeeder {
    protected ?string $tableName = 'posts';
    protected array $tableColumns = [
        [
            'data_type' => 'int',
            'column_name' => 'reply_to_id'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'img'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'subject'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'content'
        ]
    ];

    public function createRowData(): array {
        $count = 0;
        while ($count < 5){
          $ary[] = [
            1,
            'test.png',
            '',
            'test'
          ];
          $count++;
        }
        $count = 0;
        while ($count < 5){
            $ary[] = [
              $count+1,
              '',
              '',
              'test'
            ];
            $count++;
          }
        return $ary;
    }
}