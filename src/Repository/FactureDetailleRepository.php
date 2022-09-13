<?php

namespace App\Repository;

use App\Entity\FactureDetaille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FactureDetaille>
 *
 * @method FactureDetaille|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactureDetaille|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactureDetaille[]    findAll()
 * @method FactureDetaille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureDetailleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactureDetaille::class);
    }

    public function add(FactureDetaille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FactureDetaille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FactureDetaille[] Returns an array of FactureDetaille objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FactureDetaille
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
