<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
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

class CommentController extends AbstractController
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
     * @Route("/comment/create/postId/{id}", name="app_post_create")
     */
    public function index( string $id): Response
    {
        $comment = new Comment();
        
        $response = $this->commentRepository->newComment($id);
       


        return $this->render('comment/index.html.twig', [
           
            'response' => $response
        ]);
    }


    
}
