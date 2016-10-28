<?php
//1.0.2
namespace UicBundle\Domain\Entity\Centre;

use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Domain\Entity\Centre\Address;

/**
 * CentreInterface
 */
interface CentreInterface
{
    
    public function getId();
    
    public function getNombre();

    public function getCodi();

    public function getCodiOficial();

    public function getMailCentre();

    public function getColor();

    public function getTipusCentre();

    public function getAddress();
    
    public function update($nom, $codi, $mailCentre, $codiOficial, $color, TipusCentre $tipusCentre, Address $address);
}
