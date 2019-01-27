<?php

namespace App\Command;

use App\CommandBus\PerformIpCheckCommand;
use App\Repository\IpCheckRepositoryInterface;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IpCheckPerformCommand extends Command
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var IpCheckRepositoryInterface
     */
    private $repository;

    protected function configure(): void
    {
        $this
            ->setName('app:ipcheck:perform');
    }

    /**
     * @required
     */
    public function setCommandBus(CommandBus $commandBus): void
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @required
     */
    public function setIpCheckRepository(IpCheckRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        foreach ($this->repository->getIpChecks() as $ipCheck) {
            $command = PerformIpCheckCommand::create($ipCheck);
            $this->commandBus->handle($command);
        }
    }
}
