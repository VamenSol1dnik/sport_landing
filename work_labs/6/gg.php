<?php

$xml = simplexml_load_file('catalog.xml');


if ($xml === false) {
    echo "Помилка при завантаженні XML файлу.";
    exit;
}


echo "<h1>Каталог товарів</h1>";

echo "<table border='1'>";
echo "<tr>
        <th>Назва товару</th>
        <th>Категорія</th>
        <th>Ціна</th>
        <th>Серійний номер</th>
        <th>Рік випуску</th>
        <th>Зображення</th>
        <th>Параметри</th>
      </tr>";


foreach ($xml->product as $product) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($product->name) . "</td>";
    echo "<td>" . htmlspecialchars($product->category) . "</td>";
    echo "<td>" . htmlspecialchars($product->price) . "</td>";
    echo "<td>" . htmlspecialchars($product->serialNumber) . "</td>";
    echo "<td>" . htmlspecialchars($product->year) . "</td>";

    // Виводимо зображення
    echo "<td>";
    foreach ($product->image as $image) {
        echo "<img src='" . htmlspecialchars($image) . "' alt='Image' width='100' height='100'>";
    }
    echo "</td>";

    // Виводимо параметри
    echo "<td>";
    foreach ($product->parameters->parameter as $param) {
        echo htmlspecialchars($param) . "<br>";
    }
    echo "</td>";

    echo "</tr>";
}

echo "</table>";
?>