<?php

namespace App\Command;

use App\Service\RoverControllerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RoverControllerCommand extends Command
{

    private RoverControllerService $controllerService;

    public function __construct(RoverControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
        parent::__construct();
    }


    protected static $defaultName = 'rover:control';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Start Discovering ...');
        $this->controllerService->process($io);
        return 1;
    }

}