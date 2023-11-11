<?php
// Этот файл принимает POST-запросы с ключем, проверяет, не привязан ли данный ключ к хвиду,
// и если не привязан, привязывает к хвиду и возвращает его

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];

    // Проверяем, что ключ не пуст
    if (!empty($key)) {
        // Открываем файл с ключами и хвидами
        $keysFile = file_get_contents('keys.txt');
        $keys = explode("\n", $keysFile);

        // Проверяем, не привязан ли данный ключ к хвиду
        foreach ($keys as $line) {
            list($savedKey, $hwid) = explode('=', $line);
            if ($key === $savedKey) {
                // Если ключ уже привязан, возвращаем ошибку
                echo json_encode(['error' => 'Key already bound to HWID']);
                exit;
            }
        }

        // Если ключ не привязан, генерируем новый хвид
        $newHwid = bin2hex(random_bytes(16));

        // Добавляем новую пару ключ-хвид в файл
        file_put_contents('keys.txt', "\n{$key}={$newHwid}", FILE_APPEND);

        // Возвращаем новый хвид
        echo json_encode(['success' => true, 'hwid' => $newHwid]);
    } else {
        // Возвращаем ошибку, если ключ пуст
        echo json_encode(['error' => 'Key cannot be empty']);
    }
} else {
    // Возвращаем ошибку для неподдерживаемых запросов
    echo json_encode(['error' => 'Unsupported request method']);
}
?>
