<?php
include "php_script/db_connect.php";
include "php_script/encrypt.php";

// Проверяем, авторизован ли пользователь через куки
if (!isset($_COOKIE['user']) && !isset($_COOKIE['admin'])) {
    header("Location: login.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}

// Определяем, какую куку расшифровывать (для админа или обычного пользователя)
$cookie_name = isset($_COOKIE['admin']) ? 'admin' : 'user'; // Если кука admin, расшифровываем её, иначе user

// Расшифровываем имя пользователя из куки
$loggedInUser = decrypt_cookie($_COOKIE[$cookie_name]);

// Проверяем, удалось ли расшифровать куки
if (!$loggedInUser) {
    echo "Ошибка: не удалось расшифровать данные.";
    header("Location: /login.php"); // Если ошибка расшифровки, перенаправляем на страницу входа
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
    echo "Ошибка: пользователь не найден.";
    exit();
}

$stmt->close();
$conn->close();
?>
