<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index( string $id): Response
    {
        
        // get specific post
        $post = $this->postRepository->getById($id);

        // get all users to find the right one
        $users = $this->userRepository->getAll();

        // get all commments for the specific post 
        $comments = $this->commentRepository->getAll($id);
        

       


        return $this->render('post/index.html.twig', [
            // specific post
            'post' => $post,
             // all comments for that specific post
             'comments' => $comments,
            // // all authors to look for the right one
             'users' => $users
        ]);
    }


    
}
