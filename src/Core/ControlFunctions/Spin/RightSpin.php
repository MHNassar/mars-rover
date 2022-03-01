<?php

namespace App\Core\ControlFunctions\Spin;

use App\Core\DataStructure\Node;

class RightSpin implements ISpin
{

    public function spin(Node $currentDirection): Node
    {
        return $currentDirection->next;
    }
}