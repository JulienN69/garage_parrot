<?php

namespace App\Repository;

use App\Entity\CarPictures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarPictures>
 *
 * @method CarPictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarPictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarPictures[]    findAll()
 * @method CarPictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarPicturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarPictures::class);
    }

//    /**
//     * @return CarPictures[] Returns an array of CarPictures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarPictures
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
