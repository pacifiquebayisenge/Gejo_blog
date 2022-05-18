<?php

namespace App\Service;

use Laminas\Code\Reflection\FunctionReflection;
use Symfony\Contracts\HttpClient\HttpClientInterface;

// APi service to consume the api 
class ApiService
{
    private $client;

    // constructor
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    // private baseURl method
    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/' . $var
        );
        return $response->toArray();
    }


    // get all blog posts
    public function getAllPosts():array {
        return  $this->getApi('posts');
    }
    
    // get post by id 
    public function getPostById( $id):array {
        
        return  $this->getApi('posts/' . $id);
    }


    // get all comments
    public function getAllComments($id):array {
        return  $this->getApi('comments?postId=' . $id);
    }


    // get all authors
    public function getAllAuthors():array {
        return  $this->getApi('users');
    }

    



    
   
 
}