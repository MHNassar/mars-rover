<?php

namespace App\Core\InputParser;

use App\Core\Models\Input;

interface IParser
{

    public function parse(string $content): Input;
}