<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\CoordinatePoint;

class North implements IDirection
{

    public string $shortName = 'N';

    public function getNextPoints(CoordinatePoint $point): CoordinatePoint
    {

        $newPoint = new CoordinatePoint();
        $newPoint->yAxis = $point->yAxis + 1;
        $newPoint->xAxis = $point->xAxis;
        return $newPoint;
    }


}