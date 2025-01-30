<?php include 'php_script/auth.php'; ?>
<?php include 'php_script/register.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main_style.css">
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
                        <script src="search_script.js"></script>
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
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <a class="a_info_header" href="index.php">Главная</a><b> > </b> <span style="color: #9A9494;">Авторизация</span>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-4">
                    <div class="form_log">
                        <form method="POST" action="php_script/auth.php">
                            <h1 style="margin-left: 5%;"><b>Авторизация</b></h1><hr>
                            <p class="p_form_log">Логин:</p>
                            <input class="input_log" type="text" name="username" placeholder="" required>
                            <p class="p_form_log">Пароль:</p>
                            <input class="input_log" type="password" name="password" required>
                            <?php
                                if (isset($_GET['error'])) {
                                    $error = $_GET['error'];
                                    if ($error == 'invalid_password') {
                                        echo '<p class="error_message">Неверный пароль. Пожалуйста, попробуйте снова.</p>';
                                    } elseif ($error == 'user_not_found') {
                                        echo '<p class="error_message">Пользователь не найден. Пожалуйста, зарегистрируйтесь.</p>';
                                    }
                                }
                            ?>
                            <button class="btn_log" type="submit"><b>Войти</b></button>
                        </form>
                    </div>
                </div>
                <div class="col col-4">
                <div class="form_log">
                    <form method="POST" action="php_script/register.php">
                        <h1 style="margin-left: 3%;"><b>Регистрация</b></h1><hr>
                        <p class="p_form_log">Логин</p>
                        <input  class="input_log"type="text" name="username" required>
                        <p class="p_form_log">Имя</p>
                        <input  class="input_log"type="text" name="first_name" required>
                        <p class="p_form_log">Фамилия</p>
                        <input  class="input_log"type="text" name="last_name" required>
                        <p class="p_form_log">Почта</p>
                        <input  class="input_log"type="email" name="email" required>
                        <p class="p_form_log">Пароль</p>
                        <input class="input_log"type="text" name="password" required>
                        <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                if ($error == 'invalid_data') {
                                    echo '<p class="error_message">Пользователь с таким лоигном или почтой уже существует</p>';
                                }
                            }
                        ?>
                        <button id="registerBtn" type="submit" class="btn_log"><b>Зарегистрироваться</b></button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <!-- <div class="col col-1"></div> -->
                <div class="col col-8">
                    <div class="carousel">
                        <button id="prevBtn">←</button>
                        <div class="carousel-container" id="carouselContainer">
                        <!-- Товары будут добавлены здесь динамически -->
                        </div>
                        <button id="nextBtn">→</button>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <div>
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
<script src="carousel.js"></script>