<?php

namespace App\Repository;

use App\Entity\Courses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Courses>
 *
 * @method Courses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Courses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Courses[]    findAll()
 * @method Courses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Courses::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Courses $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Courses $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
      * @return Courses[] 
    */
    public function sortByIdAsc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Courses[] 
    */
    public function sortByIdDesc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.id', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }
    
    /**
      * @return Courses[] 
    */
    public function sortByStartDateAsc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.startDate', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Courses[] 
    */
    public function sortByStartDateDesc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.startDate', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Courses[] 
    */
    public function sortByEndDateAsc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.endDate', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Courses[] 
    */
    public function sortByEndDateDesc()
    {
        return $this->createQueryBuilder('c')
                    ->orderBy('c.endDate', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
     * @return Courses[]
     */
    public function searchByName($keyword)  
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :value')
            ->setParameter('value', '%' . $keyword . '%')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Courses[] Returns an array of Courses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Courses
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
