<?php

namespace UicBundle\Command;

use Doctrine\ORM\EntityManager;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use uic\ddd\Application\Event\EventStore;
use uic\ddd\Application\Notification\NotificationService;
use uic\ddd\Application\Notification\PublishedMessageTracker;
use uic\ddd\Infrastructure\Notification\RabbitMqMessageProducer;

/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 08/11/16
 * Time: 13:00
 */
class PushNotificationsCommand extends ContainerAwareCommand
{
    private $em;
    private $eventStore;
    private $publishedMessageTracker;

    public function __construct(EntityManager $em,
                                EventStore $eventStore,
                                PublishedMessageTracker $publishedMessageTracker,
                                $name = null)
    {
        $this->em = $em;
        $this->eventStore = $eventStore;
        $this->publishedMessageTracker = $publishedMessageTracker;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('domain:events:spread')
            ->setDescription('Notify all domain events via messaging')
            ->addArgument('exchange-name', InputArgument::OPTIONAL, 'Exchange name to publish events to', 'centres')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messageProducer = new RabbitMqMessageProducer(
            new AMQPStreamConnection('localhost',5672,'admin','nimda')
        );

        $notificationService = new NotificationService(
            $this->eventStore,
            $this->publishedMessageTracker,
            $messageProducer
        );

        $numberOfNotifications = $notificationService->publishNotifications($input->getArgument('exchange-name'));
        $output->writeln(sprintf('<comment>%d</comment> <info>notification(s) sent!</info>', $numberOfNotifications));
    }

}