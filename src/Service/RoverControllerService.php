<?php

namespace App\Service;

use App\Core\ControlFunctions\InputParser;
use App\Core\ControlFunctions\IRoverController;
use App\Core\ControlFunctions\RoverController;
use Symfony\Component\Console\Style\SymfonyStyle;

class RoverControllerService
{

    const COMMANDS_FUNC = [
        'L' => 'spinLeft',
        'R' => 'spinRight',
        'M' => 'move',
    ];

    private InputParser $parser;

    private IRoverController $roverManager;

    public function __construct(InputParser $parser, RoverController $roverManager) {
        $this->parser = $parser;
        $this->roverManager = $roverManager;
    }

    /**
     * @throws \Exception
     */
    public function processRover(SymfonyStyle $io)
    {
        $input = $this->parser->parseFile();
        $io->progressStart(count($input->rovers));
        $output = [];
        $index = 1;
        $this->roverManager->connectPlateau($input->plateau);
        foreach ($input->rovers as $rover){
            $this->roverManager->connectRover($rover);
            $commands = $rover->getOrders();
            foreach ($commands as $commandLitter)
            {
                $functionName = self::COMMANDS_FUNC[$commandLitter];
                $this->roverManager->$functionName();
            }

            $output[] =  $this->roverManager->getRover()->getOutputString($index++);

            $io->progressAdvance();
        }

        $io->progressFinish();

        $io->table(['Rover Name','co-ordinates and heading'],$output);

        $io->success('Done!!');
    }
}