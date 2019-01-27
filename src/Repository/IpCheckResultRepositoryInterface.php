<?php

namespace App\Repository;

use App\Entity\IpCheckResult;
use Doctrine\Common\Collections\Collection;

interface IpCheckResultRepositoryInterface
{
    public function add(IpCheckResult $ipCheckResult): void;
    public function getLatestResults(int $limit): Collection;
}
