<?php
// db_connect.php

$host = 'mysql_db'; // Имя контейнера MySQL из docker-compose
$db = 'my_database'; // Имя базы данных
$user = 'root'; // Имя пользователя
$password = 'root'; // Пароль пользователя

// Создаем подключение
$conn = new mysqli($host, $user, $password, $db);

// Проверка на ошибки подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Устанавливаем кодировку для корректной работы с данными
$conn->set_charset('utf8');

?>
