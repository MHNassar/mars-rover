<?php

namespace App\Core\DataStructure;

class CircularDLinkedList
{
    public ?Node $head = null;
    public ?Node $tail = null;

    public function append(string $data)
    {
        $node = new Node();
        $node->data = $data;

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

    public function find(string $data): ?Node
    {
        $temp = $this->head;
        while ($temp != NULL && $temp->data !=$data) {
            $temp = $temp->next;
        }
        return $temp;
    }

}