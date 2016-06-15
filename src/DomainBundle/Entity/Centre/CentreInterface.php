<?php
//1.0.2
namespace DomainBundle\Entity\Centre;

use DomainBundle\Entity\EntityInterface;

/**
 * CentreInterface
 */
interface CentreInterface extends EntityInterface
{
    
    public function getId();
    
    public function getNombre();

    public function getCodi();

    public function getCodiOficial();

    public function getMailCentre();

    public function getColor();

    public function getTipusCentre();
    
    public function update($params);

}
