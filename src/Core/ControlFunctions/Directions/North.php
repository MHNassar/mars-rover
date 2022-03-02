<?php

namespace App\Core\ControlFunctions\Directions;

use App\Core\Models\RoverLocation;

class North implements IDirection
{

    public string $shortName = 'N';

    public function move(RoverLocation $location): void
    {
        $location->y +=1;
    }


}