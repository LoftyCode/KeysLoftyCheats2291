<?php
$key = $_POST['key'];
$hwid = $_POST['hwid'];

if ($key && $hwid) {
    $filename = "keys.txt";

    // Читаем текущий файл keys.txt
    $currentData = file_get_contents($filename);

    // Проверяем, есть ли уже такой ключ в файле
    if (strpos($currentData, $key) === false) {
        // Добавляем новую строку с ключем и хвидом
        file_put_contents($filename, $key . "=" . $hwid . PHP_EOL, FILE_APPEND | LOCK_EX);
        echo "success";
    } else {
        echo "duplicate";
    }
} else {
    echo "error";
}
?>
