<?php
//1.0.2
namespace DomainBundle\Entity\Departament;

use DomainBundle\Entity\Departament\DepartamentId;
use DomainBundle\Entity\Entity;

/**
 * Departament
 */
class Departament extends Entity implements DepartamentInterface
{
    /**
     * @var DepartamentId
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $codigoMec;

    /**
     * @var string
     */
    protected $centreOficialId;


    /**
     * @var string
     */
    protected $centreId;

    public function __construct(DepartamentId $id, $nom, $centreId, $codigoMec, $centreOficialId)
    {
        $this->id = $id;
        $this->nombre = $nom;
        $this->codigoMec = $codigoMec;
        $this->centreOficialId = $centreOficialId;
        $this->centreId = $centreId;
    }


    /**
     * Get id
     *
     * @return DepartamentId
     */
    public function getId()
    {
        return $this->id;
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
     * Get centreId
     *
     * @return string
     */
    public function getCentreId()
    {
        return $this->centreId;
    }

    /**
     * Get centreOficialId
     *
     * @return string
     */
    public function getCentreOficialId()
    {
        return $this->centreOficialId;
    }

    /**
     * Get codigoMec
     *
     * @return string
     */
    public function getCodigoMec()
    {
        return $this->codigoMec;
    }

    public function update($nom, $centreId, $codigoMec, $centreOficialId)
    {
        //@todo validació atributs d'entitat (que siguin enters, char(1), ...)
        $this->nombre = $nom;
        $this->centreId = $centreId;
        $this->codigoMec = $codigoMec;
        $this->centreOficialId = $centreOficialId;
    }
}
