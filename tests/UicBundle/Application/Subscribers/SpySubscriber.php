<?php

namespace Tests\UicBundle\Application\Subscribers;

use uic\ddd\Application\Event\DomainEventSubscriber;

/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 10/11/16
 * Time: 14:18
 */
class SpySubscriber implements DomainEventSubscriber
{
    private $aDomainEvent;

    public function handle($aDomainEvent)
    {
        $this->aDomainEvent = $aDomainEvent;
    }

    public function isSubscribedTo($aDomainEvent)
    {
        return true;
    }

    public function domainEvent()
    {
        return $this->aDomainEvent;
    }

}