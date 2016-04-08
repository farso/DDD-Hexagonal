<?php
//1.0.2
namespace AppBundle\Factory;

use AppBundle\Entity\Centre;

/**
 * CentreFactoryInf
 *
 * Factory per transformar un Centre de Domini cap a Infraestructura
 * 
 */
class CentreFactoryInf
{
    public static function create($id, $nom, $codi, $mailCentre, $codiOficial) {
        $centreInf = new Centre($id, $nom, $codi, $mailCentre, $codiOficial);
        return $centreInf;
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

    /**
     * Per poder generar un formulari de Symfony necessitem l'entitat buida 
     * per a la seva associació automàtica.
     * @return Centre nova entitat buida de centre de infraestructura
     */
    public static function emptyEntity() {
        return new Centre();
    }
}