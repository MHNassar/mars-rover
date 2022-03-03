<?php

namespace App\Core\InputParser;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\Exception\InvalidLocationException;
use App\Core\Models\CoordinatePoint;
use App\Core\Models\Input;
use App\Core\Models\Plateau;
use App\Core\Models\Rover;
use App\Core\Models\RoverLocation;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use Exception;

class InputFileParser implements IParser
{
    private Filesystem $filesystem;

    private DirectionManager $directionManager;

    public function __construct(Filesystem $filesystem, DirectionManager $directionManager)
    {
        $this->filesystem = $filesystem;
        $this->directionManager = $directionManager;
    }

    /**
     * @param string $content
     * @return Input
     * @throws FilesystemException
     * @throws Exception
     */
    public function parse(string $content = 'input.txt'): Input
    {

        $fileContent = $this->getFileContent($content);
        $input = new Input();
        $plateauUpperRight = explode(' ',array_shift($fileContent));
        $input->plateau = $this->createPlateau($plateauUpperRight);

        $roversData = array_chunk($fileContent, 2);
        foreach ($roversData as $data)
        {
            if (count($data) !== 2)
            {
                continue;
            }
            $rover = $this->creatRover($data);

            $input->rovers[] = $rover;

        }
        return $input;
    }

    /**
     * @param string $fileName
     * @return array
     * @throws FilesystemException
     */
    private function getFileContent(string $fileName): array
    {
        $fileContent = $this->filesystem->read($fileName);
        return explode("\n", $fileContent);
    }

    private function createPlateau(array $plateauUpperRight): Plateau
    {
        $plateau = new Plateau();
        $plateau->setXMax($plateauUpperRight[0]);
        $plateau->setYMax($plateauUpperRight[1]);
        return $plateau;
    }

    /**
     * @param array $data
     * @return Rover
     * @throws Exception
     */
    private function creatRover(array $data) :Rover
    {
        $location = $this->creatRoverLocation($data[0]);
        $rover = new Rover($location);
        $rover->setOrders(mb_strtoupper($data[1]));
        return $rover;

    }

    /**
     * @throws Exception
     */
    private function creatRoverLocation(string $dataLine1):RoverLocation
    {
        $locationData  = explode(' ',$dataLine1);
        if (count($locationData) !== 3)
        {
            throw new InvalidLocationException();
        }

        $point = new CoordinatePoint();
        $point->xAxis = $locationData[0];
        $point->yAxis = $locationData[1];

        $location = new RoverLocation();
        $location->coordinatePoint = $point;
        if(is_null($this->directionManager->getDirection($locationData[2])))
        {
            $message = sprintf('Direction ( %s ) not exist !!',$locationData[2]);
            throw new InvalidLocationException($message);
        }
        $location->direction = mb_strtoupper($locationData[2]);

        return $location;
    }

}