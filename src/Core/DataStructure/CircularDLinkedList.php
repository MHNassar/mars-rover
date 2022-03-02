<?php

namespace App\Core\DataStructure;

class CircularDLinkedList
{
    public ?DirectionNode $head = null;
    public ?DirectionNode $tail = null;

    public function append(DirectionNode $node)
    {

        if ($this->head == null)
        {
            $this->head = $node;
            $this->tail = $node;
        }
        else
        {
            $this->head->prev = $node;
            $this->tail->next = $node;
        }

        $node->next = $this->head;
        $node->prev = $this->tail;
        $this->head = $node;
    }

    public function find(string $data): ?DirectionNode
    {
        $temp = $this->head;
        while ($temp != NULL && $temp->data !=$data) {
            $temp = $temp->next;
        }
        return $temp;
    }

}