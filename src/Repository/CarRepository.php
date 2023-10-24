<?php

namespace App\Repository;

use App\Entity\Car;
use App\Data\SearchCarData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{

    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Car::class);
        $this->paginator = $paginator;
    }

    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

// récupère les voitures selon les paramètres d'une recherche

    // public function findByYear($year)
    // {
    //     $qb = $this->createQueryBuilder('c');
    //     $qb->andWhere($qb->expr()->eq("YEAR(c.dateCreation)", ":year"));
    //     $qb->setParameter("year", $year);

    //     return $qb->getQuery()->getResult();
    // }

    public function findSearch(SearchCarData $search):PaginationInterface
    {
        $query= $this
            ->createQueryBuilder('car');

        if(!empty($search->getPriceMin())){
            $query = $query
                ->andWhere('car.price >= :priceMin')
                ->setParameter('priceMin', $search->getPriceMin());
        }
        if(!empty($search->getPriceMax())){
            $query = $query
                ->andWhere('car.price <= :priceMax')
                ->setParameter('priceMax', $search->getPriceMax());
        }

        if(!empty($search->getMilesMin())){
            $query = $query
                ->andWhere('car.mileage >= :milesMin')
                ->setParameter('milesMin', $search->getMilesMin());
        }
        if(!empty($search->getMilesMax())){
            $query = $query
                ->andWhere('car.mileage <= :milesMax')
                ->setParameter('milesMax', $search->getMilesMax());
        }

        if(!empty($search->getYearMin())){
            $query = $query
                ->andWhere('YEAR(car.dateCreation) >= :yearMin')
                ->setParameter('yearMin', $search->getYearMin());
        }
        if(!empty($search->getYearMax())){
            $query = $query
                ->andWhere('YEAR(car.dateCreation) <= :yearMax')
                ->setParameter('yearMax', $search->getYearMax());
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            9
        );
    }
//    /**
//     * @return Car[] Returns an array of Car objects
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

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
