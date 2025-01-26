Мануал для создания дампа БД

docker exec -it mysql_db bash

mysqldump -u root -p my_database > /tmp/backup.sql

root

docker cp mysql_db:/tmp/backup.sql ./backup.sql
