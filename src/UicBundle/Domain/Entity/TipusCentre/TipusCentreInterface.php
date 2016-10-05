<?php
//1.0.2
namespace UicBundle\Domain\Entity\TipusCentre;

/**
 * CentreInterface
 */
interface TipusCentreInterface
{
    
    public function getId();
    
    public function getDescriCat();

    public function getDescriEsp();

    public function getDescriEng();

    public function update($descriCat, $descriEsp, $descriEng);

}

