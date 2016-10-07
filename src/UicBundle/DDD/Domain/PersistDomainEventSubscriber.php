<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 15:30
 */

namespace UicBundle\DDD\Domain;


use UicBundle\DDD\Application\EventStore;

class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    private $eventStore;

    public function __construct(/*EventStore $anEventStore*/)
    {
//        $this->eventStore = $anEventStore;
    }

    public function handle($aDomainEvent)
    {
        //$this->eventStore->append($aDomainEvent);
        echo ' append domain event';die();
    }

    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof PublishableDomainEvent;
    }

}