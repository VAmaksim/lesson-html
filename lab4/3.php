<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подсчет длинных слов</title>
    <style>
        textarea { width: 100%; height: 200px; }
        button { margin-top: 14px; }
    </style>
</head>
<body>

<form method="post">
    <textarea name="text"><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea><br>
    <button type="submit">Подсчитать</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["text"])) {
    $text = trim($_POST["text"]);

    // Разделение текста на слова
    $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

    // Подсчёт слов, длина которых больше 5 букв
    $longWordCount = 0;
    foreach ($words as $word) {
        if (mb_strlen($word, 'UTF-8') > 5) { // mb_strlen для корректной работы с UTF-8
            $longWordCount++;
        }
    }

    echo "<p>Количество слов длиннее 5 букв: <strong>$longWordCount</strong></p>";
}
?>

</body>
</html>
