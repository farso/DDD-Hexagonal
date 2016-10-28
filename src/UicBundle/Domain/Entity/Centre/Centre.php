<?php
//1.0.2
namespace UicBundle\Domain\Entity\Centre;

use uic\ddd\Domain\DomainEventPublisher;
use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Domain\Entity\Centre\CentreId;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;

/**
 * Centre
 */
class Centre implements CentreInterface
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

    /**
     * @var Address
     */
    protected $address;


    private function __construct(CentreId $id, $nom, $codi, $mailCentre, $codiOficial, $color, TipusCentre $tipusCentre, Address $address)
    {
        $this->id = $id;
        $this->codi = $codi;
        $this->nombre = $nom;
        $this->mailCentre = $mailCentre;
        $this->codiOficial = $codiOficial;
        $this->color = $color;
        $this->tipusCentre = $tipusCentre;
        $this->address = $address;

        DomainEventPublisher::instance()->publish(
            new CentreCreated()
        );

    }

    /**
     * Es genera una nova instància de DOMINI a partir d'una de INF
     * @param  array $centreInf [description]
     * @return [type]            [description]
     */
    public static function create(array $centreInf) {

        //@todo comprovacio dels noms de les key de l'array.

        $nom = $centreInf['nombre'];
        $codi = $centreInf['codi'];
        $mailCentre = $centreInf['mailCentre'];
        $codiOficial = $centreInf['codiOficial'];
        $color = $centreInf['color'];
        $tipusCentre = $centreInf['tipusCentre']; // arriba un tipusCentre de domini buscar per use case
        $address = $centreInf['address']; // value object

        $centreId = new CentreId();
        return new self($centreId, $nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre, $address);
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

    /**
     * [getAddress description]
     * @return Address address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function update($nom, $codi, $mailCentre, $codiOficial, $color, TipusCentre $tipusCentre, Address $address)
    {
        //@todo validació atributs d'entitat (que siguin enters, char(1), ...)
        $this->nombre = $nom;
        $this->codi = $codi;
        $this->mailCentre = $mailCentre;
        $this->codiOficial = $codiOficial;
        $this->color = $color;
        $this->tipusCentre = $tipusCentre;
        $this->address = $address;
    }
}
