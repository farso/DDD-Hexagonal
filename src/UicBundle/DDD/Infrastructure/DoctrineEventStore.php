<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 15:44
 */

namespace UicBundle\DDD\Infrastructure;


use Doctrine\ORM\EntityRepository;
use UicBundle\DDD\Application\EventStore;
use UicBundle\DDD\Domain\StoredEvent;

class DoctrineEventStore extends EntityRepository implements EventStore
{
    public function append($aDomainEvent)
    {
        $storedEvent = new StoredEvent(
            get_class($aDomainEvent),
            $aDomainEvent->occurredOn(),
            json_encode(serialize($aDomainEvent))
        );

        $this->getEntityManager()->persist($storedEvent);
        $this->getEntityManager()->flush($storedEvent);
    }

    public function allStoredEventsSince($anEventId)
    {
        // TODO: Implement allStoredEventsSince() method.
    }


}