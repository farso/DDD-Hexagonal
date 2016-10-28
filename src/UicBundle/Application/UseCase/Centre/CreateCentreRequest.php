<?php
/**
 * Created by PhpStorm.
 * User: ddt
 * Date: 23/09/16
 * Time: 11:51
 */

namespace UicBundle\Application\UseCase\Centre;


class CreateCentreRequest
{
    private $codi;
    private $mailCentre;
    private $codiOficial;
    private $color;
    private $tipusCentre;
    private $carrer;
    private $nom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCodi()
    {
        return $this->codi;
    }

    /**
     * @param mixed $codi
     */
    public function setCodi($codi)
    {
        $this->codi = $codi;
    }

    /**
     * @return mixed
     */
    public function getMailCentre()
    {
        return $this->mailCentre;
    }

    /**
     * @param mixed $mailCentre
     */
    public function setMailCentre($mailCentre)
    {
        $this->mailCentre = $mailCentre;
    }

    /**
     * @return mixed
     */
    public function getCodiOficial()
    {
        return $this->codiOficial;
    }

    /**
     * @param mixed $codiOficial
     */
    public function setCodiOficial($codiOficial)
    {
        $this->codiOficial = $codiOficial;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getTipusCentre()
    {
        return $this->tipusCentre;
    }

    /**
     * @param mixed $tipusCentre
     */
    public function setTipusCentre($tipusCentre)
    {
        $this->tipusCentre = $tipusCentre;
    }

    /**
     * @return mixed
     */
    public function getCarrer()
    {
        return $this->carrer;
    }

    /**
     * @param mixed $carrer
     */
    public function setCarrer($carrer)
    {
        $this->carrer = $carrer;
    }



}