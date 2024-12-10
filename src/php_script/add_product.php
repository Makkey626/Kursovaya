<?php
ob_start(); // Начало буферизации вывода

include 'db_connect.php';

// Проверка, что форма была отправлена
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $article = $_POST['article'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $shape = $_POST['shape'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Обработка изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_path = '../uploads/' . $image_name; // Папка для хранения изображений

        // Проверка наличия папки и создание, если нет
        if (!file_exists('../uploads/')) {
            mkdir('../uploads/', 0777, true);
        }

        // Перемещение изображения в папку
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Запрос для добавления товара в таблицу
            $sql = "INSERT INTO product (name, article, price, color, shape, category, description, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Ошибка подготовки запроса: ' . $conn->error);
            }

            $stmt->bind_param("ssdsdsss", $name, $article, $price, $color, $shape, $category, $description, $image_path);

            // Выполнение запроса
            if ($stmt->execute()) {
                // Закрытие соединения и редирект
                $stmt->close();
                $conn->close();
                header('Location: ../admin_panel.php?success=true');
                exit();
            } else {
                // Закрытие соединения и редирект с ошибкой
                $stmt->close();
                $conn->close();
                header('Location: ../admin_panel.php?error=' . urlencode($stmt->error));
                exit();
            }
        } else {
            // Закрытие соединения и редирект с ошибкой при загрузке изображения
            $conn->close();
            header('Location: ../admin_panel.php?error=Ошибка при загрузке изображения.');
            exit();
        }
    } else {
        // Закрытие соединения и редирект с ошибкой, если изображение не выбрано
        $conn->close();
        header('Location: ../admin_panel.php?error=Ошибка: изображение не выбрано.');
        exit();
    }
}

$conn->close();
ob_end_flush(); // Завершение буферизации
?>
