<?php
include 'db_connect.php';  // Подключение к базе данных
include_once 'php_script/encrypt.php';

// Проверяем, существует ли кука с именем пользователя
if (isset($_COOKIE['username'])) {
    // Получаем зашифрованное имя пользователя из куки
    $encrypted_username = $_COOKIE['username'];
    
    // Расшифровываем имя пользователя
    $username = decrypt_cookie($encrypted_username);

    // Проверяем, что имя пользователя было расшифровано
    if ($username === false) {
        echo "<tr><td colspan='5'>Ошибка расшифровки данных.</td></tr>";
        exit();
    }

    // Подготовленный запрос для получения товаров из корзины пользователя
    $stmt = $conn->prepare("SELECT p.*, c.quantity FROM product p
                            JOIN cart c ON p.id = c.product_id
                            WHERE c.username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверяем, есть ли товары в корзине
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . htmlspecialchars($row['image']) . "' width='50px' alt=''></td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . " руб.</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price'] * $row['quantity']) . " руб.</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>В вашей корзине нет товаров.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Вы не авторизованы. Пожалуйста, войдите в систему.</td></tr>";
}

// Закрытие соединения с базой данных
if (isset($conn)) {
    $conn->close();
}
?>
