<?php
//1.0.2
namespace ApplicationBundle\Factory;

use DomainBundle\Entity\Centre\Centre;
use DomainBundle\Entity\Centre\CentreId;

/**
 * CentreFactory
 *
 * Factory per transformar un Centre de Infraestructura cap a Domini
 * 
 */
class CentreFactory
{
    /**
     * Es genera una nova instància de DOMINI a partir d'una de INF
     * @param  array $centreInf [description]
     * @return [type]            [description]
     */
    public static function create(array $centreInf) {

        //@todo comprovacio dels noms de les key de l'array.
        
        $nom = $centreInf['nombre'];
        $codi = $centreInf['codi'];
        $mailCentre = $centreInf['mailCentre'];
        $codiOficial = $centreInf['codiOficial'];
        $color = $centreInf['color'];
        //$tipusCentre = $centreInf['tipusCentre']; // arriba un tipusCentre de domini buscar per use case

        $centreId = new CentreId();
        //return new Centre($centreId, $nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre);
        return new Centre($centreId, $nom, $codi, $mailCentre, $codiOficial, $color);
    }

    public static function instance(array $centreInf) {

        //@todo comprovacio dels noms de les key de l'array.
        $id = $centreInf['id'];
        $nom = $centreInf['nombre'];
        $codi = $centreInf['codi'];
        $mailCentre = $centreInf['mailCentre'];
        $codiOficial = $centreInf['codiOficial'];
        $color = $centreInf['color'];
        $tipusCentre = $centreInf['tipusCentre']; // arriba un tipusCentre de domini buscar per use case

        $centreId = new CentreId($id);
        return new Centre($centreId, $nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre);
    }
}