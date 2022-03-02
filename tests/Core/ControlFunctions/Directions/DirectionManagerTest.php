<?php

namespace App\Tests\Core\ControlFunctions\Directions;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\DataStructure\Node;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DirectionManagerTest extends KernelTestCase
{

    private ?DirectionManager $directionManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->directionManager = $container->get(DirectionManager::class);
    }

    public function testGetNorth(){
        /**
         * @var $node Node
         */
        $node = $this->directionManager->getDirections('N');
        $this->assertEquals('N',$node->data);
        $this->assertEquals('E',$node->getNextData());
        $this->assertEquals('W',$node->getPrevData());
    }

    public function testGetSouth(){
        /**
         * @var $node Node
         */
        $node = $this->directionManager->getDirections('S');
        $this->assertEquals('S',$node->data);
        $this->assertEquals('W',$node->getNextData());
        $this->assertEquals('E',$node->getPrevData());
    }

    public function testGetWest(){
        /**
         * @var $node Node
         */
        $node = $this->directionManager->getDirections('W');
        $this->assertEquals('W',$node->data);
        $this->assertEquals('N',$node->getNextData());
        $this->assertEquals('S',$node->getPrevData());
    }

    public function testGetEast(){
        /**
         * @var $node Node
         */
        $node = $this->directionManager->getDirections('E');
        $this->assertEquals('E',$node->data);
        $this->assertEquals('S',$node->getNextData());
        $this->assertEquals('N',$node->getPrevData());
    }
}
