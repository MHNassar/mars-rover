<?php

namespace App\Core\ControlFunctions\Spin;

use App\Core\DataStructure\Node;

interface ISpin
{

    public function spin(Node $currentDirection): Node;

}