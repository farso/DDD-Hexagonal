<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 14:00
 */

namespace UicBundle\Application\Subscribers\Centre;

use uic\ddd\Domain\DomainEvent;
use uic\ddd\Application\DomainEventSubscriber;
use UicBundle\Domain\Entity\Centre\CentreCreated;

class CentreSubscriber implements DomainEventSubscriber
{
    public function handle($aDomainEvent)
    {
        //@todo si es deixa el die, surt el xivato però la transacció no fa el commit
        // trenca la teoria de 1 transacció -> 1 aggregate

        echo ' handle de '.get_class($aDomainEvent).' occurred on '. $aDomainEvent->occurredOn()->getTimestamp();
    }


    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof CentreCreated;
    }

}