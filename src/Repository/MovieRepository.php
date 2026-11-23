<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * Retourne tous les films avec leur catégorie.
     */
    public function findAllWithCategory(): array
    {
        return $this->createQueryBuilder('movie')
            ->addSelect('category')
            ->leftJoin('movie.category', 'category')
            ->orderBy('movie.releaseDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    public function findOneWithCategory(int $id): ?Movie
    {
        return $this->createQueryBuilder('movie')
            ->addSelect('category')
            ->leftJoin('movie.category', 'category')
            ->where('movie.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}