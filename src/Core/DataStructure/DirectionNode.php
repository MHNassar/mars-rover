<?php

namespace App\Core\DataStructure;

use App\Core\ControlFunctions\Directions\IDirection;

class DirectionNode
{
    public string $data;

    public ?DirectionNode $next;

    public ?DirectionNode $prev;

    public IDirection $directionClass;

    public function getNextData():string {
        return $this->next->data;
    }

    public function getPrevData():string {
        return $this->prev->data;
    }


}