<?php

namespace App\Core\Models;
use Exception;

class RoverLocation
{

    public int $x;

    public int $y;

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