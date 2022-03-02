<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\RoverLocation;

class South implements IDirection
{

    public string $shortName = 'S';

    public function move(RoverLocation $location): void
    {
        $location->y -=1;
    }
}