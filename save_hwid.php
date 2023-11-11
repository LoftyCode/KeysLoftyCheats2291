<?php
$key = $_POST["key"];
$hwid = $_POST["hwid"];

// Здесь может быть ваша логика проверки ключа и хвид, например, запись в файл keys.txt

// Пример: проверка, что файл keys.txt существует
if (file_exists("keys.txt")) {
    // Пример: чтение из файла keys.txt
    $keysData = file_get_contents("keys.txt");

    // Пример: разделение строки на массив ключей
    $keysArray = explode("\n", $keysData);

    // Пример: проверка, что ключ уже занят
    if (in_array($key, $keysArray)) {
        echo "duplicate";
    } else {
        // Пример: добавление нового ключа в файл keys.txt
        file_put_contents("keys.txt", $key . "\n", FILE_APPEND);
        // Пример: запись соответствия ключа и хвид в файл keys_hwids.txt
        file_put_contents("keys_hwids.txt", $key . "=" . $hwid . "\n", FILE_APPEND);
        echo "success";
    }
} else {
    echo "error";
}
?>
