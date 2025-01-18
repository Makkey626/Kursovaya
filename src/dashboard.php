<?php include 'php_script/get_info.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_style.css">
    <title>Личный кабинет</title>
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
                <div class="col col-8">
                    <a class="a_info_header" href="index.php">Главная</a><b> > </b> <span style="color: #9A9494;">Личный кабинет</span>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-3">
                    <div class="contact_lk">
                        <div class="head_lk">
                            <img src="img/user-svgrepo-com.svg" width="6%" alt=""><p class="p_lk"><b>Личная информация</b></p>
                        </div>
                        <hr>
                        <div class="lk_info">
                            <p class="lk_info_p"><strong>Логин:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                            <p class="lk_info_p"><strong>Имя:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
                            <p class="lk_info_p"><strong>Фамилия:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
                            <p class="lk_info_p"><strong>Почта:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            <a class="btn_log" href="#" onclick="logout();">Выйти</a>
                        </div>
                        <script>
                            function logout() {
                                if (confirm("Вы уверены, что хотите выйти?")) {
                                    window.location.href = "/php_script/delete_cookie.php"; // Переход на страницу выхода
                                }
                            }
                        </script>
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
</body>
</html>

<script src="search_script.js"></script>
