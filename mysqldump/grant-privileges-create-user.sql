# mysqldump --single-transaction (InnoDB)

CREATE USER 'backup'@'localhost' IDENTIFIED BY 'secret';
GRANT SELECT, SHOW VIEW, RELOAD, REPLICATION CLIENT, EVENT, TRIGGER ON *.* TO 'backup'@'localhost';
FLUSH PRIVILEGES;

# mysqldump --lock-all-tables (MyISAM)
GRANT LOCK TABLES ON *.* TO 'backup'@'localhost';
FLUSH PRIVILEGES;

# how use command line backup
mysqldump -u user -p --all-databases > filename.sql

# how to restore all
mysql -u user -p < filename.sql
