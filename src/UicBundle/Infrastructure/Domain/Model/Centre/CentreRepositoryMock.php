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
        parent::create($centre);
    }

    public function update(Centre $centre)
    {
        parent::update($centre);
    }

    public function delete(Centre $centre)
    {
        parent::delete($centre);
    }

    public function matching($arg)
    {
        // TODO: Implement matching() method.
    }

    public function fill()
    {
        // TODO: Implement fill() method.
    }
}
