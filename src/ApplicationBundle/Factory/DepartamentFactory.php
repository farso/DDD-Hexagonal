<?php
//1.0.2
namespace ApplicationBundle\Factory;

use DomainBundle\Entity\Departament\Departament;
use DomainBundle\Entity\Departament\DepartamentId;

/**
 * DepartamentFactory
 *
 * Factory per transformar un Departament de Infraestructura cap a Domini
 * 
 */
class DepartamentFactory
{
	/**
	 * Es genera una nova instància de DOMINI a partir d'una de INF
	 * @param  array $departamentInf [description]
	 * @return [type]            [description]
	 */
    public static function create(array $departamentInf) {

    	//@todo comprovacio dels noms de les key de l'array.
    	
    	$nom = $departamentInf['nombre'];
    	$centreId = $departamentInf['centreId'];
    	$codigoMec = $departamentInf['codigoMec'];
    	$centreOficialId = $departamentInf['centreOficialId'];

    	$departamentId = new DepartamentId();
        return new Departament($departamentId, $nom, $centreId, $codigoMec, $centreOficialId);
    }

    public static function instance(array $departamentInf) {

    	//@todo comprovacio dels noms de les key de l'array.
    	$id = $departamentInf['id'];
    	$nom = $departamentInf['nombre'];
    	$centreId = $departamentInf['centreId'];
    	$codigoMec = $departamentInf['codigoMec'];
    	$centreOficialId = $departamentInf['centreOficialId'];

    	$departamentId = new DepartamentId($id);
        return new Departament($departamentId, $nom, $centreId, $codigoMec, $centreOficialId);
    }
}