<?php

namespace UicBundle\Application\DataTransformer\Centre;

use UicBundle\Domain\Entity\Centre\Centre;

/**
 * Created by PhpStorm.
 * User: ddt
 * Date: 23/09/16
 * Time: 12:46
 */
interface CentreDataTransformer
{
    public function write(Centre $centre);

    public function read();
}