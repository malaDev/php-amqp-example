<?php

$string = file_get_contents($_ENV['CRED_FILE'], false);
if ($string == false) {
  die('FATAL: Could not read credentials file');
}
$creds = json_decode($string, true);
$cloudamqp_url = $creds['CLOUDAMQP']['CLOUDAMQP_URL'];

$cloudamqp_config = parse_url($cloudamqp_url);
// Create a connection
$cnn = new AMQPConnection();
$cnn->setHost($cloudamqp_config['host']);
$cnn->setLogin($cloudamqp_config['user']);
$cnn->setPassword($cloudamqp_config['pass']);
$cnn->setVhost(substr($cloudamqp_config['path'], 1));
$cnn->connect();

// Create a channel
$ch = new AMQPChannel($cnn);

// Declare a new exchange
$ex = new AMQPExchange($ch);
$ex->setName('exchange1');
$ex->setType("fanout");
$ex->declare();

// Create a new queue
$q = new AMQPQueue($ch);
$q->setName('queue1');
$q->declare();

// Bind it on the exchange to routing.key
$q->bind('exchange1', 'routing.key');

// Publish a message to the exchange with a routing key
$ex->publish('hello amqp!', 'routing.key');

// Read from the queue
//$msg = $q->consume();

//get the messages
$message = $q->get(AMQP_AUTOACK);

echo $message->getBody();
?>
