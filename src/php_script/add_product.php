<?php
// Подключение к базе данных
include 'db_connect.php';

// Проверка, что форма была отправлена
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $name = $_POST['name'];
    $article = $_POST['article'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];  // Получаем категорию
    $description = $_POST['description'];

    // Проверка, что категория не пуста
    if (empty($category)) {
        die('Ошибка: категория не выбрана.');
    }

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
            // Запрос на добавление товара в базу данных
            $sql = "INSERT INTO product (name, article, price, color, category, description, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Ошибка подготовки запроса: ' . $conn->error);
            }

            // Привязка параметров и выполнение запроса
            $stmt->bind_param("ssdssss", $name, $article, $price, $color, $category, $description, $image_path);

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
            // Ошибка загрузки изображения
            $conn->close();
            header('Location: ../admin_panel.php?error=Ошибка при загрузке изображения.');
            exit();
        }
    } else {
        // Ошибка, если изображение не выбрано
        $conn->close();
        header('Location: ../admin_panel.php?error=Ошибка: изображение не выбрано.');
        exit();
    }
}

$conn->close();
?>
