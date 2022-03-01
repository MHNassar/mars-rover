<?php

namespace App\Core;
use App\Core\DataStructure\CircularDLinkedList;
use App\Core\DataStructure\Node;

class DirectionManager
{
    const DIRECTIONS = [
        'W','S','E','N'
    ];
    private CircularDLinkedList $directions;

    public function __construct()
    {
        $this->directions = new CircularDLinkedList();
        foreach (self::DIRECTIONS as $value)
        {
            $this->directions->append($value);
        }
    }


    public function getDirections(string $value): Node
    {
       return $this->directions->find($value);
    }



}