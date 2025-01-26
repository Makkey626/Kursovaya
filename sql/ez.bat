@echo off
REM Мануал для создания дампа базы данных в Docker контейнере

REM Переменные
set CONTAINER_NAME=mysql_db
set DB_USER=root
set DB_NAME=my_database
set BACKUP_FILE=/tmp/backup.sql
set LOCAL_BACKUP_FILE=backup.sql

REM Шаг 1: Выполнение команды внутри контейнера для создания дампа базы данных
echo Создание дампа базы данных внутри контейнера...
docker exec -it %CONTAINER_NAME% bash -c "mysqldump -u %DB_USER% -p %DB_NAME% > %BACKUP_FILE%"

REM Шаг 2: Копирование дампа с контейнера на хост
echo Копирование дампа базы данных на хост...
docker cp %CONTAINER_NAME%:%BACKUP_FILE% .\%LOCAL_BACKUP_FILE%

REM Шаг 3: Удаление временного файла дампа из контейнера
echo Удаление временного файла дампа из контейнера...
docker exec %CONTAINER_NAME% rm %BACKUP_FILE%

echo Дамп базы данных успешно создан и скопирован как %LOCAL_BACKUP_FILE%
pause
