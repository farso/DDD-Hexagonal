<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\UicApplicationException;

class CreateCentreException extends UicApplicationException
{
    const THROW_CODI_REPETIT = 2;
    
    const THROW_NOM_REPETIT = 3;
}