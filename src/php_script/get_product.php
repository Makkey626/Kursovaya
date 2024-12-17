<?php
include 'db_connect.php';

function getProductsByCategory($category) {
    global $conn; // Доступ к переменной соединения из db_connect.php

    // SQL-запрос для получения 4 последних товаров из указанной категории
    $sql = "SELECT * FROM product WHERE category = ? ORDER BY id DESC LIMIT 4";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Создаём массив для хранения товаров
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        // Если нет товаров, можно отобразить сообщение
        echo "Товары не найдены для категории: $category";
    }

    $stmt->close();

    return $products;
}
?>
