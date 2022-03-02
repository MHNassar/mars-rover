<?php

namespace App\Core\ControlFunctions;

use App\Core\Models\Plateau;
use App\Core\Models\Rover;

interface IRoverController
{

    public function connectRover(Rover $rover): void;

    public function connectPlateau(Plateau $plateau): void;

    public function spinRight();

    public function spinLeft();

    public function move();

}