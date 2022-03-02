<?php

namespace App\Core\Models;
use Exception;

class RoverLocation
{

    public CoordinatePoint $coordinatePoint;

    public string $direction;

    public function valid():bool
    {
        if ($this->x <0 || $this->y <0)
        {
            throw new Exception('Location not valid');
        }
        return true;
    }

}