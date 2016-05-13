<?php

namespace AppBundle\Entity\Departaments;

/**
 * Departaments
 */
class Departaments
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var guid
     */
    private $centreId;

    /**
     * @var int
     */
    private $codigoMec;

    /**
     * @var guid
     */
    private $centreOficialId;


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

