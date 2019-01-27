<?php

namespace App\Repository;

use App\Entity\IpCheckResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping as ORM;

class IpCheckResultRepository extends ServiceEntityRepository implements IpCheckResultRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpCheckResult::class);
    }

    public function add(IpCheckResult $ipCheckResult): void
    {
        $this->getEntityManager()->persist($ipCheckResult);
        $this->getEntityManager()->flush();
    }

    public function getLatestResults(int $limit): Collection
    {
        $queryBuilder = $this->createQueryBuilder('result');

        $queryBuilder
            ->innerJoin('result.ipCheck', 'ipCheck')
            ->orderBy('result.checkedAt', 'DESC')
            ->setMaxResults($limit);

        return new ArrayCollection($queryBuilder->getQuery()->getResult());
    }
}
