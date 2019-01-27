<?php

namespace App\Repository;

use App\Entity\IpCheck;
use Doctrine\Common\Collections\Collection;

interface IpCheckRepositoryInterface
{
    public function getByIp(string $ip): ?IpCheck;
    public function add(IpCheck $ipCheck): IpCheck;
    public function getIpChecks(): Collection;
}
