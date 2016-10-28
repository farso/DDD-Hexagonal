<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 10:16
 */

namespace UicBundle\Application\DataTransformer\TipusCentre;

use UicBundle\Domain\Entity\TipusCentre\TipusCentre;


class TipusCentreObjectDataTransformer implements TipusCentreDataTransformer
{
    private $tipusCentre;


    public function write(TipusCentre $tipusCentre)
    {
        $this->tipusCentre = $tipusCentre;
    }


    public function read()
    {
        return $this->tipusCentre;
    }

}