<?php
// Подключаем файл для подключения к базе данных
include '../php_script/db_connect.php';

// Получаем ID товара из параметра URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    // Подготовленный запрос для удаления товара
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id); // Привязка параметра

    // Выполняем запрос и проверяем успешность
    if ($stmt->execute()) {
        // Перенаправление на главную страницу
        header("Location: ../index.php");
        exit();
    } else {
        echo "Ошибка при удалении товара: " . $stmt->error;
    }

    // Закрытие запроса
    $stmt->close();
} else {
    echo "Неверный ID товара.";
}

// Закрытие соединения
$conn->close();
?>
