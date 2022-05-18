<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/posts/{id}", name="app_post")
     */
    public function index(ApiService $apiService, string $id): Response
    {
        return $this->render('post/index.html.twig', [
            // specific post
            'data' => $apiService->getPostById($id),
            // all comments for that specific post
            'comments' => $apiService->getAllComments($id),
            // all authors to look for the right one
            'authors' => $apiService->getAllAuthors()
        ]);
    }
}
