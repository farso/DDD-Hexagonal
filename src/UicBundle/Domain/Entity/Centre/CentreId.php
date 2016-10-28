<?php
namespace UicBundle\Domain\Entity\Centre;

use Ramsey\Uuid\Uuid;

/**
 * Class CentreId.
 */
class CentreId
{
    /**
     * @var string
     */
    private $id;
    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }
    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }
    /**
     * @param CentreId $CentreId
     *
     * @return bool
     */
    public function equals(CentreId $CentreId)
    {
        return $this->id() === $CentreId->id();
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}
