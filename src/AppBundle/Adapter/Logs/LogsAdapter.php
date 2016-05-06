<?php

namespace AppBundle\Adapter\Logs;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class LogsAdapter
{

	public function writeLog($codi, $missatge)
	{
		// obrir socket rabbit
		$connection = new AMQPStreamConnection('10.10.10.10', 5672, 'admin', 'nimda');
		$channel = $connection->channel(); 
		
		// agafar la cua que toqui
		$channel->queue_declare('Log', false, false, false, false);

		// enviar msg
		$msg = new AMQPMessage($missatge);
		$channel->basic_publish($msg, '', 'Log');


		// tancar la connexió
		$channel->close();
		$connection->close();
	}




}