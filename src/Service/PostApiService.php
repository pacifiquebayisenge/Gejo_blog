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

    // private baseURl  GET method
    private function getApi(string $var) 
    {
        $response = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/' . $var
        );

      
        // convert response to array
        $data = $response->toArray();

        return $data;

    }

    private function postApi() 
    {
        $body  = '{
            "id": 101,
    "title": "foo",
    "body": "bar",
    "userId": 1
        }';
        $response = $this->client->request(
            'POST',
            'https://jsonplaceholder.typicode.com/posts' ,
            [
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' =>  json_encode($body)
             
            ]
        );

      
        $content = $response->getHeaders()['content-type'][0];


        return $content;

    }


    // get all blog posts
    public function getAllPosts() {


        // convert response to array
        $data = $this->getApi('posts');


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

        return  $postArr;
        
    }
    
    // get post by id 
    public function getPostById( $id):array {
        $result =  $this->getApi('posts/' . $id);

        

        return $result;
    }


    // create new post
    public function newPost() {
        $result =  $this->postApi();
    }
 
}