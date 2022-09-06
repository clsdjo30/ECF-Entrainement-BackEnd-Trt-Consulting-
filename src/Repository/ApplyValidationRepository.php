<?php

namespace App\Repository;

use App\Entity\ApplyValidation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplyValidation>
 *
 * @method ApplyValidation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplyValidation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplyValidation[]    findAll()
 * @method ApplyValidation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplyValidationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplyValidation::class);
    }

    public function add(ApplyValidation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplyValidation $entity, bool $flush = false): void
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
    public function getNumPendingCandidate()
    {
        $totalPendingAnnounce = $this->createQueryBuilder('val')
            ->where('val.candidateIsValid = true')
            ->select('COUNT(val.id) as value');

        return $totalPendingAnnounce->getQuery()->getSingleScalarResult();
    }
}
