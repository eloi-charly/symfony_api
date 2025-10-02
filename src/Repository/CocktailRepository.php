<?php

namespace App\Repository;

use App\Dto\CocktailQueryDto;
use App\Entity\Cocktail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cocktail>
 */
class CocktailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cocktail::class);
    }

    public function findAllWithQuery(CocktailQueryDto $query ){
        $qb = $this->createQueryBuilder('cocktail');
        
         if ($query->name) {
            $qb
                ->andWhere('cocktail.name LIKE :name')
                ->setParameter('name', "%$query->name%");
        }

        if (null !== $query->isAlcoholic) {
            $qb
                ->andWhere('cocktail.isAlcoholic = :isAlcoholic')
                ->setParameter('isAlcoholic', $query->isAlcoholic);
        }

        if ($query->difficulty) {
            $qb
                ->andWhere('cocktail.difficulty = :difficulty')
                ->setParameter('difficulty', $query->difficulty);
        }

        $offset = ($query->page - 1) * $query->itemsPerPage;

        $qb
            ->setFirstResult($offset)
            ->setMaxResults($query->itemsPerPage);

        return $qb->getQuery()->getResult();
    }
}
