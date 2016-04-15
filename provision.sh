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
cat << EOF | su - postgres -c psql
alter user postgres password 'postgres';

-- Create extension for pgadmin
CREATE EXTENSION adminpack;

-- creem el schema de hexagonal
CREATE SCHEMA hexagonal
  AUTHORIZATION postgres;
-- Table: hexagonal.centros
CREATE TABLE hexagonal.centros
(
  codigo serial NOT NULL,
  uuid uuid NOT NULL,
  cod_centro character varying(5),
  nombre character varying(80),
  tipus uuid,
  mail_centre character varying(50),
  codigo_oficial character varying(8),
  CONSTRAINT centros__pkey PRIMARY KEY (uuid),
  CONSTRAINT centros__tipus_centres__fkey FOREIGN KEY (tipus)
      REFERENCES hexagonal.tipus_centres (uuid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE hexagonal.centros
  OWNER TO nobody;
EOF


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

alias ll='ls -la --color' 

echo "///////////////////////////////////////////////"
echo "Explicitly set default client_encoding..."
echo "///////////////////////////////////////////////"
echo "client_encoding = utf8" >> "/etc/postgresql/9.3/main/postgresql.conf"

echo "///////////////////////////////////////////////"
echo "Create a new postgresql user with password..."
echo "///////////////////////////////////////////////"
cat << EOF | su - postgres -c psql
-- Create the database user:
CREATE USER dbuser WITH PASSWORD 'db-user';
ALTER USER dbuser CREATEDB;
EOF
