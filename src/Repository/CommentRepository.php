<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Service\CommentApiService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{

    private $commentApiService;

    public function __construct(ManagerRegistry $registry, CommentApiService $commentApiService)
    {
        $this->commentApiService = $commentApiService;
        parent::__construct($registry, Comment::class);
    }

    // get all comments form specific post
    // id is the post id 
    public function getAll(string $id) 
    {

        return $this->commentApiService->getAllComments($id);
    }

    // create new comment for specific post
    // id is the post id 
    public function newComment(string $id, Comment $com) 
    {

        return $this->commentApiService->newComment($id, $com);
    }
}