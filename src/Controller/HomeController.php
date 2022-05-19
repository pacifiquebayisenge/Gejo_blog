<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Service\ApiService;
use Doctrine\ORM\Mapping\PostRemove;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

    
    
    
    public function __construct(PostRepository $postRepository)
    {
        $this->postpostRepository = $postRepository;
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function index( PostRepository $postRepository): Response
    {

        $posts = $postRepository->getAll();
        
        dd($posts);
        // return $this->render('home/index.html.twig', [
        //     // all posts
        //     'posts' => $apiService->getAllPosts(),
        //     // all authors to look for the right one
        //     'authors' => $apiService->getAllAuthors()
        // ]);
    }
}
