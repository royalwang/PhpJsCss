MariaDB SSL (mysql) how to Install SSL certs

## 1)Download MariaDB mysql server 
https://mariadb.org/

## 2) Install OpenSSL from (32 or 64 bit)
http://www.slproweb.com/products/Win32OpenSSL.html

## 3) Create certs in Common Name Set localhost ip address 127.0.0.1 or desktop 192.168.1.100
openssl genrsa 2048 > ca-key.pem
openssl req -new -x509 -nodes -days 365000 -key ca-key.pem -out ca-cert.pem
openssl req -newkey rsa:2048 -days 365000 -nodes -keyout server-key.pem -out server-req.pem
openssl rsa -in server-key.pem -out server-key.pem
openssl x509 -req -in server-req.pem -days 365000 -CA ca-cert.pem -CAkey ca-key.pem -set_serial 01 -out server-cert.pem
openssl req -newkey rsa:2048 -days 365000 -nodes -keyout client-key.pem -out client-req.pem
openssl rsa -in client-key.pem -out client-key.pem
openssl x509 -req -in client-req.pem -days 365000 -CA ca-cert.pem -CAkey ca-key.pem -set_serial 01 -out client-cert.pem
openssl verify -CAfile ca-cert.pem server-cert.pem client-cert.pem

## 4) Add certs to my.ini
[mysqld]
datadir=C:/Program Files/MariaDB 10.1/data
port=3333
sql_mode="STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION"
default_storage_engine=innodb
innodb_buffer_pool_size=256M
innodb_log_file_size=50M
character-set-server=utf8
### SSL Server certs
ssl-ca=C:/Program Files/MariaDB 10.1/data/ssl/ca-cert.pem
ssl-cert=C:/Program Files/MariaDB 10.1/data/ssl/server-cert.pem
ssl-key=C:/Program Files/MariaDB 10.1/data/ssl/server-key.pem

[client]
port=3333
plugin-dir=C:/Program Files/MariaDB 10.1/lib/plugin
### SSL Client certs
ssl-ca=C:/Program Files/MariaDB 10.1/data/ssl/ca-cert.pem
ssl-cert=C:/Program Files/MariaDB 10.1/data/ssl/client-cert.pem
ssl-key=C:/Program Files/MariaDB 10.1/data/ssl/client-key.pem

## 5) Restart MysqlDB
net stop MysqlDB or net stop mysql
net start MysqlDB or net start mysql

# Tutorial link
### https://www.cyberciti.biz/faq/how-to-setup-mariadb-ssl-and-secure-connections-from-clients/
