<?php
// Подключаем файл с настройками подключения к базе данных
require_once 'php_script/db_connect.php';

// Получаем категорию и цвет из URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';

// Получаем сортировку из параметров URL
$sort = isset($_GET['sort']) && $_GET['sort'] !== 'none' ? $_GET['sort'] : 'none';

// Строим базовый запрос с фильтром по категории
$sql = "SELECT * FROM product WHERE category = ?";

// Добавляем фильтр по цвету, если выбран цвет
if ($color && $color !== 'none') {
    $sql .= " AND color = ?";
}

// Если сортировка выбрана, добавляем сортировку по цене
if ($sort !== 'none') {
    $sort_order = $sort === 'desc' ? 'DESC' : 'ASC';
    $sql .= " ORDER BY price $sort_order";
}

$stmt = $conn->prepare($sql);

// Биндим параметры: категория и цвет (если выбран)
if ($color && $color !== 'none') {
    $stmt->bind_param("ss", $category, $color);  // "s" означает строковый тип параметра
} else {
    $stmt->bind_param("s", $category);
}

$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_style.css">
    <title>Категория: <?= htmlspecialchars($category); ?></title>
</head>
<body>
    <div class="info_head">
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                    <div class="info_head_text">
                        <img src="img/vk-outline-svgrepo-com.svg" width="10%" alt="">
                        <a href="#" class="a_info_header"><p class="p_info_text">Контакты</p></a>
                        <a href="#footer_href" class="a_info_header"><p class="p_info_text">Карта сайта</p></a>
                        <p class="p_info_text">|</p>
                        <p class="p_info_text">+78005553535</p>
                    </div>
                </div>
                <div class="col col-3"></div>
                <div class="col col-2">
                        <?php
                            // Подключаем файл с проверкой администратора
                            include 'php_script/admin_check.php';
                            // Вызываем функцию, чтобы показать блок для админа
                            show_admin_block();
                        ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                        <a href="index.php"><img src="img/kniferussia-logo-1488283162.jpg" width="100%" alt=""></a>
                </div>
                <div class="col col-5">
                    <div class="menu">
                        <input type="text" id="search_input" placeholder="Что вы хотите найти?">
                        <script src="/JS/search_script.js"></script>
                        <div class="sub_menu">
                            <a href="#" class="a_info_header" id="search-button">
                                <img src="img/search.svg" width="75%" alt=""/>
                                <p class="p_menu_text">Поиск</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                        <a href="<?php echo (isset($_COOKIE['admin']) || isset($_COOKIE['user'])) ? 'dashboard.php' : 'login.php'; ?>" class="a_info_header">
                                <img src="img/user-svgrepo-com.svg" width="75%" alt=""/>
                                <p class="p_menu_text">Кабинет</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                            <a href="#" class="a_info_header">
                                <img src="img/bucket-svgrepo-com.svg" width="75%" alt=""/>
                                <p class="p_menu_text">Корзина</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <div class="home">
                        <div class="home_img"><a href="index.php"><img src="img/home-1-svgrepo-com.svg" width="60%" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Место для формы с сортировкой и фильтром по цвету -->
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-2">
                    <div class="category">
                        <img  src="img/search.svg" width="10%" alt="">
                        <div class="category_text">Фильтры</div>
                    </div>
                    <hr>
                    <form method="GET" action="category.php" style="margin-bottom: 20px;">
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category); ?>"> <!-- Скрытое поле для категории -->
                        <p class="label_catergory" for="sort">Сортировать по цене:</p>
                        <select class="sort_price" name="sort" id="sort">
                            <option value="none" <?= !isset($_GET['sort']) || $_GET['sort'] == 'none' ? 'selected' : '' ?>>Без сортировки</option>
                            <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>По возрастанию</option>
                            <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'selected' : '' ?>>По убыванию</option>
                        </select>
                        <p class="label_category" for="color">Фильтровать по цвету:</p>
                        <select class="sort_price" name="color" id="color">
                            <option value="none" <?= !isset($_GET['color']) || $_GET['color'] == 'none' ? 'selected' : '' ?>>Все цвета</option>
                            <option value="Белый" <?= isset($_GET['color']) && $_GET['color'] == 'Белый' ? 'selected' : '' ?>>Белый</option>
                            <option value="Черный" <?= isset($_GET['color']) && $_GET['color'] == 'Черный' ? 'selected' : '' ?>>Черный</option>
                            <option value="Желтый" <?= isset($_GET['color']) && $_GET['color'] == 'Желтый' ? 'selected' : '' ?>>Желтый</option>
                            <option value="Синий" <?= isset($_GET['color']) && $_GET['color'] == 'Синий' ? 'selected' : '' ?>>Синий</option>

                        </select>
                        <br>
                        <button class="btn_category"  type="submit"><b>Применить</b></button>
                    </form>
                </div>

                <div class="col col-6">
                    <div class="main_category">
                        <?php if (count($products) > 0): ?>
                            <?php $counter = 0; ?> <!-- Счётчик товаров -->
                            <?php foreach ($products as $product): ?>
                                <div class="shop_category">
                                    <a href="product_page.php?id=<?= htmlspecialchars($product['id']); ?>" style="text-decoration: none; color: inherit;">
                                        <div class="shop_photo">
                                            <img src="<?= htmlspecialchars($product['image']); ?>" width="64%" alt="<?= htmlspecialchars($product['name']); ?>">
                                        </div>
                                        <p style="color: #c5c5c5;"><b><?= htmlspecialchars($product['name']); ?></b></p>
                                        <p class="p_shop">№<?= htmlspecialchars($product['id']); ?></p>
                                        <p class="p_shop" style="font-size: 20px;"><b><?= htmlspecialchars($product['price']); ?> руб.</b></p>
                                        <button class="button_shop">В корзину</button>
                                    </a>
                                </div>
                                <?php $counter++; ?>
                                <?php if ($counter % 4 == 0): ?> <!-- После 4 товаров, переход на новую строку -->
                                    </div><br><hr><div class="main_category">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>К сожа</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Закрываем соединение с базой данных
$stmt->close();
$conn->close();
?>
