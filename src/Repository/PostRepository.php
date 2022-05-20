<?php

namespace App\Repository;

use App\Entity\Post;
use App\Service\PostApiService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
  
    private $postApiService;


    public function __construct(ManagerRegistry $registry , PostApiService $postApiService)
    {
       $this->postApiService = $postApiService;
        parent::__construct($registry, Post::class);
    }

    
    public function getAll() 
    {

        return $this->postApiService->getAllPosts();
    }

    public function getById(string $id) 
    {

        return $this->postApiService->getPostById($id);
    }

}
