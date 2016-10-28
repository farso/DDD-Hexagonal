<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 10:14
 */

namespace UicBundle\Application\DataTransformer\TipusCentre;

use UicBundle\Domain\Entity\TipusCentre\TipusCentre;


interface TipusCentreDataTransformer
{
    public function read();

    public function write(TipusCentre $tipusCentre);
}