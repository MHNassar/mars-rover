<?php

namespace App\Core\ControlFunctions\Spin;

use Exception;
use App\Core\DataStructure\Node;

class SpinControlManager
{
    private array $available_spin_control;

    public function __construct(LeftSpin $leftSpin, RightSpin $rightSpin)
    {
        $this->available_spin_control = [
            'L' => $leftSpin,
            'R' => $rightSpin
        ];
    }

    /**
     * @throws Exception
     */
    public function spin(string $command, Node $currentNode): ?Node
    {
        if (isset($this->available_spin_control[$command])){
            /**
             * @var $spinClass ISpin
             */
            $spinClass = $this->available_spin_control[$command];
            return $spinClass->spin($currentNode);
        }

        throw new \Exception("Command not available");
    }






}