<?php

// Функция для шифрования данных
function encrypt_cookie($data) {
    $encryption_key = 'your_secret_key'; // Ключ шифрования
    $cipher = "AES-128-CBC"; // Алгоритм шифрования
    $ivlen = openssl_cipher_iv_length($cipher); // Длина IV
    $iv = openssl_random_pseudo_bytes($ivlen); // Генерация случайного IV
    
    // Шифрование данных
    $encrypted_data = openssl_encrypt($data, $cipher, $encryption_key, 0, $iv);
    
    // Возвращаем зашифрованные данные в виде base64-строки
    return base64_encode($encrypted_data . '::' . $iv);
}

// Функция для расшифровки данных
function decrypt_cookie($data) {
    $encryption_key = 'your_secret_key'; // Ключ шифрования
    $cipher = "AES-128-CBC"; // Алгоритм шифрования
    
    // Декодируем данные и разделяем зашифрованные данные и IV
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    
    // Расшифровываем данные
    return openssl_decrypt($encrypted_data, $cipher, $encryption_key, 0, $iv);
}

?>
