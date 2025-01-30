<?php
// Подключаем файлы для соединения с БД и шифрования
include 'db_connect.php';
include_once 'encrypt.php';

header('Content-Type: application/json');

// Проверяем, переданы ли необходимые данные
if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_COOKIE['username'])) {
    $product_id = (int) $_POST['product_id']; // Получаем ID товара
    $quantity = (int) $_POST['quantity']; // Получаем количество товара
    $username = decrypt_cookie($_COOKIE['username']); // Расшифровываем имя пользователя

    if ($username === false) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка расшифровки данных.']);
        exit();
    }

    // Проверяем, что количество больше 0
    if ($quantity <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Количество товара должно быть больше 0.']);
        exit();
    }

    // Получаем цену товара
    $product_price = get_product_price($product_id, $conn);
    if ($product_price === false) {
        echo json_encode(['status' => 'error', 'message' => 'Товар не найден.']);
        exit();
    }

    // Обновляем количество товара в корзине
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND username = ?");
    $stmt->bind_param("iis", $quantity, $product_id, $username);
    $stmt->execute();

    // Проверяем успешность обновления
    if ($stmt->affected_rows > 0) {
        // Возвращаем обновленную стоимость товара
        $total_price = $product_price * $quantity;
        echo json_encode(['status' => 'success', 'new_total' => $total_price]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка обновления корзины.']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Недостаточно данных для обновления корзины.']);
}

// Закрываем соединение с БД
$conn->close();

// Функция для получения цены товара по его ID
function get_product_price($product_id, $conn) {
    // Инициализация переменной $price, чтобы избежать ошибки
    $price = null;

    $stmt = $conn->prepare("SELECT price FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    // Возвращаем цену, если она найдена, иначе false
    return $price !== null ? $price : false;
}
?>
