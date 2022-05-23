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

   
    private $commentRepository;

    
    
   public function __construct(PostRepository $postRepository, UserRepository $userRepository, CommentRepository $commentRepository)
   {
      $this->commentRepository = $commentRepository;
   }


   

    /**
     * @Route("/comment/create/postId/{id}", name="app_post_create")
     */
    public function index( string $id, Request $request): Response
    {
       
        
        $response = null;

        $com = new Comment();
       

        // create form ojcet
        $form = $this->createForm( CommentFormType::class, $com);
        
        $form->handleRequest($request);

        // form submitted
        if ($form->isSubmitted() && $form->isValid()) {
            
            $com = $form->getData();


           
            $response = $this->commentRepository->newComment($id, $com);

            // laad result pagina 
            return $this->redirectToRoute("result", array('postId' => $id, 'status' => $response));
        }

        return $this->render('comment/index.html.twig', [
           
            'response' => $response,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/comment/create/result/postId={postId}%26status={status}", name="app_post_create_result")
     */

     // result  of the reqeust with the netzork status code
    public function result($postId, $status) : Response 
    {
       
        return $this->render('comment/result.html.twig', [
           
           'postId' => $postId,
           'status' => $status
        ]);
    }
    
}
