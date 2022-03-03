<?php

namespace App\Core\ControlFunctions;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\DataStructure\DirectionNode;
use App\Core\Exception\WrongInitRoverControllerException;
use App\Core\Models\Plateau;
use App\Core\Models\Rover;
use function PHPUnit\Framework\isNull;

class RoverController implements IRoverController
{
    private ?Rover $rover = null;

    private DirectionManager $directionManager;

    private ?Plateau $plateau = null;

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

    public function move()
    {
        if (is_null($this->rover) || is_null($this->plateau))
        {
            throw new WrongInitRoverControllerException();
        }
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
        if (is_null($this->rover) || is_null($this->plateau))
        {
            throw new WrongInitRoverControllerException();
        }
        $currentDirection = $this->getCurrentDirection();
        $newDirection = $currentDirection->prev;
        $this->rover->setDirection($newDirection->data);

    }
    public function spinRight()
    {
        if (is_null($this->rover) || is_null($this->plateau))
        {
            throw new WrongInitRoverControllerException();
        }
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