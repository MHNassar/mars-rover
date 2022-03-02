<?php

namespace App\Tests\Core\ControlFunctions;

use App\Core\ControlFunctions\InputParser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InputParserTest extends KernelTestCase
{

    private ?InputParser $inputParser;
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->inputParser = $container->get(InputParser::class);
    }

    public function testParseFile()
    {
        $this->inputParser->parseFile();
    }
}
