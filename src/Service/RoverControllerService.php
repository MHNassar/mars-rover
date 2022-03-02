<?php

namespace App\Service;

use App\Core\ControlFunctions\InputParser;
use App\Core\ControlFunctions\RoverControllerManager;
use Symfony\Component\Console\Style\SymfonyStyle;

class RoverControllerService
{

    private InputParser $parser;
    private RoverControllerManager $roverManager;
    public function __construct(InputParser $parser,RoverControllerManager $roverManager) {
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
        $this->roverManager->setPlateau($input->plateau);
        foreach ($input->rovers as $rover){
            $this->roverManager->setRover($rover);
            $this->roverManager->control();
            $roverLocation = $this->roverManager->getRover()->getLocation();
            $output[] = ['rover'.$index++, sprintf('%s %s %s',$roverLocation->coordinatePoint->xAxis, $roverLocation->coordinatePoint->yAxis, $roverLocation->direction)];
            $io->progressAdvance();
        }
        $io->progressFinish();
        $io->table(['Rover Name','co-ordinates and heading'],$output);
        $io->success('Done!!');
    }
}