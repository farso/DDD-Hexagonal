<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 10/11/16
 * Time: 13:54
 */

namespace Tests\UicBundle\Domain\Entity\Centre;

use uic\ddd\Domain\Event\DomainEventPublisher;
use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Domain\Entity\Centre\Centre;
use Tests\UicBundle\Application\Subscribers\SpySubscriber;
use UicBundle\Domain\Entity\Centre\CentreCreated;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;


class CentreTest extends \PHPUnit_Framework_TestCase
{
    private $fieldsCentre;
    private $fieldsTipusCentre;
    private $street;

    public function setUp()
    {
        $this->street = 'a street';

        $this->fieldsTipusCentre = array(
            'descriCat' => 'tipus centre',
            'descriEsp' => 'tipus centre',
            'descriEng' => 'tipus centre',
        );

        $this->fieldsCentre = array(
            'nombre' => 'nom',
            'codi' => 'codi ',
            'mailCentre' => 'mail',
            'codiOficial' => 'codiOficial',
            'color' => 'color',
            'tipusCentre' => TipusCentre::create($this->fieldsTipusCentre),
            'address' => new Address($this->street)
        );



    }

    /**
     * @test
     * @
     */
    public function updateShouldSetAllAtributes()
    {
        $centre = Centre::create($this->fieldsCentre);

        $fieldsUpdated = $this->updateFields();

        $centre->update(
            $fieldsUpdated['nombre'],
            $fieldsUpdated['codi'],
            $fieldsUpdated['mailCentre'],
            $fieldsUpdated['codiOficial'],
            $fieldsUpdated['color'],
            $fieldsUpdated['tipusCentre'],
            $fieldsUpdated['address']
        );

        $this->assertEquals($centre->getNombre(),$fieldsUpdated['nombre']);
        $this->assertEquals($centre->getCodi(),$fieldsUpdated['codi']);
        $this->assertEquals($centre->getMailCentre(),$fieldsUpdated['mailCentre']);
        $this->assertEquals($centre->getCodiOficial(),$fieldsUpdated['codiOficial']);
        $this->assertEquals($centre->getColor(),$fieldsUpdated['color']);
        $this->assertEquals($centre->getTipusCentre()->getDescriCat(),$fieldsUpdated['tipusCentre']->getDescriCat());
        $this->assertEquals($centre->getTipusCentre()->getDescriEng(),$fieldsUpdated['tipusCentre']->getDescriEng());
        $this->assertEquals($centre->getTipusCentre()->getDescriEsp(),$fieldsUpdated['tipusCentre']->getDescriEsp());

    }

    /**
     * @test
     */
    public function itShouldPublishCentreCreatedEvent()
    {
        $spySubscriber = new SpySubscriber();

        $id = DomainEventPublisher::instance()->subscribe($spySubscriber);

        Centre::create($this->fieldsCentre);

        DomainEventPublisher::instance()->unsubscribe($id);

        $this->assertInstanceOf(CentreCreated::class, $spySubscriber->domainEvent());

    }




    private function updateFields()
    {
        return array(
            'nombre' => 'nom updated',
            'codi' => 'codi updated',
            'mailCentre' => 'mail updated',
            'codiOficial' => 'codiOficial updated',
            'color' => 'color updated',
            'tipusCentre' => TipusCentre::create(array(
                'descriCat' => 'tipus centre updated',
                'descriEsp' => 'tipus centre updated',
                'descriEng' => 'tipus centre updated'
            )),
            'address' => new Address($this->street)
        );
    }

}