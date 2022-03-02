<?php

namespace App\Core\ControlFunctions\Directions;
use App\Core\DataStructure\CircularDLinkedList;
use App\Core\DataStructure\DirectionNode;

class DirectionManager
{
    private array $available_direction ;
    private CircularDLinkedList $directions;

    public function __construct(West $west, South $south, East $east, North $north)
    {

        $this->available_direction = [
            $west->shortName => $west,
            $south->shortName => $south,
            $east->shortName => $east,
            $north->shortName => $north
        ];
        $this->directions = new CircularDLinkedList();
        /**
         * @var IDirection
         */
        foreach ($this->available_direction as $key => $direction)
        {
            $node = new DirectionNode();
            $node->data = $key;
            $node->directionClass = $direction;
            $this->directions->append($node);
        }
    }

    public function getDirection(string $value): DirectionNode
    {
       return $this->directions->find($value);
    }




}