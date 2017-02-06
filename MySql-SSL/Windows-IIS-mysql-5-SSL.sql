1) Instal mysql and mysql workbench

2) Install OpenSSL from:
http://www.slproweb.com/products/Win32OpenSSL.html
help here
https://dev.mysql.com/doc/refman/5.5/en/creating-ssl-files-using-openssl.html

3)Create SSL with Workbench SSL Wizard in 
Manage server connection > SSL
https://dev.mysql.com/doc/workbench/en/wb-mysql-connections-ssl-wizard.html

4) Copy certs from %APPDATA% folder  C:\Users\Administrator\AppData\Roaming\MySQL\Workbench\certificates  
   to c:\sslw

5) add to my.ini or my.cnf in Mysql instalation folder C:\Program Files\MySQL\MySQL Server 5.5 

[client]
ssl-ca=C:/sslw/ca-cert.pem
ssl-cert=C:/sslw/client-cert.pem
ssl-key=C:/sslw/client-key.pem

[mysqld]
ssl-ca=C:/sslw/ca-cert.pem
ssl-cert=C:/sslw/server-cert.pem
ssl-key=C:/sslw/server-key.pem

6) In cmd console:
net stop MySql
net start MySql

7) login to mysql
#> mysql -u root -p

8) Create ssl user
mysql> CREATE DATABASE foo;

# Allow connect to database foo from host
mysql> GRANT ALL ON foo.* TO ssluser@localhost IDENTIFIED BY 'sslpass' REQUIRE SSL;

# or from ip
mysql> GRANT ALL ON foo.* TO ssluser@192.168.200 IDENTIFIED BY 'sslpass' REQUIRE SSL;

# or from all
mysql> GRANT ALL ON foo.* TO ssluser@'%' IDENTIFIED BY 'sslpass' REQUIRE SSL;

# or from all to all databases
mysql> GRANT ALL ON *.* TO ssluser@'%' IDENTIFIED BY 'sslpass' REQUIRE SSL;

# And reload 
mysql> FLUSH PRIVILEGES;

9) Check if ssl works:
mysql> show variables like '%ssl%';
+---------------+-------------------------+
| Variable_name | Value                   |
+---------------+-------------------------+
| have_openssl  | YES                     |
| have_ssl      | YES                     |
| ssl_ca        | C:/sslw/ca-cert.pem     |
| ssl_capath    |                         |
| ssl_cert      | C:/sslw/server-cert.pem |
| ssl_cipher    |                         |
| ssl_key       | C:/sslw/server-key.pem  |
+---------------+-------------------------+

mysql> SHOW SESSION STATUS LIKE 'Ssl_version';
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| Ssl_version   | TLSv1 |
+---------------+-------+

mysql> SHOW SESSION STATUS LIKE 'Ssl_cipher';
+---------------+--------------------+
| Variable_name | Value              |
+---------------+--------------------+
| Ssl_cipher    | DHE-RSA-AES256-SHA |
+---------------+--------------------+

mysql> status;
--------------
mysql  Ver 14.14 Distrib 5.5.45, for Win64 (x86)

Connection id:          1
Current database:
Current user:           root@localhost
SSL:                    Cipher in use is DHE-RSA-AES256-SHA
Using delimiter:        ;
Server version:         5.5.45 MySQL Community Server (GPL)
Protocol version:       10
Connection:             localhost via TCP/IP
Server characterset:    utf8
Db     characterset:    utf8
Client characterset:    utf8
Conn.  characterset:    utf8
TCP port:               3306
Uptime:                 15 min 40 sec

Threads: 1  Questions: 11  Slow queries: 0  Opens: 33  Flush tables: 1  Open tables: 26  Queries per second avg: 0.011
--------------
