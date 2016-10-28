<?php
/**
 * Created by PhpStorm.
 * User: ddt
 * Date: 23/09/16
 * Time: 13:15
 */

namespace UicBundle\Application\UseCase\Centre;


class DeleteCentreRequest
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}