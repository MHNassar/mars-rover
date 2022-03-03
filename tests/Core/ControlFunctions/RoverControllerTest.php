<?php

namespace App\Tests\Core\ControlFunctions;

use App\Core\ControlFunctions\RoverController;
use App\Core\Models\CoordinatePoint;
use App\Core\Models\Plateau;
use App\Core\Models\Rover;
use App\Core\Models\RoverLocation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoverControllerTest extends KernelTestCase
{
    private ?RoverController $roverController;
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->roverController = $container->get(RoverController::class);
        $plateau = new Plateau();
        $plateau->setXMax(5);
        $plateau->setYMax(5);
        $this->roverController->connectPlateau($plateau);

    }

    public function testMove()
    {
        $rover = $this->mockRover(2, 2, 'N');
        $this->roverController->connectRover($rover);
        $this->roverController->move();
        $newLocation = $this->roverController->getRover()->getLocation();
        $this->assertEquals(3,$newLocation->coordinatePoint->yAxis);
        $this->assertEquals(2,$newLocation->coordinatePoint->xAxis);

    }

    public function testNotMove()
    {
        $rover = $this->mockRover(5, 5, 'E');
        $this->roverController->connectRover($rover);
        $this->roverController->move();
        $newLocation = $this->roverController->getRover()->getLocation();
        $this->assertEquals(5,$newLocation->coordinatePoint->yAxis);
        $this->assertEquals(5,$newLocation->coordinatePoint->xAxis);
    }

    public function testNotMove2()
    {
        $rover = $this->mockRover(0, 0, 'W');
        $this->roverController->connectRover($rover);
        $this->roverController->move();
        $newLocation = $this->roverController->getRover()->getLocation();
        $this->assertEquals(0,$newLocation->coordinatePoint->yAxis);
        $this->assertEquals(0,$newLocation->coordinatePoint->xAxis);
    }

    public function testSpinLeft()
    {
        $rover = $this->mockRover(2, 2, 'N');
        $this->roverController->connectRover($rover);
        $this->roverController->spinLeft();
        $newLocation = $this->roverController->getRover()->getLocation();
        $this->assertEquals('W',$newLocation->direction);
    }

    public function testSpinRight()
    {
        $rover = $this->mockRover(2, 2, 'N');
        $this->roverController->connectRover($rover);
        $this->roverController->spinRight();
        $newLocation = $this->roverController->getRover()->getLocation();
        $this->assertEquals('E',$newLocation->direction);
    }



    private function mockRover(int $x, int $y, string $direction): Rover
    {
        $locationPoint = new CoordinatePoint();
        $locationPoint->xAxis = $x;
        $locationPoint->yAxis = $y;
        $location = new RoverLocation();
        $location->coordinatePoint = $locationPoint;
        $location->direction = $direction;

        $rover = new Rover($location);
        $rover->setOrders('LMLMLMLMLLM');
        return  $rover;

    }



//    public function testSpinToLFromNorth()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'N';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//        $this->roverController->spin('L');
//        $this->assertEquals('W', $this->roverController->getRover()->getDirection());
//
//    }
//
//    public function testSpinToRFromNorth()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'N';
//
//        $rover = new Rover($location);
//
//        $this->roverController->setRover($rover);
//
//        $this->roverController->spin('R');
//        $this->assertEquals('E', $this->roverController->getRover()->getDirection());
//    }
//
//    public function testErrorSpin()
//    {
//        $this->expectException(\Exception::class);
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'N';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//
//        $this->roverController->spin('E');
//        $this->assertEquals('E', $this->roverController->getRover()->getDirection());
//    }
//
//    public function testMoveNorth()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'N';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//        $this->roverController->move();
//        $this->assertEquals(3,$this->roverController->getRover()->getLocation()->y);
//    }
//
//    public function testMoveSouth()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'S';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//        $this->roverController->move();
//        $this->assertEquals(1,$this->roverController->getRover()->getLocation()->y);
//    }
//
//    public function testMoveEast()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'E';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//        $this->roverController->move();
//        $this->assertEquals(3,$this->roverController->getRover()->getLocation()->x);
//    }
//
//    public function testMoveWest()
//    {
//        $location = new RoverLocation();
//        $location->x = 2;
//        $location->y = 2;
//        $location->direction = 'W';
//
//        $rover = new Rover($location);
//        $this->roverController->setRover($rover);
//        $this->roverController->move();
//        $this->assertEquals(1,$this->roverController->getRover()->getLocation()->x);
//    }
//
//    public function testControl()
//    {
//        $location = new RoverLocation();
//        $location->x = 3;
//        $location->y = 3;
//        $location->direction = 'E';
//
//        $rover = new Rover($location);
//        $rover->setOrders('MMRMMRMRRM');
//        $this->roverController->setRover($rover);
//        $this->roverController->control();
//
//        $this->assertEquals(5,$this->roverController->getRover()->getLocation()->x);
//        $this->assertEquals(1,$this->roverController->getRover()->getLocation()->y);
//        $this->assertEquals('E',$this->roverController->getRover()->getDirection());
//
//    }

}
