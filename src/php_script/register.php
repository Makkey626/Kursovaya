<?php
        // register.php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db_connect.php";

            // Проверяем соединение
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Получаем данные из формы
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хешируем пароль

            // Проверяем, существует ли уже пользователь
            $sql = "SELECT * FROM my_shop WHERE username='$username' OR email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                header("Location: /login.php?error=invalid_data"); // Перенаправление с ошибкой
                exit();
            } else {
                // Вставляем нового пользователя
                $sql = "INSERT INTO my_shop (username, first_name, last_name, email, password)
                        VALUES ('$username', '$first_name', '$last_name', '$email', '$password')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: /login.php");
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }
        ?>