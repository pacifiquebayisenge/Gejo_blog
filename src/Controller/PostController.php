<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
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
    private $userRepository;
    private $commentRepository;

    
    
   public function __construct(PostRepository $postRepository, UserRepository $userRepository, CommentRepository $commentRepository)
   {
       $this->postRepository = $postRepository;
       $this->userRepository = $userRepository;
       $this->commentRepository = $commentRepository;
   }




    /**
     * @Route("/posts/{id}", name="app_post")
     */
    public function index(   string $id): Response
    {
        
        
        $post = $this->postRepository->getById($id);
        $users = $this->userRepository->getAll();
        $comments = $this->commentRepository->getAll($id);
        

       


        return $this->render('post/index.html.twig', [
            // specific post
            'post' => $post,
            // // all comments for that specific post
             'comments' => $comments,
            // // all authors to look for the right one
             'users' => $users
        ]);
    }


    
}
