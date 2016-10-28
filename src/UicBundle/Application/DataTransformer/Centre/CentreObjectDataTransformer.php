<?php
/**
 * Created by PhpStorm.
 * User: ddt
 * Date: 23/09/16
 * Time: 12:50
 */

namespace UicBundle\Application\DataTransformer\Centre;


use UicBundle\Domain\Entity\Centre\Centre;

class CentreObjectDataTransformer implements CentreDataTransformer
{
    private $centre;

    public function write(Centre $centre)
    {
        $this->centre = $centre;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        return $this->centre;
    }

}