<?php

namespace App\Repository;

use App\Entity\Dormitory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dormitory>
 *
 * @method Dormitory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dormitory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dormitory[]    findAll()
 * @method Dormitory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DormitoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dormitory::class);
    }

//    /**
//     * @return Dormitory[] Returns an array of Dormitory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dormitory
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
