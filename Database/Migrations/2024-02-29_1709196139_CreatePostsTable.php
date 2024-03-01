<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreatePostsTable implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE posts (
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                reply_to_id BIGINT NULL,
                img TEXT NULL,
                subject VARCHAR(255) NULL,
                content TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return [
            "DROP TABLE posts"
        ];
    }
}