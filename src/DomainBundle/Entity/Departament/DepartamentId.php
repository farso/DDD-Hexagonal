<?php
namespace DomainBundle\Entity\Departament;

use Ramsey\Uuid\Uuid;

/**
 * Class DepartamentId.
 */
class DepartamentId
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
     * @param DepartamentId $DepartamentId
     *
     * @return bool
     */
    public function equals(DepartamentId $DepartamentId)
    {
        return $this->id() === $DepartamentId->id();
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}
