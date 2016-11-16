<?php

namespace UicBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use uic\ddd\Application\Notification\NotificationService;

/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 08/11/16
 * Time: 13:00
 */
class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:test')
            ->setDescription('Test command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /**
         *    extends ContainerAwareCommand
         * $this->getContainer()->get('doctrine')->getManager();
         *
         * $this->getContainer()->get('app.eventstore');
         *
         * var_dump(get_class($this->em->getRepository('UicBundle:Centre\Centre')));
         */

        $output->writeln(sprintf('<info>test command success!</info>'));
    }

}