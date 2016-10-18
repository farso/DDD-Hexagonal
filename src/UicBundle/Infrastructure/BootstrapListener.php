<?php

namespace UicBundle\Infrastructure;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\ORM\EntityManager;
use uic\ddd\Domain\DomainEventPublisher;
use uic\ddd\Application\PersistDomainEventSubscriber;
use UicBundle\Application\Subscribers\Centre\CentreSubscriber;

/**
 * Created by PhpStorm.
 * User: ddt
 * Date: 18/10/16
 * Time: 12:24
 */
class BootstrapListener
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function bootstrapSubscribers(FilterControllerEvent $event)
    {
        DomainEventPublisher::instance()->subscribe(
            new CentreSubscriber(
                $this->em->getRepository('UicBundle:TipusCentre\TipusCentre')
            )
        );

        DomainEventPublisher::instance()->subscribe(
            new PersistDomainEventSubscriber(
                $this->em->getRepository('UicDDD:StoredEvent')
            )
        );
    }

}