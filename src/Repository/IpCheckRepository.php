<?php

namespace App\Repository;

use App\Entity\IpCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping as ORM;

class IpCheckRepository extends ServiceEntityRepository implements IpCheckRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpCheck::class);
    }

    public function add(IpCheck $ipCheck): IpCheck
    {
        $current = $this->getByIp($ipCheck->getIp());
        if (null != $current) {
            return $current;
        }

        $this->getEntityManager()->persist($ipCheck);
        $this->getEntityManager()->flush();

        return $ipCheck;
    }

    public function getByIp(string $ip): ?IpCheck
    {
        return $this->findOneByIp($ip);
    }

    public function getIpChecks(): Collection
    {
        $queryBuilder = $this->createQueryBuilder('ip_check');

        return new ArrayCollection($queryBuilder->getQuery()->getResult());
    }
}
