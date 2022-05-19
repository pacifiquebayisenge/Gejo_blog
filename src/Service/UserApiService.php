<?php

namespace App\Service;

use App\Entity\Comment;
use Laminas\Code\Reflection\FunctionReflection;
use Symfony\Contracts\HttpClient\HttpClientInterface;


// APi service to consume the api 
class UserApiService
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
            'https://jsonplaceholder.typicode.com/comments?' . $var
        );

      
        // convert response to array
        $data = $response->toArray();

        // empty array where the Comment object will be pushed
        $commentArr = [];

        /*
        * for each array element 
        * create a new Comment instance
        * get all properties
        * push it to the Comment array
        */
        foreach($data as $object) {
            $com = new Comment();
            $com->setPostId($object["postId"]);
            $com->setId($object["id"]);
            $com->setName($object["name"]);
            $com->setEmail($object["email"]);
            $com->setBody($object["body"]);
            array_push($commentArr, $com);
        }

        return $commentArr;

    }


    // get all comments
    public function getAllComments($id):array {
        return  $this->getApi('comments?postId=' . $id);
    }

 
}