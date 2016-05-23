<?php

namespace AppBundle\Entity\Departament;

use AppBundle\Entity\EntityInf;

/**
 * Departaments
 */
class Departament extends EntityInf
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
     * @var guid
     */
    protected $centreId;

    /**
     * @var int
     */
    protected $codigoMec;

    /**
     * @var guid
     */
    protected $centreOficialId;

    public function __construct($id = null, $nombre = null, $centreId = null, $codigoMec = null, $centreOficialId = null) {

        $this->id = $id; 
        $this->nombre = $nombre;
        $this->centreId = $centreId;
        $this->codigoMec = $codigoMec;
        $this->centreOficialId = $centreOficialId; 
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
     * @return Departaments
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
     * Set centreId
     *
     * @param guid $centreId
     *
     * @return Departaments
     */
    public function setCentreId($centreId)
    {
        $this->centreId = $centreId;

        return $this;
    }

    /**
     * Get centreId
     *
     * @return guid
     */
    public function getCentreId()
    {
        return $this->centreId;
    }

    /**
     * Set codigoMec
     *
     * @param integer $codigoMec
     *
     * @return Departaments
     */
    public function setCodigoMec($codigoMec)
    {
        $this->codigoMec = $codigoMec;

        return $this;
    }

    /**
     * Get codigoMec
     *
     * @return int
     */
    public function getCodigoMec()
    {
        return $this->codigoMec;
    }

    /**
     * Set centreOficialId
     *
     * @param guid $centreOficialId
     *
     * @return Departaments
     */
    public function setCentreOficialId($centreOficialId)
    {
        $this->centreOficialId = $centreOficialId;

        return $this;
    }

    /**
     * Get centreOficialId
     *
     * @return guid
     */
    public function getCentreOficialId()
    {
        return $this->centreOficialId;
    }
}

