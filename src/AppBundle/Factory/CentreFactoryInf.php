<?php
//1.0.2
namespace AppBundle\Factory;

use AppBundle\Entity\Centre\Centre;
use AppBundle\Entity\TipusCentre\TipusCentre;

/**
 * CentreFactoryInf
 *
 * Factory per transformar un Centre de Domini cap a Infraestructura
 * 
 */
class CentreFactoryInf
{
   /**
     * Es genera una nova instància de INF a partir d'una de DOM
     * @param  array $centreDom [description]
     * @return [type]            [description]
     */
    public static function create(array $centreDom) {
        //@todo comprovacio dels noms de les key de l'array.
        $id = $centreDom['id'];
        $nom = $centreDom['nombre'];
        $codi = $centreDom['codi'];
        $mailCentre = $centreDom['mailCentre'];
        $codiOficial = $centreDom['codiOficial'];
        $color = $centreDom['color'];
        $tipusCentre = $centreDom['tipusCentre'];
        
        $centreInf = new Centre($id, $nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre);
        return $centreInf;
    }

    public static function transform($centresDomini) {
    	if (is_array($centresDomini)) {
    		$centresInf = array();
    		foreach($centresDomini as $centreDomini) {

    			$centresInf[] = self::create($centreDomini->toArray());

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