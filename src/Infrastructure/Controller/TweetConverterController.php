<?php

namespace App\Infrastructure\Controller;

use App\Application\TweetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TweetConverterController extends AbstractController
{
    public function __construct(private TweetService $tweetService) {
    }

    /**
     * @Route("/tweets/{userName}", methods={"GET"})
     *
     * @param Request                 $request
     * @param                         $userName
     *
     * @return JsonResponse
     */
    public function index(Request $request, $userName):  JsonResponse
    {
        $limit = (int) $request->query->get('limit', 10);

        try {
            $tweets = $this->tweetService->getTweets($userName, $limit);
            return new JsonResponse($tweets);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
