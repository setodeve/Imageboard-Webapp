<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Post implements Model {
    use GenericModel;

    public function __construct(
        private ?int $id = null,
        private ?int $reply_to_id = null,
        private ?string $subject = null,
        private ?string $img = null,
        private ?string $content = null,
        private ?DataTimeStamp $timeStamp = null,
    ) {}

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getReplyId(): ?int {
        return $this->reply_to_id;
    }

    public function setReplyId(int $id): void {
        $this->reply_to_id = $id;
    }
    public function getSubject(): string {
        return $this->subject;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }
    public function getImg(): string {
        return $this->img;
    }
    public function setImg(string $img): void {
        $this->img = $img;
    }
    public function getContent(): string {
        return $this->content;
    }
    public function setContent(string $content): void {
        $this->content = $content;
    }
    public function getTimeStamp(): ?DataTimeStamp
    {
        return $this->timeStamp;
    }
    public function setTimeStamp(DataTimeStamp $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }
}