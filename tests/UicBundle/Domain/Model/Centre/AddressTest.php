<?php

namespace Tests\UicBundle\Domain\Entity\Centre;

use UicBundle\Domain\Entity\Centre\Address;

/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 10/11/16
 * Time: 13:21
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{
    private $street;

    public function setUp()
    {
        $this->street = ' a street ';
    }

    /**
     * @test
     */
    public function createAddressShouldWriteTheStreet()
    {
        $anAddress = new Address($this->street);

        $this->assertEquals($anAddress->getCarrer(), $this->street);

    }

    /**
     * @test
     */
    public function setStreetShouldModifyAddress()
    {
        $anAddress = new Address($this->street);
        $anAddress->setCarrer(' setting the street');

        $this->assertNotEquals($anAddress->getCarrer(), $this->street);
    }

}