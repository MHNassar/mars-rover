<?php

namespace App\Core\ControlFunctions;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\DataStructure\DirectionNode;
use App\Core\Models\Plateau;
use App\Core\Models\Rover;

class RoverController implements IRoverController
{
    private ?Rover $rover;

    private DirectionManager $directionManager;

    private Plateau $plateau;

    public function __construct(DirectionManager $directionManager)
    {
        $this->directionManager = $directionManager;
    }
     public function connectRover(Rover $rover): void
     {
         $this->rover = $rover;
     }

    public function getRover(): ?Rover
    {
        return $this->rover;
    }

    public function connectPlateau(Plateau $plateau): void
    {
        $this->plateau = $plateau;
    }
//
//    public function control()
//    {
//        // get Commands
//        $commands = $this->rover->getOrders();
//        if (empty($commands)){
//            throw new Exception("No commands provided");
//        }
//        $commands = str_split($commands);
//        foreach ($commands as $commandLitter)
//        {
//            $functionName = self::COMMANDS_FUNC[$commandLitter];
//            $this->$functionName();
//        }
//    }
//
    public function move()
    {
        $currentDirection = $this->getCurrentDirection();
        $directionClass = $currentDirection->directionClass;
        $currentPoint = $this->rover->getLocation()->coordinatePoint;
        $nextPoints = $directionClass->getNextPoints($currentPoint);
        if($this->plateau->isValidCoordinate($nextPoints))
        {
            $this->rover->getLocation()->coordinatePoint = $nextPoints;
        }
    }

    public function spinLeft()
    {
        $currentDirection = $this->getCurrentDirection();
        $newDirection = $currentDirection->prev;
        $this->rover->setDirection($newDirection->data);

    }
    public function spinRight()
    {
        $currentDirection = $this->getCurrentDirection();
        $newDirection = $currentDirection->next;
        $this->rover->setDirection($newDirection->data);
    }

    private function getCurrentDirection(): DirectionNode
    {
        $directionString = $this->rover->getDirection();
        return $this->directionManager->getDirection($directionString);
    }

}