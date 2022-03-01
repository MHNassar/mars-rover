<?php

namespace App\Core\DataStructure;

class Node
{
    public string $data;

    public ?Node $next;

    public ?Node $prev;

    public function getNextData():string {
        return $this->next->data;
    }

    public function getPrevData():string {
        return $this->prev->data;
    }


}