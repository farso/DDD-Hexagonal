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

# Add Debian Wheezy backports repository to obtain init-system-helpers
gpg --keyserver pgpkeys.mit.edu --recv-key 7638D0442B90D010
gpg -a --export 7638D0442B90D010 | sudo apt-key add -
echo 'deb http://ftp.debian.org/debian wheezy-backports main' | sudo tee /etc/apt/sources.list.d/wheezy_backports.list

# Add Erlang Solutions repository to obtain esl-erlang
wget -O- https://packages.erlang-solutions.com/debian/erlang_solutions.asc | sudo apt-key add -
echo 'deb https://packages.erlang-solutions.com/debian wheezy contrib' | sudo tee /etc/apt/sources.list.d/esl.list

sudo apt-get update
sudo apt-get install  --assume-yes init-system-helpers socat esl-erlang

# continue with RabbitMQ installation as explained above
wget -O- https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | sudo apt-key add -
echo 'deb http://www.rabbitmq.com/debian/ testing main' | sudo tee /etc/apt/sources.list.d/rabbitmq.list

sudo apt-get update
sudo apt-get install  --assume-yes rabbitmq-server

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

sudo cp /vagrant/pg_hba.conf /etc/postgresql/9.3/main/pg_hba.conf

sudo /etc/init.d/postgresql stop
sudo /etc/init.d/postgresql start

psql -U postgres < /vagrant/inici_bd.sql
echo "///////////////////////////////////////////////"
echo "System settings"
echo "///////////////////////////////////////////////"
alias ll='ls -la --color'
source /vagrant/script.sh 
