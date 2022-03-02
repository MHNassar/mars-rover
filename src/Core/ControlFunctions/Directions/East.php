<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\CoordinatePoint;
use App\Core\Models\RoverLocation;

class East implements IDirection
{

    public string $shortName = 'E';

    public function getNextPoints(CoordinatePoint $point): CoordinatePoint
    {
        $newPoint = new CoordinatePoint();
        $newPoint->yAxis = $point->yAxis;
        $newPoint->xAxis = $point->xAxis + 1;
        return $newPoint;
    }
}