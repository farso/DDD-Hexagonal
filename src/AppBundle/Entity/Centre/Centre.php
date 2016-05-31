<?php

namespace AppBundle\Entity\Centre;

use AppBundle\Entity\EntityInf;
use AppBundle\Entity\TipusCentre\TipusCentre;

/**
 * Centre
 */
class Centre extends EntityInf
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $codi;

     /**
     * @var string
     */
    protected $mailCentre;

    /**
     * @var string
     */
    protected $codiOficial;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var uuid
     */
    protected $tipusCentre;

    public function __construct($id = null, $nombre = null, $codi = null, $mailCentre = null, $codiOficial = null, $color = null, TipusCentre $tipusCentre = null) {

        $this->id = $id; 
        $this->nombre = $nombre;
        $this->codi = $codi;
        $this->mailCentre = $mailCentre;
        $this->codiOficial = $codiOficial;
        $this->color = $color;
        $this->tipusCentre = $tipusCentre;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Centre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codi
     *
     * @param string $codi
     *
     * @return Centre
     */
    public function setCodi($codi)
    {
        $this->codi = $codi;

        return $this;
    }

    /**
     * Get codi
     *
     * @return string
     */
    public function getCodi()
    {
        return $this->codi;
    }

    /**
     * Set codiOficial
     *
     * @param string $codiOficial
     *
     * @return Centre
     */
    public function setCodiOficial($codiOficial)
    {
        $this->codiOficial = $codiOficial;

        return $this;
    }

    /**
     * Get codiOficial
     *
     * @return string
     */
    public function getCodiOficial()
    {
        return $this->codiOficial;
    }

    /**
     * Set mailCentre
     *
     * @param string $mailCentre
     *
     * @return Centre
     */
    public function setMailCentre($mailCentre)
    {
        $this->mailCentre = $mailCentre;

        return $this;
    }

    /**
     * Get mailCentre
     *
     * @return string
     */
    public function getMailCentre()
    {
        return $this->mailCentre;
    }

 
    /**
     * Set color
     *
     * @param string $color
     *
     * @return Centre
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }


    /**
     * Set tipusCentre
     *
     * @param TipusCentre $tipusCentre
     *
     * @return Centre
     */
    public function setTipusCentre(TipusCentre $tipusCentre)
    {
        $this->tipusCentre = $tipusCentre;

        return $this;
    }

    /**
     * Get tipusCentre
     *
     * @return TipusCentre
     */
    public function getTipusCentre()
    {
        return $this->tipusCentre;
    }
}
