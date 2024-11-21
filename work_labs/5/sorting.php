<?php
// Функція для перевірки на наявність небезпечних шляхів
function sanitizePath($path) {
    $path = realpath($path); // Отримуємо абсолютний шлях
    $baseDir = realpath(__DIR__); // Отримуємо базову директорію скрипта

    // Перевіряємо, чи не намагається користувач вийти за межі поточної директорії
    if (strpos($path, $baseDir) !== 0) {
        die("Доступ заборонено!"); // Якщо так, то показуємо помилку
    }
    return $path;
}

// Отримуємо поточний каталог або використовуємо кореневу директорію
$directory = isset($_GET['dir']) ? sanitizePath($_GET['dir']) : __DIR__;
$orderBy = isset($_GET['sort']) ? $_GET['sort'] : 'name'; // Сортування за замовчуванням - ім'я

// Функція для перетворення розміру файлу в людське значення
function formatSize($size) {
    if ($size >= 1073741824) {
        return round($size / 1073741824, 2) . ' GB';
    } elseif ($size >= 1048576) {
        return round($size / 1048576, 2) . ' MB';
    } elseif ($size >= 1024) {
        return round($size / 1024, 2) . ' KB';
    } else {
        return $size . ' B';
    }
}

// Отримуємо список файлів і каталогів
$files = array_diff(scandir($directory), array('.', '..')); // Вибираємо всі файли, крім . та ..
$fileInfo = [];

foreach ($files as $file) {
    $filePath = $directory . DIRECTORY_SEPARATOR . $file;
    $fileInfo[] = [
        'name' => $file,
        'type' => is_dir($filePath) ? 'Каталог' : 'Файл',
        'size' => is_file($filePath) ? formatSize(filesize($filePath)) : '-',
        'created' => date("d-m-Y H:i:s", filectime($filePath)),
        'path' => $filePath
    ];
}

// Сортуємо список файлів за вибраним критерієм
if ($orderBy == 'date') {
    usort($fileInfo, function($a, $b) {
        return strtotime($a['created']) - strtotime($b['created']);
    });
} elseif ($orderBy == 'size') {
    usort($fileInfo, function($a, $b) {
        return filesize($a['path']) - filesize($b['path']);
    });
} else {
    usort($fileInfo, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}
?>

<!-- Виведення сторінки -->
<?php include('header.php'); ?>
<main>
    <h2>Файловий навігатор</h2>
    <form method="GET" action="file-manager.php">
        <label for="dir">Каталог: </label>
        <input type="text" name="dir" value="<?= htmlspecialchars($directory) ?>" readonly>
        <br>
        <label for="sort">Сортування: </label>
        <select name="sort" onchange="this.form.submit()">
            <option value="name" <?= ($orderBy == 'name') ? 'selected' : '' ?>>Ім'я</option>
            <option value="date" <?= ($orderBy == 'date') ? 'selected' : '' ?>>Дата</option>
            <option value="size" <?= ($orderBy == 'size') ? 'selected' : '' ?>>Розмір</option>
        </select>
    </form>

    <table>
        <tr>
            <th>Ім'я</th>
            <th>Тип</th>
            <th>Розмір</th>
            <th>Дата створення</th>
        </tr>
        <?php foreach ($fileInfo as $file): ?>
        <tr>
            <td><a href="<?= htmlspecialchars($file['path']) ?>"><?= htmlspecialchars($file['name']) ?></a></td>
            <td><?= htmlspecialchars($file['type']) ?></td>
            <td><?= htmlspecialchars($file['size']) ?></td>
            <td><?= htmlspecialchars($file['created']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include('footer.php'); ?>