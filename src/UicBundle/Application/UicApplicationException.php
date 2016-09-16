<?php

namespace UicBundle\Application;

class UicApplicationException extends \Exception
{

    const THROW_NONE = 0;
    
    const THROW_ERROR_GENERAL = 1;

	// Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}