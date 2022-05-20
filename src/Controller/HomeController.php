<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\ApiService;
use Doctrine\ORM\Mapping\PostRemove;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

    private $postRepository;
    private $userRepository;
    
    
    public function __construct(PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function index( ): Response
    {
        // get all posts
        $posts = $this->postRepository->getAll();
        // get all users to find the right one
        $users = $this->userRepository->getAll();
        

        
        
        return $this->render('home/index.html.twig', [
            // all posts
            'posts' => $posts,
            // all authors to look for the right one
            'authors' => $users
        ]);
    }
}
