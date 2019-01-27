<?php

namespace App\Command;

use App\CommandBus\AddIpToCheckCommand;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IpCheckAddCommand extends Command
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    protected function configure(): void
    {
        $this
            ->setName('app:ipcheck:add')
            ->addArgument('ip', InputArgument::REQUIRED);
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
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $command = AddIpToCheckCommand::create($input->getArgument('ip'));

        $errors = $this->validator->validate($command);
        if (count($errors) > 0) {
            $output->writeln(sprintf('<error>%s</error>', (string) $errors));

            return;
        }

        $this->commandBus->handle($command);
    }
}
