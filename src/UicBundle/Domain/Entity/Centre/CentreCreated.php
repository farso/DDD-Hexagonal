<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 13:50
 */

namespace UicBundle\Domain\Entity\Centre;


use UicBundle\DDD\Domain\DomainEvent;
use UicBundle\DDD\Domain\PublishableDomainEvent;

class CentreCreated implements DomainEvent, PublishableDomainEvent
{
    private $ocurredOn;

    public function __construct()
    {
        $this->ocurredOn = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    public function occurredOn()
    {
        return $this->ocurredOn;
    }


}