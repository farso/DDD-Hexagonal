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
use UicBundle\Domain\Entity\TipusCentre\TipusCentreId;
use UicBundle\Infrastructure\Domain\Model\RepositoryMock;

final class TipusCentreRepositoryMock extends RepositoryMock  implements TipusCentreRepositoryInterface
{
    public function matching($arg)
    {
        // TODO: Implement matching() method.
    }

    public function fill()
    {
        $tipusCentre1 = new TipusCentre(new TipusCentreId(), "Tipus Centre 1", "Tipo Centro 1", "Center Type 1");
        $tipusCentre2 = new TipusCentre(new TipusCentreId(), "Tipus Centre 2", "Tipo Centro 2", "Center Type 2");
        $this->entities[] = $tipusCentre1;
        $this->entities[] = $tipusCentre2;
    }
}