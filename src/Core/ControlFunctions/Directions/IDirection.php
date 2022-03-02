<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\CoordinatePoint;

interface IDirection
{
    public function getNextPoints(CoordinatePoint $point): CoordinatePoint;

}