<?php

// Настройки контейнера и базы данных
$containerName = "mysql_db";  // Имя вашего контейнера
$dbUser = "root";             // Пользователь MySQL
$dbPassword = "root";         // Пароль MySQL
$dbName = "my_database";      // Имя базы данных
$backupFile = "/tmp/backup.sql";  // Путь к файлу дампа внутри контейнера
$localBackupFile = "backup.sql";  // Путь для сохранения файла на хосте

function runCommand($command)
{
    $output = [];
    $resultCode = 0;
    exec($command, $output, $resultCode);
    
    if ($resultCode !== 0) {
        echo "Ошибка выполнения команды: $command\n";
        echo "Код ошибки: $resultCode\n";
        echo "Вывод: " . implode("\n", $output) . "\n";
        exit(1);
    }
}

// Создаем дамп базы данных внутри контейнера
echo "Создание дампа базы данных внутри контейнера...\n";

// Команда для выполнения mysqldump с вводом пароля
$expectScript = <<<EOD
#!/usr/bin/expect -f
set timeout -1
spawn docker exec -it $containerName bash -c "mysqldump -u $dbUser -p$dbPassword $dbName > $backupFile"
expect "Enter password:"
send "$dbPassword\r"
expect eof
EOD;

// Сохраняем expect-скрипт во временный файл
file_put_contents('/tmp/mysqldump_expect.sh', $expectScript);

// Устанавливаем права на выполнение скрипта
chmod('/tmp/mysqldump_expect.sh', 0755);

// Запускаем expect-скрипт
runCommand('/tmp/mysqldump_expect.sh');

// Копируем файл дампа на хост
echo "Копирование дампа базы данных на хост...\n";
$copyCommand = "docker cp $containerName:$backupFile $localBackupFile";
runCommand($copyCommand);

// Удаляем временный файл дампа внутри контейнера
echo "Удаление временного файла дампа из контейнера...\n";
$cleanupCommand = "docker exec $containerName rm $backupFile";
runCommand($cleanupCommand);

// Удаляем временный expect-скрипт
unlink('/tmp/mysqldump_expect.sh');

echo "Дамп базы данных успешно сохранен как $localBackupFile\n";
?>
