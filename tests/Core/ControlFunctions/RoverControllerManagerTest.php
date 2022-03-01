<?php

namespace App\Tests\Core\ControlFunctions;

use App\Core\ControlFunctions\RoverControllerManager;
use App\Core\Models\Rover;
use App\Core\Models\RoverLocation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoverControllerManagerTest extends KernelTestCase
{
    private ?RoverControllerManager $roverControllerManager;
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->roverControllerManager = $container->get(RoverControllerManager::class);
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
}
