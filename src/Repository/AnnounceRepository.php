<?php

namespace App\Repository;

use App\Entity\Announce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Announce>
 *
 * @method Announce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announce[]    findAll()
 * @method Announce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnounceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announce::class);
    }

    public function add(Announce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Announce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getNumPendingAnnounce()
    {
        $totalPendingAnnounce = $this->createQueryBuilder('val')
            ->where('val.isValid = true')
            ->select('COUNT(val.id) as value');

        return $totalPendingAnnounce->getQuery()->getSingleScalarResult();
    }

    public function findByRecruiterId($id): void
    {
        $activeAnnounce = $this->createQueryBuilder('an')
            ->where('an.recruiter = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
