<?php

namespace App\Tests\Core\ControlFunctions;

use App\Core\ControlFunctions\RoverController;
use App\Core\Models\Rover;
use App\Core\Models\RoverLocation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoverControllerManagerTest extends KernelTestCase
{
    private ?RoverController $roverControllerManager;
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->roverControllerManager = $container->get(RoverController::class);
    }

    public function testSpinToLFromNorth()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'N';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->spin('L');
        $this->assertEquals('W', $this->roverControllerManager->getRover()->getDirection());

    }

    public function testSpinToRFromNorth()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'N';

        $rover = new Rover($location);

        $this->roverControllerManager->setRover($rover);

        $this->roverControllerManager->spin('R');
        $this->assertEquals('E', $this->roverControllerManager->getRover()->getDirection());
    }

    public function testErrorSpin()
    {
        $this->expectException(\Exception::class);
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'N';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);

        $this->roverControllerManager->spin('E');
        $this->assertEquals('E', $this->roverControllerManager->getRover()->getDirection());
    }

    public function testMoveNorth()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'N';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->move();
        $this->assertEquals(3,$this->roverControllerManager->getRover()->getLocation()->y);
    }

    public function testMoveSouth()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'S';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->move();
        $this->assertEquals(1,$this->roverControllerManager->getRover()->getLocation()->y);
    }

    public function testMoveEast()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'E';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->move();
        $this->assertEquals(3,$this->roverControllerManager->getRover()->getLocation()->x);
    }

    public function testMoveWest()
    {
        $location = new RoverLocation();
        $location->x = 2;
        $location->y = 2;
        $location->direction = 'W';

        $rover = new Rover($location);
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->move();
        $this->assertEquals(1,$this->roverControllerManager->getRover()->getLocation()->x);
    }

    public function testControl()
    {
        $location = new RoverLocation();
        $location->x = 3;
        $location->y = 3;
        $location->direction = 'E';

        $rover = new Rover($location);
        $rover->setOrders('MMRMMRMRRM');
        $this->roverControllerManager->setRover($rover);
        $this->roverControllerManager->control();

        $this->assertEquals(5,$this->roverControllerManager->getRover()->getLocation()->x);
        $this->assertEquals(1,$this->roverControllerManager->getRover()->getLocation()->y);
        $this->assertEquals('E',$this->roverControllerManager->getRover()->getDirection());

    }

}
