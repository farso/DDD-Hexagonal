<?php
//1.0.2
namespace ApplicationBundle\Factory;

use DomainBundle\Entity\TipusCentre\TipusCentre;
use DomainBundle\Entity\TipusCentre\TipusCentreId;

/**
 * TipusCentreFactory
 *
 * Factory per transformar un Centre de Infraestructura cap a Domini
 * 
 */
class TipusCentreFactory
{
    /**
     * Es genera una nova instància de DOMINI a partir d'una de INF
     * @param  array $tipusCentreInf [description]
     * @return [type]            [description]
     */
    public static function create(array $tipusCentre)
    {

        //@todo comprovacio dels noms de les key de l'array.
        $descriCat = $tipusCentre['descriCat'];
        $descriEsp = $tipusCentre['descriEsp'];
        $descriEng = $tipusCentre['descriEng'];

        $tipusCentreId = new TipusCentreId();
        return new TipusCentre($tipusCentreId, $descriCat, $descriEsp, $descriEng);
    }
}
