# PHP AMQP Example application

This is a simple example applications which shows how you get up to speed with AMQP and PHP on CloudControl. 

The applications connects to the RabbitMQ cluster, declares an exchange, a queue, and makes a binding between them. A messages is then published to the exchange, routed to the queue and the application then polls the queue and outputs the message body to the user. 

## Install the AMQP extension locally

To try this out locally you need to take the following steps:

First you need ```librabbitmq```, the C-library.

```
git clone git://github.com/alanxz/rabbitmq-c.git
cd rabbitmq-c
git submodule init
git submodule update
autoreconf -i
./configure
make
make install
```

Install pear if you not already got that. 

```
wget http://pear.php.net/go-pear.phar
php -d detect_unicode=0 go-pear.phar
```

Then use ```pecl``` to compile and install the AMQP extension.

```
sudo pecl install amqp
```

Enable it in ```php.ini```.

```
extension=amqp.so
```

