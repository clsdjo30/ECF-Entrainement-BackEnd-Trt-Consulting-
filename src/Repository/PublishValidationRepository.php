<?php

namespace App\Repository;

use App\Entity\PublishValidation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PublishValidation>
 *
 * @method PublishValidation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublishValidation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublishValidation[]    findAll()
 * @method PublishValidation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishValidationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublishValidation::class);
    }

    public function add(PublishValidation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PublishValidation $entity, bool $flush = false): void
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
            ->where('val.announceIsValid = true')
            ->select('COUNT(val.id) as value');

        return $totalPendingAnnounce->getQuery()->getSingleScalarResult();
    }
}
