<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\RoverLocation;

interface IDirection
{
    public function move(RoverLocation $location):void;

}