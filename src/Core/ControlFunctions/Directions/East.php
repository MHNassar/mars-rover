<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\RoverLocation;

class East implements IDirection
{

    public string $shortName = 'E';

    public function move(RoverLocation $location): void
    {
        $location->x +=1;
    }
}