<?php
include 'db_connect.php';
include 'encrypt.php';

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Подготовленный запрос для предотвращения SQL инъекций
    $stmt = $conn->prepare("SELECT * FROM my_shop WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Проверка пароля
        if (password_verify($password, $user['password'])) {
            // Зашифровываем имя пользователя
            $encrypted_username = encrypt_cookie($user['username']);

            // Устанавливаем куку с именем 'username_cookie' и зашифрованным значением
            setcookie('username', $encrypted_username, time() + (86400 * 30), "/"); // Кука на 30 дней

            // Перенаправление пользователя
            header("Location: ../index.php"); // Переход на панель админа или главную страницу
            exit();
        } else {
            // Неверный пароль
            header("Location: /login.php?error=invalid_password");
            exit();
        }
    } else {
        // Пользователь не найден
        header("Location: /login.php?error=user_not_found");
        exit();
    }
}

// Закрытие соединения с базой данных
if (isset($conn)) {
    $conn->close();
}
?>
