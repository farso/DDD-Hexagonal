<?php
//1.0.2
namespace UicBundle\Application\Factory;

use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Domain\Entity\TipusCentre\TipusCentreId;

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
    public static function create(array $tipusCentreInf)
    {

        //@todo comprovacio dels noms de les key de l'array.
        
        $descriCat = $tipusCentreInf['descriCat'];
        $descriEsp = $tipusCentreInf['descriEsp'];
        $descriEng = $tipusCentreInf['descriEng'];

        $tipusCentreId = new TipusCentreId();
        return new TipusCentre($tipusCentreId, $descriCat, $descriEsp, $descriEng);
    }
}