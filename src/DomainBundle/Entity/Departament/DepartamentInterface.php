<?php
//1.0.2
namespace DomainBundle\Entity\Departament;

use DomainBundle\Entity\EntityInterface;

/**
 * DepartamentInterface
 */
interface DepartamentInterface extends EntityInterface
{
    
    public function getId();
    
    public function getNombre();

    public function getCentreId();

    public function getCentreOficialId();

    public function getCodigoMec();
    
    public function update($nom, $centreId, $centreOficialId, $codigoMec);
}
