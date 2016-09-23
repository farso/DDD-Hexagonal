<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\UicApplicationException;

class DeleteTipusCentreException extends UicApplicationException
{
    const THROW_NOT_FOUND = 2;
}