# PHP AMQP Example application

## Install the AMQP extension locally

First you need librabbitmq, the C-libary. 

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

Install pear and use ```pecl``` to compile and install the AMQP extension.

```
wget http://pear.php.net/go-pear.phar
php -d detect_unicode=0 go-pear.phar
sudo pecl install amqp
```

Enable it in ```php.ini```.

```
extension=amqp.so
```

