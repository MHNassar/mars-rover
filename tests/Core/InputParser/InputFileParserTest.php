<?php

namespace App\Tests\Core\InputParser;

use App\Core\Exception\InvalidLocationException;
use App\Core\InputParser\InputFileParser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InputFileParserTest extends KernelTestCase
{
    private ?InputFileParser $inputFileParser;
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->inputFileParser = $container->get(InputFileParser::class);
    }

    public function testParse()
    {
        $input = $this->inputFileParser->parse('input_test.txt');
        $plateau =$input->plateau;
        $this->assertEquals(6,$plateau->getXMax());
        $this->assertEquals(6,$plateau->getYMax());
        $this->assertCount(2, $input->rovers);
    }

    public function testWrongParse()
    {
        $this->expectException(InvalidLocationException::class);
        $this->inputFileParser->parse('input_error_test.txt');
    }
}
