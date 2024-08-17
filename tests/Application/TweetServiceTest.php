<?php
namespace App\Tests\Application;

use PHPUnit\Framework\TestCase;
use App\Application\TweetService;
use App\Infrastructure\Persistence\TweetRepositoryInMemory;

class TweetServiceTest extends TestCase {
    public function testGetTweetsReturnsUppercaseTweets() {
        $tweetRepository = new TweetRepositoryInMemory();
        $tweetService = new TweetService($tweetRepository);

        $tweets = $tweetService->getTweets('testUser', 2);
        $this->assertCount(2, $tweets);
        $this->assertEquals(strtoupper($tweets[0]), $tweets[0]);
    }

    public function testLimitValidation() {
        $this->expectException(\InvalidArgumentException::class);

        $tweetRepository = new TweetRepositoryInMemory();
        $tweetService = new TweetService($tweetRepository);

        $tweetService->getTweets('testUser', 11);
    }
}
