<?php
// Подключаем файл с настройками подключения к базе данных
require_once 'php_script/db_connect.php';

// Получаем категорию и цвет из URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';

// Получаем сортировку из параметров URL
$sort = isset($_GET['sort']) && $_GET['sort'] !== 'none' ? $_GET['sort'] : 'none';

// Строим базовый запрос без фильтров
$sql = "SELECT * FROM product";
$conditions = [];
$params = [];
$types = '';

// Добавляем условие для категории, если она указана
if (!empty($category)) {
    $conditions[] = "category = ?";
    $params[] = $category;
    $types .= 's';
}

// Добавляем фильтр по цвету, если выбран цвет
if ($color && $color !== 'none') {
    $conditions[] = "color = ?";
    $params[] = $color;
    $types .= 's';
}

// Добавляем условия в SQL-запрос
if (!empty($conditions)) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}

// Если выбрана сортировка, добавляем её в запрос
if ($sort !== 'none') {
    $sort_order = $sort === 'desc' ? 'DESC' : 'ASC';
    $sql .= " ORDER BY price $sort_order";
}

$stmt = $conn->prepare($sql);

// Биндим параметры, если они есть
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
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
    <title>Категория: <?= htmlspecialchars($category ? $category : 'Все товары'); ?></title>
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
                                <img src="img/search.svg" width="75%" alt="">
                                <p class="p_menu_text">Поиск</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                        <a href="<?php echo (isset($_COOKIE['admin']) || isset($_COOKIE['user'])) ? 'dashboard.php' : 'login.php'; ?>" class="a_info_header">
                                <img src="img/user-svgrepo-com.svg" width="75%" alt="">
                                <p class="p_menu_text">Кабинет</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                            <a href="<?php echo !empty($_COOKIE) ? 'buckket.php' : 'login.php'; ?>" class="a_info_header">
                                <img src="img/bucket-svgrepo-com.svg" width="75%" alt="">
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
    <div>

    <!-- Форма с сортировкой и фильтром -->
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-2">
                    <div class="category">
                        <img src="img/search.svg" width="10%" alt="">
                        <div class="category_text">Фильтры</div>
                    </div>
                    <hr>
                    <form method="GET" action="category.php" style="margin-bottom: 20px;">
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category); ?>">
                        <p class="label_catergory">Сортировать по цене:</p>
                        <select class="sort_price" name="sort">
                            <option value="none" <?= $sort === 'none' ? 'selected' : '' ?>>Без сортировки</option>
                            <option value="asc" <?= $sort === 'asc' ? 'selected' : '' ?>>По возрастанию</option>
                            <option value="desc" <?= $sort === 'desc' ? 'selected' : '' ?>>По убыванию</option>
                        </select>
                        <p class="label_category">Фильтровать по цвету:</p>
                        <select class="sort_price" name="color">
                            <option value="none" <?= $color === 'none' ? 'selected' : '' ?>>Все цвета</option>
                            <option value="Белый" <?= $color === 'Белый' ? 'selected' : '' ?>>Белый</option>
                            <option value="Черный" <?= $color === 'Черный' ? 'selected' : '' ?>>Черный</option>
                            <option value="Желтый" <?= $color === 'Желтый' ? 'selected' : '' ?>>Желтый</option>
                            <option value="Синий" <?= $color === 'Синий' ? 'selected' : '' ?>>Синий</option>
                        </select>
                        <br>
                        <button class="btn_category" type="submit"><b>Применить</b></button>
                    </form>
                </div>

                <div class="col col-6">
                    <div class="main_category">
                        <?php if (count($products) > 0): ?>
                            <?php $counter = 0; ?>
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
                                <?php if ($counter % 4 == 0): ?>
                                    </div><br><hr><div class="main_category">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>К сожалению, товары не найдены.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer_first">
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <div style="margin-top: 30px;">
                        <h3 style="margin-bottom: 10px;">НАШИВКИ РФ</h3>
                        <hr>
                        <p class="p_main">Купить нашивки на одежду можно в нашем интернет-магазине, у нас большой ассортимент готовых нашивок для одежды, шевронов для формы, патчей для сумок и рюкзаков. Доставка по всей России.</p>
                        <h3 style="text-decoration: underline; margin-bottom: 10px;">+7(800)555-35-35</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="inner">
            <div class="row">
                <div class="col col-2" id="footer_href">
                    <h2>Страницы</h2>
                    <hr>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Свяжитесь с нами</p></a>
                    <a  class="a_category" href="about_us.php"><p class="footer_p">>&ensp;О магазине</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Доставка</p></a>
                    <a  class="a_category" href="about_us.php"><p class="footer_p">>&ensp;О магазине</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Оплата</p></a>
                </div>
                <div class="col col-2">
                    <h2>Мой кабинет</h2>
                    <hr>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Мои заказы</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Мои платёжные квитанции</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Мои адреса</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Моя личная информация</p></a>
                    <a  class="a_category" href="#"><p class="footer_p">>&ensp;Личный кабинет</p></a>
                </div>
                <div class="col col-2">
                    <h2>Контакты</h2>
                    <hr>
                    <p class="footer_p">Nasivki.ru</p>
                    <p class="footer_p">ст. метро Ленинский проспект</p>
                    <p class="footer_p">Санкт-Петербург
                        <p class="footer_p">Россия</p>
                    <p class="footer_p" style="text-decoration: underline;"><b>+7(800)555-35-35</b></p>
                </div>
                <div class="col col-2">
                    <h2>Следите за нами</h2>
                    <hr>
                    <div class="soc_img">
                        <div class="soc_img_box"> <a href="#"><img src="img/vk-outline-svgrepo-com.svg" width="100%" alt=""></a></div>
                        <div class="soc_img_box"> <a href="#"><img src="img/instagram-svgrepo-com.svg" width="100%" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="TM">
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    2012. Все права защищены. НашивкиРФ. Все права защищены
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="search_script.js"></script>

<?php
$stmt->close();
$conn->close();
?>
