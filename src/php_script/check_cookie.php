<?php
include 'encrypt.php';

// Проверяем наличие куки с именем 'admin' или 'user'
if (isset($_COOKIE['admin'])) {
    // Расшифровываем имя пользователя из куки 'admin'
    $user_name = decrypt_cookie($_COOKIE['admin']);
    
    // Если имя пользователя не 'admin', перенаправляем на index.php
    if ($user_name !== "admin") {
        header("Location: index.php");
        exit;
    }
} else {
    // Если куки 'admin' нет, редиректим на index.php
    header("Location: index.php");
    exit;
}
?>
