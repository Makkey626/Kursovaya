<?php
include 'php_script/get_product.php';

// Получаем товары из категорий
$flags_products = getProductsByCategory('funny');
$military_products = getProductsByCategory('military');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Товары</title>
    <link rel="stylesheet" href="main_style.css">
</head>
<body>
    <h1>Товары категории: Flags</h1>
    <div class="main">
        <?php foreach ($flags_products as $product): ?>
            <div class="shop">
                <div class="shop_photo">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" width="64%">
                </div>
                <p style="color: #c5c5c5;">
                    <b><?php echo htmlspecialchars($product['name']); ?></b>
                </p>
                <p class="p_shop">№-<?php echo $product['id']; ?></p>
                <p class="p_shop" style="font-size: 20px;">
                    <b><?php echo $product['price']; ?> руб.</b>
                </p>
                <button class="button_shop">В корзину</button>
            </div>
        <?php endforeach; ?>
    </div>

    <h1>Товары категории: Military</h1>
    <div class="main">
        <?php foreach ($military_products as $product): ?>
            <div class="shop">
                <div class="shop_photo">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" width="64%">
                </div>
                <p style="color: #c5c5c5;">
                    <b><?php echo htmlspecialchars($product['name']); ?></b>
                </p>
                <p class="p_shop">№-<?php echo $product['id']; ?></p>
                <p class="p_shop" style="font-size: 20px;">
                    <b><?php echo $product['price']; ?> руб.</b>
                </p>
                <button class="button_shop">В корзину</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
