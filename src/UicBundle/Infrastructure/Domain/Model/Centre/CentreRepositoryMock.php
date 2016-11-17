<?php
namespace UicBundle\Infrastructure\Domain\Model\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Domain\Entity\Centre\Centre;
use UicBundle\Infrastructure\Domain\Model\RepositoryMock;

/**
 * Class CentreRepositoryMock
 * @package UicBundle\Infrastructure\Domain\Model\Centre
 */
final class CentreRepositoryMock extends RepositoryMock implements CentreRepositoryInterface
{
    public function create(Centre $centre)
    {
        parent::createEntity($centre);
    }

//    public function update(Centre $centre)
//    {
//        parent::update($centre);
//    }

    public function delete(Centre $centre)
    {
        parent::deleteEntity($centre);
    }

    public function exists($fieldName, $fieldValue, $id = null)
    {
        $centres = array();

        foreach ($this->entities as $centre) {

            if ($centre->getId() != $id) {
                if ($fieldName == "codi" && $fieldValue == $centre->getCodi()) {
                    $centres[] = $centre;
                }

                if ($fieldName == "nombre" && $fieldValue == $centre->getNombre()) {
                    $centres[] = $centre;
                }
            }

        }
        return $centres;
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $centre = null;

        foreach ($this->entities as $centre) {

            foreach($criteria as $key => $value) {

                if ($key == 'nombre' && $value == $centre->getNombre()) return $centre;
            }
        }

        return $centre;
    }

    public function fill()
    {
        // TODO: Implement fill() method.
    }
}
