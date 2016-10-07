<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 13:14
 */

namespace UicBundle\DDD\Domain;


interface DomainEvent
{
    /**
     * @return \DateTime
     */
    public function occurredOn();
}