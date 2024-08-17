<?php

namespace App\Domain;

interface TweetRepository
{
    public function searchByUserName(string $username, int $limit): array;
}
