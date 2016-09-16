<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\UicApplicationException;

class UpdateCentreException extends UicApplicationException
{
    const THROW_NOT_FOUND = 2;
}