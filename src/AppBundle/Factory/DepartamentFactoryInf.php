<?php
//1.0.2
namespace AppBundle\Factory;

use AppBundle\Entity\Departament\Departament;

/**
 * DepartamentFactoryInf
 *
 * Factory per transformar un Departament de Domini cap a Infraestructura
 * 
 */
class DepartamentFactoryInf
{
   /**
     * Es genera una nova instància de INF a partir d'una de DOM
     * @param  array $departamentDom [description]
     * @return [type]            [description]
     */
    public static function create(array $departamentDom) {
        //@todo comprovacio dels noms de les key de l'array.
        $id = $departamentDom['id'];
        $nom = $departamentDom['nombre'];
        $centreId = $departamentDom['centreId'];
        $codigoMec = $departamentDom['codigoMec'];
        $centreOficialId = $departamentDom['centreOficialId'];

        $departamentInf = new Departament($id, $nom, $centreId, $codigoMec, $centreOficialId);
        return $departamentInf;
    }

    public static function transform($departamentsDomini) {
    	if (is_array($departamentsDomini)) {
    		$departamentsInf = array();
    		foreach($departamentsDomini as $departamentDomini) {

    			$departamentsInf[] = self::create($departamentDomini->toArray());

    		}
    		return $departamentsInf;
    	}
    	return null;
    }

    /**
     * Per poder generar un formulari de Symfony necessitem l'entitat buida 
     * per a la seva associació automàtica.
     * @return Departament nova entitat buida de departament de infraestructura
     */
    public static function emptyEntity() {
        return new Departament();
    }
}