<?php

namespace App\Repository;

use App\Entity\Aeroport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aeroport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aeroport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aeroport[]    findAll()
 * @method Aeroport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AeroportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aeroport::class);
    }

    /**
     * Get all user query, using for pagination
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function queryForSearch($filters = array())
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.nom', 'asc');

        if (count($filters) > 0) {
            foreach ($filters as $key => $filter) {
                if($key == 'date'){
//TODO ajouter filtre custom datetime

                }
                else{
                    $qb->andWhere('e.'.$key.' LIKE :'.$key);
                    $qb->setParameter($key, '%'.$filter.'%');
                }

            }
        }

        return $qb->getQuery();
    }
}
