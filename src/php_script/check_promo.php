<?php
    // Подключение к базе данных
    include 'php_script/db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['promo_code'])) {
        $promo_code = $_POST['promo_code'];

        // Проверка промокода в базе данных
        $stmt = $conn->prepare("SELECT discount_percent, expiration_date FROM promo_codes WHERE code = ?");
        $stmt->bind_param("s", $promo_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $discount_percent = $row['discount_percent'];
            $expiration_date = $row['expiration_date'];

            // Проверяем срок действия промокода
            if (strtotime($expiration_date) < time()) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Промокод истёк.'
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'discount' => $discount_percent // Возвращаем скидку
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Неверный промокод.'
            ]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Промокод не был отправлен.'
        ]);
    }
?>
