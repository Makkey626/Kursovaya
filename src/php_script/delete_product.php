<?php
include 'db_connect.php'; // Подключение к базе данных
include 'admin_check.php'; // Проверка прав администратора

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $product_id = (int)$_POST['id'];

    // Проверяем, является ли пользователь администратором
    if (!check_admin()) {
        die('У вас нет прав для выполнения этого действия.');
    }

    // Удаляем товар из базы данных
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        if ($stmt->execute()) {
            // Перенаправляем на главную страницу или показываем сообщение об успехе
            header('Location: ../index.php');
            exit();
        } else {
            echo "Ошибка при удалении товара: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Ошибка подготовки запроса: " . $conn->error;
    }
} else {
    die('Некорректный запрос.');
}

// Закрываем соединение
$conn->close();
?>
