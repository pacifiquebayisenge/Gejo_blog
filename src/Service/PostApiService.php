<?php

namespace App\Service;

use App\Entity\Post;
use Laminas\Code\Reflection\FunctionReflection;
use Symfony\Contracts\HttpClient\HttpClientInterface;


// APi service to consume the api 
class PostApiService
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

      
        // convert response to array
        $data = $response->toArray();

        // empty array where the Post object will be pushed
        $postArr = [];

        /*
        * for each array element 
        * create a new Post instance
        * get all properties
        * push it to the Post array
        */
        foreach($data as $object) {
            $pos = new Post();
            $pos->setId($object["id"]);
            $pos->setUserId($object["userId"]);
            $pos->setTitle($object["title"]);
            $pos->setBody($object["body"]);
            array_push($postArr, $pos);
        }

        return $postArr;

       
        
    }


    // get all blog posts
    public function getAllPosts() {

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