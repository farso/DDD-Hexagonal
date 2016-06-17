<?php
//1.0.2
namespace UicBundle\Domain\Entity\TipusCentre;

use UicBundle\Domain\Entity\EntityInterface;
/**
 * CentreInterface
 */
interface TipusCentreInterface extends  EntityInterface
{
    
    public function getId();
    
    public function getDescriCat();

    public function getDescriEsp();

    public function getDescriEng();

    public function update($descriCat, $descriEsp, $descriEng);

}

