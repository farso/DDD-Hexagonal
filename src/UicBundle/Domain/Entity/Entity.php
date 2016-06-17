<?php
namespace UicBundle\Domain\Entity;

/**
 * Centre
 */
class Entity
{
	public function toArray()
	{
		$objectArray = array();
		$class_vars = get_object_vars($this);

		foreach ($class_vars as $name => $value) {
			//@todo falta el cas de les classes CentreId, TipusCentreId 
			if ($value instanceof EntityInterface) {
				$objectArray[$name] = $value->toArray();
			} else {
				$objectArray[$name] = $value;
			}
		}
		
		return $objectArray;
	}
}
