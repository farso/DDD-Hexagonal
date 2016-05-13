<?php
//1.0.2
namespace AppBundle\Factory;

use AppBundle\Entity\TipusCentre;

/**
 * TipusCentreFactoryInf
 *
 * Factory per transformar un TipusCentre de Domini cap a Infraestructura
 * 
 */
class TipusCentreFactoryInf
{
   /**
     * Es genera una nova instància de INF a partir d'una de DOM
     * @param  array $tipusCentreDom [description]
     * @return [type]            [description]
     */
    public static function create(array $tipusCentreDom) {
        //@todo comprovacio dels noms de les key de l'array.
        $id = $tipusCentreDom['id'];
        $descriEsp = $tipusCentreDom['descriEsp'];
        $descriEng = $tipusCentreDom['descriEng'];
        $descriCat = $tipusCentreDom['descriCat'];
        
        $tipusCentreInf = new TipusCentre($id, $descriCat, $descriEsp, $descriEng);
        return $tipusCentreInf;
    }

    public static function transform($tipusCentresDomini) {
    	if (is_array($tipusCentresDomini)) {
    		$tipusCentresInf = array();
    		foreach($tipusCentresDomini as $tipusCentreDomini) {

    			$tipusCentresInf[] = self::create($tipusCentreDomini->toArray());

    		}
    		return $tipusCentresInf;
    	}
    	return null;
    }

    /**
     * Per poder generar un formulari de Symfony necessitem l'entitat buida 
     * per a la seva associació automàtica.
     * @return TipusCentre nova entitat buida de tipusCentre de infraestructura
     */
    public static function emptyEntity() {
        return new TipusCentre();
    }
}