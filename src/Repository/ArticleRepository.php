<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * Returns an array of article object according by category
     *
     * @param [type] $value
     * @param [type] $limit
     *
     * @return void
     */
    public function findByCategory($value, $limit)
    {
        return $this->createQueryBuilder('a')
            ->join('a.category', 'c')
            ->where('c.name = :cat')
            ->setParameter('cat', $value)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the last Article
     *
     * @param [type] $value
     *
     * @return void
     */
    public function findByLast($value)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($value)
            ->getQuery()
            ->getResult();
    }
}
