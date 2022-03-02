<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\CoordinatePoint;

class West implements IDirection
{

    public string $shortName = 'W';

    public function getNextPoints(CoordinatePoint $point) :CoordinatePoint
    {
        $newPoint = new CoordinatePoint();
        $newPoint->yAxis = $point->yAxis;
        $newPoint->xAxis = $point->xAxis - 1;
        return $newPoint;
    }
}