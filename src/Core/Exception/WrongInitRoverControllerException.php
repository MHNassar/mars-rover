<?php

namespace App\Core\Exception;
use Exception;

class WrongInitRoverControllerException extends Exception
{

    protected $message = 'something wrong happens when init RoverController';
}