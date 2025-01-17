<?php
// Подключение к базе данных
include 'php_script/db_connect.php';

// Получаем ID товара из GET-параметра
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id > 0) {
    // Запрос к базе данных для получения информации о товаре
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Если товар найден
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $name = $product["name"];
        $article = $product["article"];
        $color = $product["color"];
        $new_category = $product["category"];
        $description = $product["description"];
        $price = $product["price"];
        $imagePath = $product["image"];  // путь к изображению
    } else {
        // Если товар не найден, показываем ошибку
        header('Location: index.php');
    }
    $stmt->close();
} else {
    // Если ID товара не передан
    header("Location: index.php");
    exit();
}

// Закрытие соединения с базой данных
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($name); ?></title>
    <link rel="stylesheet" href="main_style.css">
</head>
<body>
    <div class="info_head">
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                    <div class="info_head_text">
                        <img src="../img/vk-outline-svgrepo-com.svg" width="10%" alt="">
                        <a href="#" class="a_info_header"><p class="p_info_text">Контакты</p></a>
                        <a href="#footer_href" class="a_info_header"><p class="p_info_text">Карта сайта</p></a>
                        <p class="p_info_text">|</p>
                        <p class="p_info_text">+78005553535</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                        <a href="../index.php"><img src="../img/kniferussia-logo-1488283162.jpg" width="100%" alt=""></a>
                </div>
                <div class="col col-5">
                    <div class="menu">
                        <input type="text" id="search_input" placeholder="Что вы хотите найти?">
                        <script src="../search_script.js"></script>
                        <div class="sub_menu">
                            <a href="#" class="a_info_header" id="search-button">
                            <img src="../img/search.svg" width="75%" alt="">
                            <p class="p_menu_text">Поиск</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                             <a href="<?php include "../modules.php"?> " class="a_info_header">
                            <img src="../img/user-svgrepo-com.svg" width="75%" alt="">
                            <p class="p_menu_text">Кабинет</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                            <a href="#" class="a_info_header">
                            <img src="../img/bucket-svgrepo-com.svg" width="75%" alt="">
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
                        <div class="home_img"><a href="../index.php"><img src="../img/home-1-svgrepo-com.svg" width="60%" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <a class="a_info_header" href="../index.php">Главная</a><b> > </b> <a class="a_info_header" href="../index.php"><?php echo htmlspecialchars($new_category); ?></a> > <span style="color: #9A9494;"><?php echo htmlspecialchars($name); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 30px;">
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                    <div style="width: 100%"><img src="../<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($name); ?>" width="100%"></div>
                </div>
                <div class="col col-5">
                    <hr>
                    <h1 class="add_h1"> Нашивка:  <?php echo htmlspecialchars($name); ?></h1>
                    <p class="add_p"><b>Артикул:</b> №-<?php echo htmlspecialchars($article); ?></p>
                    <p class="add_p"><b>Цвет:</b> <?php echo htmlspecialchars($color); ?></p>
                    <p class="add_p"><b>Категория:</b> <?php echo htmlspecialchars($new_category); ?></p>
                    <p class="add_p"><b>Описание:</b></p>
                    <p class="add_p new_add_p"><?php echo nl2br(htmlspecialchars($description)); ?></p>
                    <hr>
                    <div style="display: flex;">
                        <p class="price"><b><?php echo htmlspecialchars($price); ?></b> руб.</p>
                        <button class="btn_log"><b>В корзину!</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <div style="margin-top: 30px; margin-bottom: 15px"><p class="p_category"><i>Оставьте свой комментарий!</i></p><hr></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-4">
                    <div class = "add_comment">
                        <form action="" method="POST">
                            <textarea class="admin_text_area" style="margin-left: 0; padding-bottom: 0;" name="comment" placeholder="Ваш комментарий" rows="5" required></textarea>
                            <button class ="btn_log" style ="width: 50%; padding-top: 10px;" type="submit" name="submit_comment">Отправить</button>
                        </form>
                    </div>
                </div>
                <div class="col col-4">
                    <div class="add_comment">adas</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div>
        <div class="footer_first">
            <div class="inner">
                <div class="row">
                    <div class="col col-8">
                        <div style="margin-top: 30px;">
                            <h3 style="margin-bottom: 10px;">НАШИВКИ РФ</h3>
                            <hr>
                            <p class="p_main">Купить нашивки на одежду можно в нашем интернет-магазине, у нас большой ассортимент готовых нашивок для одежды, шевронов для формы, патчей для сумок и рюкзаков. Доставка по всей России.</p>
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
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Свяжитесь с нами</p></a>
                        <a class="a_category" href="../about_us.php"><p class="footer_p">>&ensp;О магазине</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Доставка</p></a>
                        <a class="a_category" href="../about_us.php"><p class="footer_p">>&ensp;О магазине</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Оплата</p></a>
                    </div>
                    <div class="col col-2">
                        <h2>Мой кабинет</h2>
                        <hr>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Мои заказы</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Мои платёжные квитанции</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Мои адреса</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Моя личная информация</p></a>
                        <a class="a_category" href="#"><p class="footer_p">>&ensp;Личный кабинет</p></a>
                    </div>
                    <div class="col col-2">
                        <h2>Контакты</h2>
                        <hr>
                        <p class="footer_p">Nasivki.ru</p>
                        <p class="footer_p">ст. метро Ленинский проспект</p>
                        <p class="footer_p">Санкт-Петербург</p>
                        <p class="footer_p">Россия</p>
                        <p class="footer_p" style="text-decoration: underline;"><b>+7(800)555-35-35</b></p>
                    </div>
                    <div class="col col-2">
                        <h2>Следите за нами</h2>
                        <hr>
                        <div class="soc_img">
                            <div class="soc_img_box"> <a href="#"><img src="../img/vk-outline-svgrepo-com.svg" width="100%" alt=""></a></div>
                            <div class="soc_img_box"> <a href="#"><img src="../img/instagram-svgrepo-com.svg" width="100%" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
