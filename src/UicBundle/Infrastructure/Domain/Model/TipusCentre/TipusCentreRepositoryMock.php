<?php
/**
 * Created by PhpStorm.
 * User: andreu
 * Date: 20/09/16
 * Time: 16:10
 */

namespace UicBundle\Infrastructure\Domain\Model\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Infrastructure\Domain\Model\RepositoryMock;

final class TipusCentreRepositoryMock extends RepositoryMock  implements TipusCentreRepositoryInterface
{
    public function create(TipusCentre $tipusCentre)
    {
        // TODO
    }

    public function delete(TipusCentre $tipusCentre)
    {
        // TODO
    }

    public function exists($fieldName, $fieldValue, $id = null)
    {
        // TODO: Implement exists() method.
    }

    public function fill()
    {
        $tipusCentre1 = TipusCentre::create(
            array(
                "descriCat" => "Tipus Centre 1",
                "descriEsp" => "Tipo Centro 1",
                "descriEng" => "Center Type 1"
            )
        );

        $tipusCentre2 = TipusCentre::create(
            array(
                "descriCat" => "Tipus Centre 2",
                "descriEsp" => "Tipo Centro 2",
                "descriEng" => "Center Type 2"
            )
        );

        $this->entities[] = $tipusCentre1;
        $this->entities[] = $tipusCentre2;
    }

    public function getFirstTipusCentre()
    {
        if (sizeof($this->entities) == 0) $this->fill();

        return $this->entities[0];
    }
}
