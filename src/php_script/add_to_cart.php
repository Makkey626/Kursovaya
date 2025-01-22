<?php
include 'db_connect.php';
include 'encrypt.php';

// Проверка, передан ли ID продукта
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
if ($product_id === 0) {
    echo "Продукт не выбран.";
    exit();
}

// Проверяем, есть ли кука с именем пользователя
if (isset($_COOKIE)) {
    foreach ($_COOKIE as $cookie_name => $cookie_value) {
        if ($cookie_value) {
            $username = decrypt_cookie($cookie_value); // Расшифровка имени пользователя
            break;
        }
    }
} else {
    $username = ''; // Если куки нет
}

if (!$username) {
    // Если пользователь не авторизован, выводим сообщение
    echo "Пользователь не авторизован.";
    exit();
}

// Обработка добавления товара в корзину
if ($product_id > 0 && $username) {
    try {
        // Проверяем, есть ли товар в корзине
        $check_sql = "SELECT * FROM cart WHERE username = ? AND product_id = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("si", $username, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Если товар уже есть в корзине, увеличиваем его количество
            $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE username = ? AND product_id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $username, $product_id);
            $stmt->execute();
        } else {
            // Если товара нет в корзине, добавляем его
            $insert_sql = "INSERT INTO cart (username, product_id, quantity) VALUES (?, ?, 1)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("si", $username, $product_id);
            $stmt->execute();
        }

        $stmt->close();

        // Возвращаем успешный ответ
        echo "Товар добавлен в корзину!";
    } catch (Exception $e) {
        // Ошибка при добавлении
        error_log("Ошибка работы с корзиной: " . $e->getMessage());
        echo "Произошла ошибка при добавлении товара в корзину.";
    }
}

$conn->close();
?>
