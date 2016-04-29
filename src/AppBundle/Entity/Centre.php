<?php

namespace AppBundle\Entity;

use AppBundle\Entity\EntityInf;

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

    public function __construct($id = null, $nombre = null, $codi = null, $mailCentre = null, $codiOficial = null) {

        $this->id = $id; 
        $this->nombre = $nombre;
        $this->codi = $codi;
        $this->mailCentre = $mailCentre;
        $this->codiOficial = $codiOficial;
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



    // public function toArray() 
    // {
    //     //@todo recursiu si els atributs són objectes
    //     $centreArray = array();
    //     $centreArray['id'] = $this->id;
    //     $centreArray['nombre'] = $this->nombre;
    //     $centreArray['codi'] = $this->codi;
    //     $centreArray['mailCentre'] = $this->mailCentre;
    //     $centreArray['codiOficial'] = $this->codiOficial;
    //     return $centreArray;
    // }
}

