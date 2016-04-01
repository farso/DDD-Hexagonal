<?php
//1.0.2
namespace AppBundle\Factory;

use AppBundle\Entity\Centre;

/**
 * CentreFactory
 *
 * Factory per transformar un Centre de Domini cap a Infraestructura
 * 
 */
class CentreFactory
{
    public static function create($id, $nom, $codi, $mailCentre, $codiOficial) {
        return new Centre($id, $nom, $codi, $mailCentre, $codiOficial);
    }

    public static function transform($centresDomini) {
    	if (is_array($centresDomini)) {
    		$centresInf = array();
    		foreach($centresDomini as $centreDomini) {

    			$centresInf[] = self::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi(),$centreDomini->getMailCentre(),$centreDomini->getCodiOficial());

    		}
    		return $centresInf;
    	}
    	return null;
    }
}