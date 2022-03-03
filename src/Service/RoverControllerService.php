<?php

namespace App\Service;

use App\Core\ControlFunctions\IRoverController;
use App\Core\ControlFunctions\RoverController;
use App\Core\InputParser\InputFileParser;
use App\Core\InputParser\IParser;
use League\Flysystem\FilesystemException;
use Symfony\Component\Console\Style\SymfonyStyle;

class RoverControllerService
{

    const COMMANDS_FUNC = [
        'L' => 'spinLeft',
        'R' => 'spinRight',
        'M' => 'move',
    ];

    private IParser $parser;

    private IRoverController $roverManager;

    public function __construct(InputFileParser $parser, RoverController $roverManager) {
        $this->parser = $parser;
        $this->roverManager = $roverManager;
    }

    /**
     * @param SymfonyStyle $io
     * @throws FilesystemException
     */
    public function process(SymfonyStyle $io)
    {
        $input = $this->parser->parse();
        $io->progressStart(count($input->rovers));
        $output = [];
        $index = 1;

        $this->roverManager->connectPlateau($input->plateau);
        foreach ($input->rovers as $rover){
            try {
                $this->roverManager->connectRover($rover);
                $commands = $rover->getOrders();
                foreach ($commands as $commandLitter)
                {
                    $functionName = self::COMMANDS_FUNC[$commandLitter] ?? null;
                    if (is_null($functionName))
                    {
                        $io->newLine();
                        $io->warning(sprintf('Command ( %s ) Not Supported',$commandLitter));
                        continue;
                    }
                    $this->roverManager->$functionName();
                }

                $output[] =  $this->roverManager->getRover()->getOutputString($index++);

            }catch (\Exception $exception)
            {
                $io->newLine();
                $io->error($exception->getMessage());
                continue;
            }

            $io->progressAdvance();
        }

        $io->progressFinish();

        $io->table(['Rover Name','co-ordinates and heading'],$output);

        $io->success('Done!!');
    }
}