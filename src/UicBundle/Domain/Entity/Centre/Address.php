<?php
//1.0.2
namespace UicBundle\Domain\Entity\Centre;


/**
 * Address
 */
class Address
{
    /**
     * @var string
     */
    protected $carrer;

    public function __construct($carrer)
    {
        $this->carrer = $carrer;
    }


    /**
     * Get carrer
     *
     * @return string
     */
    public function getCarrer()
    {
        return $this->carrer;
    }

    /**
     * Set carrer
     * @param string $carrer
     * @return string
     */
    public function setCarrer($carrer)
    {
        $this->carrer = $carrer;
    }
}
