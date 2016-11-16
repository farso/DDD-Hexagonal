<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 13:50
 */

namespace UicBundle\Domain\Entity\Centre;

use uic\ddd\Domain\Event\DomainEvent;
use uic\ddd\Domain\Event\PublishableDomainEvent;

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