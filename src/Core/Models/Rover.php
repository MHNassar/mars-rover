<?php

namespace App\Core\Models;

class Rover
{
    private RoverLocation $location;

    private string $orders;

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

    /**
     * @return string
     */
    public function getOrders(): string
    {
        return $this->orders;
    }

    /**
     * @param string $orders
     */
    public function setOrders(string $orders): void
    {
        $this->orders = $orders;
    }


}
