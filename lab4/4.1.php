<?php
// Страница для ввода данных
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['car_make'] = $_POST['car_make'] ?? '';
    $_SESSION['car_year'] = $_POST['car_year'] ?? '';
    $_SESSION['car_mileage'] = $_POST['car_mileage'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Введите данные об автомобиле</title>
</head>
<body>

<h2>Введите данные об автомобиле</h2>

<form method="post">
    <label for="car_make">Марка автомобиля:</label><br>
    <input type="text" id="car_make" name="car_make" value="<?php echo $_SESSION['car_make'] ?? ''; ?>"><br><br>

    <label for="car_year">Год выпуска:</label><br>
    <input type="number" id="car_year" name="car_year" value="<?php echo $_SESSION['car_year'] ?? ''; ?>"><br><br>

    <label for="car_mileage">Пробег:</label><br>
    <input type="number" id="car_mileage" name="car_mileage" value="<?php echo $_SESSION['car_mileage'] ?? ''; ?>"><br><br>

    <button type="submit">Сохранить</button>
    <a href="display.php">Посмотреть данные</a>
</form>

</body>
</html>
