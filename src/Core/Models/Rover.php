<?php

namespace App\Core\Models;

class Rover
{
    private RoverLocation $location;

    public function __construct(RoverLocation $initLocation)
    {
        $this->location = $initLocation;
    }

    public function getLocation(): RoverLocation
    {
        return $this->location;
    }

    public function getDirection(): string
    {
        return $this->getLocation()->direction;
    }

    public function setDirection(string $direction)
    {
        $this->location->direction = $direction;
    }


}