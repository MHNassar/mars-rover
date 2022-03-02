<?php

namespace App\Core\ControlFunctions;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\ControlFunctions\Spin\SpinControlManager;
use App\Core\Models\Rover;

class RoverControllerManager
{
    private ?Rover $rover;

    private SpinControlManager $spinControlManager;

    private DirectionManager $directionManager;

    public function __construct(SpinControlManager $spinControlManager, DirectionManager $directionManager)
    {
        $this->spinControlManager = $spinControlManager;
        $this->directionManager = $directionManager;
    }

    public function setRover(Rover $rover)
    {
        $this->rover = $rover;
    }
    public function getRover(): ?Rover
    {
        return $this->rover;
    }

    public function control()
    {
        // get Commands
        $commands = $this->rover->getOrders();
        if (empty($commands)){
            throw new \Exception("No commands provided");
        }
        $commands = str_split($commands);
        foreach ($commands as $commandLitter)
        {
            if ($commandLitter === 'M') {
                $this->move();
            }else {
                $this->spin($commandLitter);
            }
        }
    }

    public function spin(string $spinTo){
        $directionString = $this->rover->getDirection();
        $currentDirection = $this->directionManager->getDirections($directionString);
        $newDirection = $this->spinControlManager->spin($spinTo, $currentDirection);
        $this->rover->setDirection($newDirection->data);
    }

    public function move()
    {
        $directionString = $this->rover->getDirection();
        $directionClass = $this->directionManager->getDirectionClass($directionString);
        $directionClass->move($this->rover->getLocation());
    }

}