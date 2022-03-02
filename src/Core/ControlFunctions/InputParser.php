<?php

namespace App\Core\ControlFunctions;


use App\Core\Models\CoordinatePoint;
use App\Core\Models\Input;
use App\Core\Models\Plateau;
use App\Core\Models\Rover;
use App\Core\Models\RoverLocation;
use League\Flysystem\Filesystem;

class InputParser
{
    private Filesystem $filesystem;
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function parseFile(): Input
    {
        $fileContent = $this->filesystem->read('input.txt');
        $fileContent = explode("\n", $fileContent);

        $input = new Input();

        $plateauUpperRight = explode(' ',array_shift($fileContent));

        $plateau = new Plateau();
        $plateau->setXMax($plateauUpperRight[0]);
        $plateau->setYMax($plateauUpperRight[1]);

        $input->plateau = $plateau;

        $roversData = array_chunk($fileContent, 2);
        foreach ($roversData as $data)
        {
            $locationData  = explode(' ',$data[0]);

            $location = new RoverLocation();
            $point = new CoordinatePoint();
            $point->xAxis = $locationData[0];
            $point->yAxis = $locationData[1];
            $location->coordinatePoint = $point;
            $location->direction = $locationData[2];

            $rover = new Rover($location);
            $rover->setOrders($data[1]);
            $input->rovers[] = $rover;

        }
        return $input;
    }
}