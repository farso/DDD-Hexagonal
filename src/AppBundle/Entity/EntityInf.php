<?php
namespace AppBundle\Entity;

use AppBundle\Entity\EntityInfInterface;

/**
 * Centre
 */
class EntityInf implements EntityInfInterface

{

	public function toArray(){
		$objectArray = array();
		$class_vars = get_object_vars($this);

		foreach ($class_vars as $name => $value) {
    		$objectArray[$name] = $value;
		}
		// echo "<pre>";
		// print_r($objectArray);
		// exit;
		
		return $objectArray;
	}

}


