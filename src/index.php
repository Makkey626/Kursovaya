<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_style.css">
    <title>Нашивки РФ</title>
    <!-- Основной контент -->
    
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
                        <a href="<?php echo !empty($_COOKIE) ? 'dashboard.php' : 'login.php'; ?>" class="a_info_header">
                                <img src="img/user-svgrepo-com.svg" width="75%" alt="">
                                <p class="p_menu_text">Кабинет</p>
                            </a>
                        </div>
                        <div class="sub_menu">
                            <a href="#" class="a_info_header">
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
        <div class="inner">
            <div class="row">
                <div class="col col-2">
                    <div class="category">
                        <img  src="img/category-list-solid-svgrepo-com.svg" width="10%" alt="">
                        <div class="category_text">Категории</div>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="category.php"><p class="p_category">>&ensp;Новинки</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивки флаг</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивки на липучке</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Военные нашивки</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивки медика</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивка группа<br>&ensp;&ensp;крови</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="category.php?category=На спину"><p class="p_category">>&ensp;Нашивки на спину</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Байкерские нашивки</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="category.php?category=Прикольные"><p class="p_category">>&ensp;Прикольные нашивки</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивки детские</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Нашивки аппликация</p></a>
                    </div>
                    <div class="div_category">
                        <a class="a_category" href="#"><p class="p_category">>&ensp;Маленькие нашивки<br>&ensp;&ensp;и шевроны</p></a>
                    </div>
                    <p class="Blog"><b>Блог<hr></b></p>
                    <a class="a_category" href="#"><p class="p_Blog">>&ensp;Новости</p></a>
                    <a class="a_category" href="#"><p class="p_Blog">>&ensp;Нашивки</p></a>

                </div>
                <div class="col col-6">
                    <?php
                        // Подключение к базе данных
                        include 'php_script/db_connect.php';

                        // SQL-запрос для получения последних 4 товаров из категории "забавная"
                        $sql = "SELECT id, name, article, price, image FROM product WHERE category = 'прикольные' ORDER BY id DESC LIMIT 4";
                        $result = $conn->query($sql);

                        // Проверка, есть ли товары
                        if ($result && $result->num_rows > 0):
                        ?>
                        <div class="main_header1"><b>Нашивки забавные<hr></b></div>
                        <div class="main">
                            <?php
                            // Выводим товары в виде карточек
                            while ($row = $result->fetch_assoc()):
                                $id = $row['id']; // ID товара для ссылки
                                $name = htmlspecialchars($row['name']);
                                $article = htmlspecialchars($row['article']);
                                $price = number_format($row['price'], 2, '.', ''); // Форматируем цену
                                $image = htmlspecialchars($row['image']); // Путь к изображению
                            ?>
                            <div class="shop">
                                <a href="product_page.php?id=<?= $id ?>" style="text-decoration: none; color: inherit;">
                                    <div class="shop_photo">
                                        <img src="<?= $image ?>" width="64%">
                                    </div>
                                    <p style="color: #c5c5c5;"><b><?= $name ?></b></p>
                                    <p class="p_shop">№-<?= $article ?></p>
                                    <p class="p_shop" style="font-size: 20px;"><b><?= $price ?> руб.</b></p>
                                </a>
                                <button class="button_shop">В корзину</button>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        else:
                            // Если товары отсутствуют, выводим сообщение
                            echo "<p>Нет товаров в категории 'забавная'.</p>";
                        endif;

                        // Закрытие соединения
                        $conn->close();
                    ?>
                    <?php
                        // Подключение к базе данных
                        include 'php_script/db_connect.php';

                        // SQL-запрос для получения последних 4 товаров из категории "забавная"
                        $sql = "SELECT id, name, article, price, image FROM product WHERE category = 'На спину' ORDER BY id DESC LIMIT 4";
                        $result = $conn->query($sql);

                        // Проверка, есть ли товары
                        if ($result && $result->num_rows > 0):
                        ?>
                        <div class="main_header1"><b>Нашивки на спину<hr></b></div>
                        <div class="main">
                            <?php
                            // Выводим товары в виде карточек
                            while ($row = $result->fetch_assoc()):
                                $id = $row['id']; // ID товара для ссылки
                                $name = htmlspecialchars($row['name']);
                                $article = htmlspecialchars($row['article']);
                                $price = number_format($row['price'], 2, '.', ''); // Форматируем цену
                                $image = htmlspecialchars($row['image']); // Путь к изображению
                            ?>
                            <div class="shop">
                                <a href="http://whomkky.ru/product_page.php?id=<?= $id ?>" style="text-decoration: none; color: inherit;">
                                    <div class="shop_photo">
                                        <img src="<?= $image ?>" width="64%">
                                    </div>
                                    <p style="color: #c5c5c5;"><b><?= $name ?></b></p>
                                    <p class="p_shop">№-<?= $article ?></p>
                                    <p class="p_shop" style="font-size: 20px;"><b><?= $price ?> руб.</b></p>
                                </a>
                                <button class="button_shop">В корзину</button>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        else:
                            // Если товары отсутствуют, выводим сообщение
                            echo "<p>Нет товаров в категории 'Нашивки на спину'.</p>";
                        endif;

                        // Закрытие соединения
                        $conn->close();
                    ?>
                    <div class="main_header1"><b>Нашивки флаги<hr></b></div>
                    <div class="main">
                        <div class="shop">
                            <div class="shop_photo">
                                <img src="img/shevron-na-lipuchke-fishing.webp" width="64%">
                            </div>
                            <p style="color: #c5c5c5;"><b>Шеврон Fishing</b></p>
                            <p class="p_shop">№-1</p>
                            <p class="p_shop" style="font-size: 20px;"><b>250.00 руб.</b></p>
                            <button class="button_shop">В корзину</button>
                        </div>
                        <div class="shop">
                            <div class="shop_photo">
                                <img src="img/shevron-na-lipuchke-fishing.webp" width="64%">
                            </div>
                            <p style="color: #c5c5c5;"><b>Шеврон Fishing</b></p>
                            <p class="p_shop">№-1</p>
                            <p class="p_shop" style="font-size: 20px;"><b>250.00 руб.</b></p>
                            <button class="button_shop">В корзину</button>
                        </div>
                        <div class="shop">
                            <div class="shop_photo">
                                <img src="img/shevron-na-lipuchke-fishing.webp" width="64%">
                            </div>
                            <p style="color: #c5c5c5;"><b>Шеврон Fishing</b></p>
                            <p class="p_shop">№-1</p>
                            <p class="p_shop" style="font-size: 20px;"><b>250.00 руб.</b></p>
                            <button class="button_shop">В корзину</button>
                        </div>
                        <div class="shop">
                            <div class="shop_photo">
                                <img src="img/shevron-na-lipuchke-fishing.webp" width="64%">
                            </div>
                            <p style="color: #c5c5c5;"><b>Шеврон Fishing</b></p>
                            <p class="p_shop">№-1</p>
                            <p class="p_shop" style="font-size: 20px;"><b>250.00 руб.</b></p>
                            <button class="button_shop">В корзину</button>
                        </div>
                    </div>
                    <div class="main_header2">
                        <span style="font-size: 22px;"><b>Интернет магазин нашивок и шевронов.</b></span><br>
                        <span style="font-size: 18px;"><b>Магазин, где можно купить нашивки, шевроны, патчи. Большой выбор готовых нашивок.</b></span>
                        <p class="p_main">В ассортименте представлены нашивки на липучке маленькие и большие, нашивки для байкеров и мотоциклистов, как на спину,так и нагрудные нашивки. У нас Вы сможете купить нашивки и шевроны для военных. В наличии нашивки на одежду, не только для детей, но и для взрослых. Большой выбор нашивок для рюкзаков и сумок. Если на сайте нашивок нет по душе - мы можем изготовить (вышить) нашивку по вашему эскизу на заказ. Компьютерная вышивка на заказ осуществляется после согласования эскиза. Купить готовые нашивки для одежды, формы сумки или рюкзака, Вы можете уже сейчас. </p>
                    </div>    
                </div>
            </div>
        </div>
    </div>
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
<a href="php_script/delete_cookie.php">qweqweqw</a>
</body>
</html>

<script src="search_script.js"></script>