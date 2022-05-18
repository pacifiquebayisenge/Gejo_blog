<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

 
 
 


    /**
     * @Route("/home", name="app_home")
     */
    public function index(ApiService $apiService): Response
    {

        

        
        return $this->render('home/index.html.twig', [
            'posts' => $apiService->getAllPosts(),
            'authors' => $apiService->getAllAuthors()
        ]);
    }
}
