<?php

namespace App\Tests\Core\ControlFunctions\Directions;

use App\Core\ControlFunctions\Directions\DirectionManager;
use App\Core\DataStructure\DirectionNode;
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

    public function getTestCases(): array
    {
        return [
            ['direction' => 'N', 'left' => 'W' , 'right' => 'E'],
            ['direction' => 'S', 'left' => 'E' , 'right' => 'W'],
            ['direction' => 'W', 'left' => 'S' , 'right' => 'N'],
            ['direction' => 'E', 'left' => 'N' , 'right' => 'S'],
        ];
    }

    /**
     * @dataProvider getTestCases
     */
    public function testGetDirection(string $direction, string $left, string $right)
    {
        /**
         * @var $node DirectionNode
         */
        $node = $this->directionManager->getDirection($direction);
        $this->assertEquals($direction, $node->data);
        $this->assertEquals($right, $node->getNextData());
        $this->assertEquals($left, $node->getPrevData());
    }

}
