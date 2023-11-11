<?php
// Этот файл принимает POST-запросы с ключем и хвидом, затем сохраняет их в файл keys.txt

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];
    $hwid = $_POST['hwid'];

    // Проверяем, что ключ и хвид не пусты
    if (!empty($key) && !empty($hwid)) {
        // Открываем файл для записи
        $file = fopen('keys.txt', 'a');

        // Записываем ключ и хвид в файл
        fwrite($file, $key . '=' . $hwid . "\n");

        // Закрываем файл
        fclose($file);

        // Возвращаем успешный ответ
        echo json_encode(['success' => true]);
    } else {
        // Возвращаем ошибку, если ключ или хвид пусты
        echo json_encode(['error' => 'Key and HWID cannot be empty']);
    }
} else {
    // Возвращаем ошибку для неподдерживаемых запросов
    echo json_encode(['error' => 'Unsupported request method']);
}
?>
