<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\UicApplicationException;

class UpdateTipusCentreException extends UicApplicationException
{
    const THROW_NOM_REPETIT = 3;
}