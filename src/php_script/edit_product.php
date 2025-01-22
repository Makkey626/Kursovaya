<?php
include 'db_connect.php';
include 'admin_check.php';

if (!check_admin()) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $_POST['name'];
    $article = $_POST['article'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($product_id > 0) {
        $sql = "UPDATE product SET name = ?, article = ?, color = ?, category = ?, description = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $article, $color, $category, $description, $price, $product_id);

        if ($stmt->execute()) {
            header("Location: ../product_page.php?id=$product_id");
        } else {
            echo "Ошибка при обновлении товара!";
        }
        $stmt->close();
    } else {
        echo "Неверный ID товара.";
    }

    $conn->close();
}
?>
