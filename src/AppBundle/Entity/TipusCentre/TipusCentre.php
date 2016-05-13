<?php

namespace AppBundle\Entity\TipusCentre;

use AppBundle\Entity\EntityInf;

/**
 * TipusCentre
 */
class TipusCentre extends EntityInf
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $descriCat;

    /**
     * @var string
     */
    private $descriEsp;

    /**
     * @var string
     */
    private $descriEng;


    public function __construct($id = null, $descriCat = null, $descriEsp = null, $descriEng = null) 
    {

        $this->id = $id; 
        $this->descriCat = $descriCat;
        $this->descriEsp = $descriEsp;
        $this->descriEng = $descriEng;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descriCat
     *
     * @param string $descriCat
     *
     * @return TipusCentre
     */
    public function setDescriCat($descriCat)
    {
        $this->descriCat = $descriCat;

        return $this;
    }

    /**
     * Get descriCat
     *
     * @return string
     */
    public function getDescriCat()
    {
        return $this->descriCat;
    }

    /**
     * Set descriEsp
     *
     * @param string $descriEsp
     *
     * @return TipusCentre
     */
    public function setDescriEsp($descriEsp)
    {
        $this->descriEsp = $descriEsp;

        return $this;
    }

    /**
     * Get descriEsp
     *
     * @return string
     */
    public function getDescriEsp()
    {
        return $this->descriEsp;
    }

    /**
     * Set descriEng
     *
     * @param string $descriEng
     *
     * @return TipusCentre
     */
    public function setDescriEng($descriEng)
    {
        $this->descriEng = $descriEng;

        return $this;
    }

    /**
     * Get descriEng
     *
     * @return string
     */
    public function getDescriEng()
    {
        return $this->descriEng;
    }
}

