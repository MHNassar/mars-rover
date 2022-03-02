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

    public function getOutputString(int $index) :array
    {
        $roverName = sprintf('Rover-%s', $index);
        $locationString = sprintf('%s %s %s',
            $this->location->coordinatePoint->xAxis,
            $this->location->coordinatePoint->yAxis,
            $this->location->direction);
        return [$roverName, $locationString];
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return str_split($this->orders);
    }

    /**
     * @param string $orders
     */
    public function setOrders(string $orders): void
    {
        $this->orders = $orders;
    }


}
