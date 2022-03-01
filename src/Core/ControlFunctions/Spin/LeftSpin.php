<?php

namespace App\Core\ControlFunctions\Spin;

use App\Core\DataStructure\Node;

class LeftSpin implements ISpin
{

    public function spin(Node $currentDirection): Node
    {
        return $currentDirection->prev;
    }
}