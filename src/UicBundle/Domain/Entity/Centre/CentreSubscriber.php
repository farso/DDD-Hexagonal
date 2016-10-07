<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 14:00
 */

namespace UicBundle\Domain\Entity\Centre;


use UicBundle\DDD\Domain\DomainEvent;
use UicBundle\DDD\Domain\DomainEventSubscriber;

class CentreSubscriber implements DomainEventSubscriber
{
    public function handle($aDomainEvent)
    {
        echo ' handle de '.get_class($aDomainEvent).' occurred on '. $aDomainEvent->occurredOn()->getTimestamp();
    }


    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof CentreCreated;
    }

}