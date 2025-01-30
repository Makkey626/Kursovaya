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
                    <a class="a_info_header" href="index.php">Главная</a><b> > </b> <span style="color: #9A9494;">Личный кабинет</span>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col col-2">
                    <div class="info_for_delivere">
                        <div class="info_dev"><img src="img/user-svgrepo-com.svg" width=10% alt=""><p class="acc_p"><b>Информация</b></p></div>
                        <hr>
                        <form class="form_acc" action="">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Адрес доставки: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>E-mail: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Имя: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Фамилия: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Индекс: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Индекс: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Город: </b></p>
                            <input class="input_acc" type="text">
                            <p class=" acc_p acc_p-form"><span style="color: red;">*</span><b>Контактный телефон: </b></p>
                            <input class="input_acc" type="text">
                        </form>
                    </div>
                </div>
                <div class="col col-6">
                        <div class="info_for_delivere">
                            <div class="info_dev"><img src="img/bucket-svgrepo-com.svg" width=2.8% alt=""><p class="acc_p"><b>Корзина</b></p></div>
                            <hr>
                            <?php
                                // Соединение с БД и другие необходимые подключения
                                include 'php_script/db_connect.php';
                                include_once 'php_script/encrypt.php';

                                if (isset($_COOKIE['username'])) {
                                    $encrypted_username = $_COOKIE['username'];
                                    $username = decrypt_cookie($encrypted_username);

                                    if ($username === false) {
                                        echo "Ошибка расшифровки данных.";
                                        exit();
                                    }

                                    $stmt = $conn->prepare("SELECT p.id, p.name, p.price, p.image, c.quantity 
                                                            FROM product p
                                                            JOIN cart c ON p.id = c.product_id
                                                            WHERE c.username = ?");
                                    $stmt->bind_param("s", $username);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $total_price = 0;
                                    $delivery_cost = 250; // Фиксированная стоимость доставки
                                    $discount = 0; // Будет вычисляться при применении промокода

                                    if ($result->num_rows > 0) {
                                        echo "<table width='100%' border='1' cellspacing='0' cellpadding='10' style='text-align: center;'>";
                                        echo "<tr>
                                                <th>Товар</th>
                                                <th>Название</th>
                                                <th>Цена</th>
                                                <th>Количество</th>
                                                <th>Всего</th>
                                                <th>Действие</th>
                                            </tr>";

                                        while ($row = $result->fetch_assoc()) {
                                            $product_id = $row['id'];
                                            $product_name = htmlspecialchars($row['name']);
                                            $product_price = $row['price'];
                                            $product_image = htmlspecialchars($row['image']);
                                            $quantity = $row['quantity'];
                                            $total = $product_price * $quantity;
                                            $total_price += $total;

                                            echo "<tr data-product-id='$product_id'>
                                                    <td style='text-align: center;'>
                                                        <img src='img/$product_image' width='80' height='80' style='display: block; margin: 0 auto;'>
                                                    </td>
                                                    <td>$product_name</td>
                                                    <td class='price'>$product_price руб.</td>
                                                    <td>
                                                        <input type='number' class='quantity' value='$quantity' min='1' style='width: 50px; text-align: center;'>
                                                    </td>
                                                    <td class='total'>$total руб.</td>
                                                    <td>
                                                        <button class='remove-btn' data-product-id='$product_id' style='color: red;'>Удалить</button>
                                                    </td>
                                                </tr>";
                                        }

                                        // Вывод стоимости доставки
                                        $total_price_with_delivery = $total_price + $delivery_cost;

                                        echo "<tr>
                                                <td colspan='4' style='text-align: right;'><b>Стоимость доставки:</b></td>
                                                <td><b>$delivery_cost руб.</b></td>
                                                <td></td>
                                            </tr>";

                                        // Итоговая сумма без учета промокода
                                        echo "<tr>
                                                <td colspan='4' style='text-align: right;'><b>Итоговая сумма:</b></td>
                                                <td id='grand-total'><b>$total_price_with_delivery руб.</b></td>
                                                <td></td>
                                            </tr>";

                                        // Форма для ввода промокода
                                        echo "<tr>
                                                <td colspan='5'>
                                                    <form method='POST' id='promo-form'>
                                                        <input type='text' name='promo_code' id='promo_code' placeholder='Введите промокод'>
                                                        <button type='submit'>Применить</button>
                                                        <input type='hidden' id='discount' value='0'>
                                                    </form>
                                                </td>
                                                <td></td>
                                            </tr>";

                                        // Скрытое поле для хранения скидки
                                        echo "<tr>
                                                <td colspan='5'>
                                                    <input type='hidden' id='discount' value='0'>
                                                </td>
                                                <td></td>
                                            </tr>";

                                        echo "</table>";
                                        
                                    } else {
                                        echo "<p>В вашей корзине нет товаров.</p>";
                                    }
                                } else {
                                    echo "<p>Вы не авторизованы. Пожалуйста, войдите в систему.</p>";
                                }

                                $conn->close();
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="inner">
            <div class="row">
                <div class="col"></div>
            </div>
        </div>
    </div>

    <script>
    // Обработчик изменения количества товара
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('change', function () {
            let productId = this.closest('tr').getAttribute('data-product-id');
            let quantity = parseInt(this.value, 10); // Преобразуем значение в число

            // Проверяем, чтобы количество не было меньше 1
            if (isNaN(quantity) || quantity < 1) {
                alert('Количество товара не может быть меньше 1');
                return;
            }

            updateCart(productId, quantity); // Обновляем корзину
        });
    });

    // Функция для обновления корзины
    function updateCart(productId, quantity) {
        let formData = new FormData();
        formData.append("product_id", productId);
        formData.append("quantity", quantity);

        fetch("php_script/update_cart.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'success') {
                alert("Ошибка: " + (data.message || 'Неизвестная ошибка'));
                location.reload(); // Перезагрузка для синхронизации
            } else {
                // Проверка на наличие значения new_total
                if (data.new_total !== undefined) {
                    let row = document.querySelector(`tr[data-product-id="${productId}"]`);
                    row.querySelector('.total').textContent = data.new_total + ' руб.';
                    recalculateTotal(); // Пересчитываем общую сумму
                } else {
                    alert("Ошибка: нет данных о новой цене");
                }
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            alert("Сетевая ошибка!");
        });
    }

    // Пересчет общей суммы корзины
    function recalculateTotal() {
        let total = 0;
        document.querySelectorAll('.total').forEach(item => {
            total += parseFloat(item.textContent.replace(' руб.', ''));
        });

        // Добавляем стоимость доставки и применённую скидку
        let deliveryCost = 250; // Фиксированная стоимость доставки
        let discount = parseFloat(document.getElementById('discount').value) || 0;
        let grandTotal = total + deliveryCost - discount;

        // Обновляем итоговую сумму
        document.getElementById('grand-total').innerText = grandTotal + ' руб.';
    }

    // Обработчик удаления товара из корзины
    document.querySelector('.info_for_delivere table').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-btn')) {
            if (!confirm("Удалить товар из корзины?")) return;

            let row = event.target.closest('tr');
            let productId = row.getAttribute('data-product-id');

            // Отправка запроса на удаление товара из корзины
            fetch("php_script/remove_from_cart.php", {
                method: "POST",
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    row.remove(); // Удаляем строку из таблицы
                    recalculateTotal(); // Пересчитываем общую сумму
                } else {
                    alert("Ошибка при удалении товара: " + data.message);
                }
            })
            .catch(error => {
                console.error("Ошибка:", error);
                alert("Ошибка при удалении товара.");
            });
        }
    });

    // Обработчик ввода промокода
    // Обработчик ввода промокода
document.getElementById('promo-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем стандартную отправку формы

    let promoCode = document.getElementById('promo_code').value.trim();

    if (!promoCode) {
        alert("Введите промокод");
        return;
    }

    let formData = new FormData();
    formData.append('promo_code', promoCode);

    fetch('php_script/check_promo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Сохраняем скидку, если она есть
            document.getElementById('discount').value = data.discount || 0;
            recalculateTotal(); // Пересчитываем итоговую сумму
            alert("Промокод применен успешно!");
        } else {
            alert(data.message || 'Ошибка при применении промокода!');
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Ошибка при применении промокода!');
    });
});
</script>

