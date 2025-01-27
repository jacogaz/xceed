<?php

namespace App\Domain;

final class Tweet
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function toUpperCase(): string {
        return strtoupper($this->text);
    }
}
