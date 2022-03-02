<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\RoverLocation;

class West implements IDirection
{

    public string $shortName = 'W';

    public function move(RoverLocation $location): void
    {
        $location->x -=1;
    }
}