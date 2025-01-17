<?php include 'php_script/check_cookie.php'?>
<?php include 'php_script/add_product.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main_style.css">
</head>
<div>
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
                            <a href="<?php echo isset($_COOKIE['user']) ? 'dashboard.php' : 'login.php'; ?>" class="a_info_header">
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
                    <a class="a_info_header" href="index.php">Главная</a><b> > </b> <span style="color: #9A9494;">Панель администратора</span>
                </div>
            </div>
        </div>
    </div>



    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-8">
                    <div class="contact_lk">
                        <p class="p_lk"><b>Добавьте товар</b></p>
                        <hr>
                        <form action="php_script/add_product.php" method="post" enctype="multipart/form-data">
                            <div class="admin_table_add">
                                <div class="first_col">
                                    <div style="width: 50%">
                                        <p class="p_admin_panel">Название:</p>
                                        <p class="p_admin_panel">Артикул:</p>
                                        <p class="p_admin_panel">Цена:</p>
                                        <p class="p_admin_panel">Цвет:</p>
                                        <p class="p_admin_panel">Категория:</p>
                                    </div>
                                    <div style="width: 50%">
                                        <input class="input_admin" type="text" name="name" required>
                                        <input class="input_admin" type="text" name="article" required>
                                        <input class="input_admin" type="text" name="price" required>
                                        <select class="select_admin" name="color" id="">
                                            <option value="Белый">Белый</option>
                                            <option value="Жёлтый">Жёлтый</option>
                                            <option value="Зелёный">Зелёный</option>
                                            <option value="Красный">Красный</option>
                                            <option value="Оранжевый">Оранжевый</option>
                                            <option value="Синий">Синий</option>
                                            <option value="Чёрный">Чёрный</option>
                                        </select>
                                        <select class="select_admin" name="category" id="category">
                                            <option value="Флаги">Флаги</option>
                                            <option value="На липучке">На липучке</option>
                                            <option value="Военные">Военные</option>
                                            <option value="Медик">Медик</option>
                                            <option value="Группа крови">Группа крови</option>
                                            <option value="На спину">На спину</option>
                                            <option value="Байкерские">Байкерские</option>
                                            <option value="Прикольные">Прикольные</option>
                                            <option value="Детские">Детские</option>
                                            <option value="Аппликация">Аппликация</option>
                                            <option value="Маленькие">Маленькие</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="second_col">
                                    <p class="p_admin_panel">Описание:</p>
                                    <textarea class="admin_text_area" required name="description" id=""></textarea>
                                    <p class="p_admin_panel">Изображение<input class="input_admin" type="file" name="image"></p> 
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center; margin-top: 40px"><button class="btn_log" type="submit"><b>Добавить товар</b></button></div>
                            <?php
                             echo '<div style="display: flex; justify-content: center; margin-top: 40px">';
                                if (isset($_GET['success']) && $_GET['success'] == 'true') {
                                    echo '<p style="color: green;">Товар успешно добавлен!</p>';
                                }

                                if (isset($_GET['error'])) {
                                    echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
                                }
                            echo '</div>'
                            ?>
                        </form>  
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