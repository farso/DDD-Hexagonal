<?php
namespace UicBundle\Domain\Entity\TipusCentre;

use Ramsey\Uuid\Uuid;
/**
 * Class TipusCentreId.
 */
class TipusCentreId
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
     * @param TipusCentreId $TipusCentreId
     *
     * @return bool
     */
    public function equals(TipusCentreId $TipusCentreId)
    {
        return $this->id() === $TipusCentreId->id();
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}