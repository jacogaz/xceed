<?php

namespace App\Application;

use App\Domain\TweetRepository;

class TweetService {
    private array $cache = [];
    private const CACHETTL = 60;

    public function __construct(private TweetRepository $tweetRepository) {
    }

    public function getTweets(string $username, int $limit): array {
        if ($limit > 10) {
            throw new \InvalidArgumentException('The tweet limit is 10.');
        }

        if (isset($this->cache[$username]) && (time() - $this->cache[$username]['timestamp']) < self::CACHETTL) {
            return $this->cache[$username]['tweets'];
        }

        $tweets = $this->tweetRepository->searchByUserName($username, $limit);
        $tweetsUpper = array_map(fn($tweet) => $tweet->toUpperCase(), $tweets);

        $this->cache[$username] = [
            'tweets' => $tweetsUpper,
            'timestamp' => time()
        ];

        return $tweetsUpper;
    }
}
