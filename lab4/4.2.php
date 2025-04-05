<?php
// Страница для вывода данных
session_start();

$car_make = $_SESSION['car_make'] ?? 'Не задано';
$car_year = $_SESSION['car_year'] ?? 'Не задано';
$car_mileage = $_SESSION['car_mileage'] ?? 'Не задано';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные об автомобиле</title>
</head>
<body>

<h2>Данные об автомобиле</h2>
<p><strong>Марка автомобиля:</strong> <?php echo htmlspecialchars($car_make); ?></p>
<p><strong>Год выпуска:</strong> <?php echo htmlspecialchars($car_year); ?></p>
<p><strong>Пробег:</strong> <?php echo htmlspecialchars($car_mileage); ?></p>

<a href="form.php">Назад к форме</a>

</body>
</html>
