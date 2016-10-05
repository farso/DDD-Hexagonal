<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 09:46
 */

namespace UicBundle\Application\UseCase\TipusCentre;


class CreateTipusCentreRequest
{

    private $descriCat;
    private $descriEng;
    private $descriEsp;

    /**
     * @return mixed
     */
    public function getDescriCat()
    {
        return $this->descriCat;
    }

    /**
     * @param mixed $descriCat
     */
    public function setDescriCat($descriCat)
    {
        $this->descriCat = $descriCat;
    }

    /**
     * @return mixed
     */
    public function getDescriEng()
    {
        return $this->descriEng;
    }

    /**
     * @param mixed $descriEng
     */
    public function setDescriEng($descriEng)
    {
        $this->descriEng = $descriEng;
    }

    /**
     * @return mixed
     */
    public function getDescriEsp()
    {
        return $this->descriEsp;
    }

    /**
     * @param mixed $descriEsp
     */
    public function setDescriEsp($descriEsp)
    {
        $this->descriEsp = $descriEsp;
    }



}