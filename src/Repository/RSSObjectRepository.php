<?php

namespace App\Repository;

use App\Entity\RSSObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RSSObject>
 *
 * @method RSSObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method RSSObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method RSSObject[]    findAll()
 * @method RSSObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RSSObjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RSSObject::class);
    }

    /**
     * @return RSSObject[] Returns an array of RSSObject objects
     */
    public function findByExampleField(int $user_id): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('u.user_id = :user_id')
            ->setParameter('user_id', $user_id)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?RSSObject
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
