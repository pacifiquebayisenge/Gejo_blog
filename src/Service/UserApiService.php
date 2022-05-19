<?php

namespace App\Service;

use App\Entity\User;
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
            'https://jsonplaceholder.typicode.com/' . $var
        );

      
        // convert response to array
        $data = $response->toArray();

        // empty array where the User object will be pushed
        $userArr = [];

        /*
        * for each array element 
        * create a new User instance
        * get all properties
        * push it to the User array
        */
        foreach($data as $object) {
            $com = new User();
            $com->setId($object["id"]);
            $com->setName($object["name"]);
            $com->setEmail($object["email"]);
            array_push($userArr, $com);
        }

        return $userArr;

    }

    

    // get all users
    public function getAllUsers():array {
        return  $this->getApi('users');
    }

 
}