<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 15:40
 */

namespace UicBundle\DDD\Application;


interface EventStore
{
    public function append($aDomainEvent);

    public function allStoredEventsSince($anEventId);
}