<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Service\ApiService;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    private $postRepository;

    
    
   public function __construct(PostRepository $postRepository)
   {
       $this->postpostRepository = $postRepository;
   }




    /**
     * @Route("/posts/{id}", name="app_post")
     */
    public function index(  EntityManager $em, string $id): Response
    {
        
        
        $repo = $em->getRepository(Post::class);
        $posts = $repo->findAll();

        dd($posts);


        // return $this->render('post/index.html.twig', [
        //     // specific post
        //     'data' => $apiService->getPostById($id),
        //     // all comments for that specific post
        //     'comments' => $apiService->getAllComments($id),
        //     // all authors to look for the right one
        //     'authors' => $apiService->getAllAuthors()
        // ]);
    }


    
}
