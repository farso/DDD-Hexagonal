<?php

namespace UicBundle\Infrastructure\Messaging\PhpAmqpLib;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 10/11/16
 * Time: 11:32
 */
class PhpAmqpLibCentreCreatedConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        $type = $msg->get('type');

        if ('UicBundle\Domain\Entity\Centre\CentreCreated' === $type) {

            $event = json_decode($msg->body);

            $eventId = json_decode($event->event_id);
            $eventOccurredOn = json_decode($event->occurred_on);
            $eventTypeName = json_decode($event->type_name);
            $eventBody = json_decode($event->event_body);

            echo ' ----------------------- '."\n";
            echo ' nou event trobat: ';
            echo " id: $eventId occurredOn: $eventOccurredOn typename: $eventTypeName body: "."\n";
            var_dump($eventBody);

            return true;

        }

        return false;

    }
}