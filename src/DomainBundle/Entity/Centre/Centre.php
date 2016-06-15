<?php
//1.0.2
namespace DomainBundle\Entity\Centre;

use DomainBundle\Entity\Centre\CentreId;
use DomainBundle\Entity\Entity;
use DomainBundle\Entity\TipusCentre\TipusCentre;

/**
 * Centre
 */
class Centre extends Entity implements CentreInterface
{
    /**
     * @var CentreId
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
     * @var TipusCentre
     */
    protected $tipusCentre;

    public function __construct(CentreId $id, $nom, $codi, $mailCentre, $codiOficial, $color)
    {
        $this->id = $id;
        $this->codi = $codi;
        $this->nombre = $nom;
        $this->mailCentre = $mailCentre;
        $this->codiOficial = $codiOficial;
        $this->color = $color;
        // $this->tipusCentre = $tipusCentre;
    }


    /**
     * Get id
     *
     * @return CentreId
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
     * Get codi
     *
     * @return string
     */
    public function getCodi()
    {
        return $this->codi;
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
     * Get mailCentre
     *
     * @return string
     */
    public function getMailCentre()
    {
        return $this->mailCentre;
    }

    /**
     * [getColor description]
     * @return string color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * [getTipusCentre description]
     * @return TipusCentre tipusCentre
     */
    public function getTipusCentre()
    {
        return $this->tipusCentre;
    }

    public function update($params)
    {
        foreach ($params as $field => $value) {
            $this->$field = $value;
        }
    }
}
