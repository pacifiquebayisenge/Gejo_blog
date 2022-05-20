<?php

namespace App\Repository;

use App\Entity\User;
use App\Service\UserApiService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    private $userApiService;

    public function __construct(ManagerRegistry $registry,  UserApiService $userApiService)
    {
        $this->userApiService = $userApiService;
        parent::__construct($registry, User::class);
    }



    public function getAll() 
    {

        return $this->userApiService->getAllUsers();
    }


    
}
