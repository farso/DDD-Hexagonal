#!/usr/bin/env bash

#echo "///////////////////////////////////////////////"
#echo "Updating canonical repositories..."
#echo "///////////////////////////////////////////////"
#apt-get update > /dev/null

#echo "///////////////////////////////////////////////"
#echo "Installing apache2..."
#echo "///////////////////////////////////////////////"
#apt-get install --assume-yes apache2

echo "///////////////////////////////////////////////"
echo "Installing rabbitmq..."
echo "///////////////////////////////////////////////"
sudo su
sudo echo "deb http://www.rabbitmq.com/debian testing main" >> /etc/apt/sources.list
wget https://www.rabbitmq.com/rabbitmq-signing-key-public.asc
sudo apt-key add rabbitmq-signing-key-public.asc
sudo apt-get update
sudo apt-get install --assume-yes  rabbitmq-server 
sudo rabbitmq-plugins enable rabbitmq_management
sudo rabbitmqctl add_user admin nimda
sudo rabbitmqctl set_user_tags admin administrator
sudo rabbitmqctl set_permissions -p / admin ".*" ".*" ".*"


echo "///////////////////////////////////////////////"
echo "Installing php..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes php5-cli
#apt-get install --assume-yes libapache2-mod-php5
apt-get install --assume-yes php5-mcrypt php5-intl php5-pgsql php5-curl

echo "///////////////////////////////////////////////"
echo "Installing PostgreSQL..."
echo "///////////////////////////////////////////////"
export LANGUAGE=ca_ES.UTF-8
export LC_ALL=en_US.UTF-8
apt-get install --assume-yes postgresql
apt-get install --assume-yes postgresql-contrib
sudo -u postgres psql -U postgres -d postgres -c "alter user postgres with password 'postgres'"


echo "///////////////////////////////////////////////"
echo "Installing curl..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes curl

echo "///////////////////////////////////////////////"
echo "Installing git..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes git

echo "///////////////////////////////////////////////"
echo "Installing symfony installer..."
echo "///////////////////////////////////////////////"
curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony
chmod a+x /usr/local/bin/symfony

echo "///////////////////////////////////////////////"
echo "Setting php-cli date.timezone to Madrid..."
echo "///////////////////////////////////////////////"
sudo sed -i "s/^;date.timezone =$/date.timezone = \"Europe\/Madrid\"/" /etc/php5/cli/php.ini |grep "^timezone" /etc/php5/cli/php.ini

echo "///////////////////////////////////////////////"
echo "Setting postgres to accept connections"
echo "///////////////////////////////////////////////"
cp -a  /etc/postgresql/9.3/main/postgresql.conf   /etc/postgresql/9.3/main/postgresql.conf2
cp -a  /etc/postgresql/9.3/main/pg_hba.conf /etc/postgresql/9.3/main/pg_hba.conf2
awk 'NR==59 {$0="listen_addresses='\''*'\''"} 1' /etc/postgresql/9.3/main/postgresql.conf > /etc/postgresql/9.3/main/postgresql.conf2
mv /etc/postgresql/9.3/main/postgresql.conf2  /etc/postgresql/9.3/main/postgresql.conf
awk 'NR==86 {$0="host all all 172.20.2.0/24 trust"} 1' /etc/postgresql/9.3/main/pg_hba.conf > /etc/postgresql/9.3/main/pg_hba.conf2
mv /etc/postgresql/9.3/main/pg_hba.conf2 /etc/postgresql/9.3/main/pg_hba.conf

awk 'NR==85 {$0=""} 1' /etc/postgresql/9.3/main/pg_hba.conf > /tmp/pg_hba.conf2
awk 'NR==85 {$0="local   all             postgres                                trust"} 1' /tmp/pg_hba.conf2 > /tmp/pg_hba.conf3
mv /tmp/pg_hba.conf3 /etc/postgresql/9.3/main/pg_hba.conf 
sudo /etc/init.d/postgresql reload

psql -U postgres < /vagrant/inici_bd.sql

alias ll='ls -la --color' 

echo "////////////////////////////////////////////////////////"
echo "Copy the folders /application and /domain to vendor/uic/"
echo "////////////////////////////////////////////////////////"
cp -fr /application /vagrant/vendor/uic/
cp -fr /domain /vagrant/vendor/uic/

