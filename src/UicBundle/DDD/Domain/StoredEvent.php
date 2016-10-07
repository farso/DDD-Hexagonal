<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 15:45
 */

namespace UicBundle\DDD\Domain;


class StoredEvent implements DomainEvent
{
    private $occurredOn;
    private $typeName;
    private $eventBody;

    public function __construct($typeName, \DateTime $occurredOn, $eventBody)
    {
        $this->typeName = $typeName;
        $this->eventBody = $eventBody;
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }

}