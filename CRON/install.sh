#!/bin/bash

# import mysql database only once !!! Lub z backupu
# mysql -u root -p < /var/www/html/newsletetr/sql/freshnewsletter.sql

# # Backup
# C:\xamp\mysql\bin\mysqldump --opt --add-drop-database --add-locks --single-transaction -u {USER} -p{PASS} --databases freshnewsletter > freshnewsletter.sql

# Add mysql connecion data to file:
# classes/ZixLib/Pdo/Credentials.php

# colorize prompt
export PS1='${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]\$ '

# change owner
chown -R www-data /var/www/html/newsletter/media
chown -R www-data /var/www/html/newsletter/logs

# write in folders when user www-data
chmod -R 755 /var/www/html/newsletetr/media
chmod -R 755 /var/www/html/newsletetr/logs

# Allow execute file
chmod +x /var/www/html/newsletter/send-newsletter.php

apt-get install lynx mailutils postfix

# POSTFIX
# /etc/hosts -> domena.xx
# hostname gomena.xx
# dpkg-reconfigure postfix
# jako host podawać domena.xx
# Send email
# echo "Hello mail" | mail -s "Temat wiadomości" hello@email.xx

# with lynx
croncmd="lynx https://domena.xx/send-newsletter.php?id=1000"
cronjob="*/15 * * * * $croncmd"
( crontab -l | grep -v -F "$croncmd" ; echo "$cronjob" ) | crontab -

# show logs
# grep CRON /var/log/syslog

# * * * * * lynx -dump https://domena.xx/send-newsletter.php > /dev/null 2>&1
# * * * * * /usr/bin/php /var/www/html/domena.xx/send-newsletter.php?id=100 > /dev/null 2>&1
# 
# Remove from cron
# ( crontab -l | grep -v -F "$croncmd" ) | crontab -

# Add cronjob to crontab file
# croncmd="/usr/bin/php /var/www/html/domena.xx/send-newsletter.php?id=1000"

# Add to cron file hourly from php
# From (every 30 min): crontab -e
# */30 * * * * /usr/bin/php /var/www/html/domena.xx/send-newsletter.php?id=1000
# hour
# 00 * * * * lynx -dump https://domena.xx/myscript.php
# 5 min
# */5 * * * * /usr/bin/curl -o temp.txt https://domena.xx/myscript.php
# 10 min
# */10 * * * * /usr/bin/wget -q -O temp.txt https://domena.xx/myscript.php
# everey hour between 9:00 - 18:00
# 00 09-18 * * * /home/carl/hourly-archive.sh

# Newsletetr variable
# {EMAIL} {NAME} {CITY}
# {OPEN}- track email open, link do śledzenia otwarcia wiadomości
# 

# Mysql user
# GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'toor';
# GRANT ALL PRIVILEGES ON *.* TO 'root'@127.0.0.1 IDENTIFIED BY 'toor';
# FLUSH PRIVILEGES;
# 
# All options
# GRANT ALL PRIVILEGES ON *.* TO 'root'@127.0.0.1 IDENTIFIED BY 'toor' WITH GRANT OPTION;
# FLUSH PRIVILEGES;
#
# Change 
# REVOKE ALL PRIVILEGES ON *.* FROM 'freshnewsletter'@'localhost'; 
# REVOKE GRANT OPTION ON *.* FROM 'freshnewsletter'@'localhost'; 
# GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'freshnewsletter'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

# Mysql user
# GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER
# GRANT EXECUTE, PROCESS, SELECT, SHOW DATABASES, SHOW VIEW, ALTER, ALTER ROUTINE, CREATE, CREATE ROUTINE, CREATE TEMPORARY TABLES, CREATE VIEW, DELETE, DROP,
# EVENT, INDEX, INSERT, REFERENCES, TRIGGER, UPDATE, CREATE USER, FILE, LOCK TABLES, RELOAD, REPLICATION CLIENT, REPLICATION SLAVE, SHUTDOWN, SUPER
 

# Set charset to utf8mb4 - full utf8 !!! POLISH CHARACTERS in mysql
# C:/xampp/mysql/bin/my.ini 
# /etc/mysql/my.cnf

# [client]
# default-character-set = utf8mb4

# [mysql]
# default-character-set = utf8mb4

# [mysqld]
# character-set-client-handshake = FALSE
# character-set-server = utf8mb4
# collation-server = utf8mb4_unicode_ci
