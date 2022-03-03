<?php

namespace App\Core\Exception;
use Exception;

class InvalidLocationException extends Exception
{
    protected $message = 'Invalid Location Data!!';
}