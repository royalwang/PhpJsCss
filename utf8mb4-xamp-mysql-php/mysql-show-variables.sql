# show charset
# SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';

# SET character_set_client = `utf8`;
# SET character_set_results = `utf8`;

#ALTER DATABASE dbname CHARACTER SET utf8;
#ALTER DATABASE dbname COLLATE 'utf8_general_ci';

# For each database:
# ALTER DATABASE `mail` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
# For each table:
# ALTER TABLE `mail` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
# For each column:
# ALTER TABLE `mail` CHANGE column_name column_name VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

// show charset variables
SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';

/*
Old version
Variable_name 	Value 	
character_set_client 	utf8mb4
character_set_connection 	utf8mb4
character_set_database 	utf8
character_set_filesystem 	binary
character_set_results 	utf8mb4
character_set_server 	latin1
character_set_system 	utf8
collation_connection 	utf8mb4_unicode_ci
collation_database 	utf8_general_ci
collation_server 	latin1_swedish_ci
*/

# after change looks (_ci - case insensitive, size of characters dosen't matter when search and insert data):
# SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';

/*
character_set_client 	utf8mb4
character_set_connection 	utf8mb4
character_set_database 	utf8mb4
character_set_filesystem 	binary
character_set_results 	utf8mb4
character_set_server 	utf8mb4
## utf8 here is ok
character_set_system 	utf8
collation_connection 	utf8mb4_unicode_ci
collation_database 	utf8mb4_unicode_ci
collation_server 	utf8mb4_unicode_ci
*/
