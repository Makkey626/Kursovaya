<?php
include 'db_connect.php';
include_once 'encrypt.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $product_id = $data['product_id'] ?? null;

    if (isset($_COOKIE['username'])) {
        $encrypted_username = $_COOKIE['username'];
        $username = decrypt_cookie($encrypted_username);

        if ($product_id && $username) {
            // Удаление товара из корзины
            $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ? AND username = ?");
            $stmt->bind_param("is", $product_id, $username);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Товар удален из корзины']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Не удалось удалить товар']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Недостаточно данных']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Вы не авторизованы']);
    }
}
?>
