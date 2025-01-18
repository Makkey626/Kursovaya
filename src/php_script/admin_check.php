<?php
include 'encrypt.php';

// Проверка, является ли пользователь администратором
function check_admin() {
    // Проверяем наличие куки с именем 'admin'
    if (isset($_COOKIE['admin'])) {
        $user = decrypt_cookie($_COOKIE['admin']); // Расшифровываем имя пользователя из куки

        // Проверяем, что имя пользователя равно 'admin'
        if ($user === 'admin') {
            return true; // Пользователь — администратор
        }
    }

    return false; // Пользователь не администратор
}

function show_admin_block() {
    if (check_admin()) {
        // Если это админ, показываем блок
        echo '<div class="check_admin">';
            echo '<a class="admin_href" href="admin_panel.php">';
                echo '<div class="admin_block">';
                    echo '<p class="admin_href"><b>Панель администратора</b></p>';
                echo '</div>';
            echo '</a>';
        echo '</div>';
    }
}

?>
