<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\CoordinatePoint;
use App\Core\Models\RoverLocation;

class South implements IDirection
{

    public string $shortName = 'S';

    public function getNextPoints(CoordinatePoint $point): CoordinatePoint
    {
        $newPoint = new CoordinatePoint();
        $newPoint->yAxis = $point->yAxis - 1;
        $newPoint->xAxis = $point->xAxis;
        return $newPoint;
    }
}