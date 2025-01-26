<?php
include "php_script/db_connect.php";
include "php_script/encrypt.php";

// Проверяем, если куки пустые (независимо от имени куки)
if (empty($_COOKIE)) {
    header("Location: login.php"); // Перенаправляем на страницу входа, если куки отсутствуют или пустые
    exit();
}

// Получаем имя пользователя из любой куки
// Здесь мы предполагаем, что кука содержит имя пользователя (это зависит от того, как вы расшифровываете куку)
$cookie_value = reset($_COOKIE); // Берем значение первой куки

// Расшифровываем имя пользователя из куки
$loggedInUser = decrypt_cookie($cookie_value);

// Проверяем, удалось ли расшифровать куки
if (!$loggedInUser) {
    header("Location: login.php"); // Если ошибка расшифровки, перенаправляем на страницу входа
    exit();
}

// Запрашиваем данные пользователя из базы данных
$stmt = $conn->prepare("SELECT * FROM my_shop WHERE username=?");
$stmt->bind_param("s", $loggedInUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php"); // Если пользователь не найден в базе, перенаправляем на страницу логина
    exit();
}

$stmt->close();
$conn->close();
?>
