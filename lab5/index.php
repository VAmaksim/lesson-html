<?php
// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $category = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';

    if ($email && $category && $title && $text) {
        // Создаем имя файла (заменяем пробелы на подчеркивания)
        $filename = str_replace(' ', '_', $title) . '.txt';
        $filepath = $category . '/' . $filename;
        
        // Сохраняем текст объявления в файл
        file_put_contents($filepath, "Email: $email\nТекст: $text");
    }
}

// Получаем список существующих объявлений
$categories = ['компьютеры', 'телефоны', 'фототехника'];
$ads = [];

foreach ($categories as $category) {
    if (is_dir($category)) {
        $files = scandir($category);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $content = file_get_contents($category . '/' . $file);
                // Парсим email из содержимого файла
                preg_match('/Email: (.*)/', $content, $email_matches);
                $email = $email_matches[1] ?? 'N/A';
                $text = str_replace("Email: $email\nТекст: ", '', $content);
                
                $ads[] = [
                    'category' => $category,
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'text' => $text,
                    'email' => $email
                ];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Доска объявлений</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Дополнительные стили для таблицы */
        .ads-table {
            width: 100%;
            margin-top: 40px;
            background: rgba(20, 0, 0, 0.7);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .ads-table th, .ads-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .ads-table th {
            background: rgba(142, 0, 0, 0.3);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .ads-table tr:hover td {
            background: rgba(142, 0, 0, 0.1);
        }
        
        h2 {
            color: #ffffff;
            margin: 40px 0 20px;
            font-weight: 600;
            text-shadow: 0 2px 10px rgba(142, 0, 0, 0.5);
            position: relative;
            padding-bottom: 10px;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, rgba(142, 0, 0, 0.8), transparent);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1>Доска объявлений</h1>
            
            <h2>Добавить объявление</h2>
            <form method="POST">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Ваш email">
                </div>
                
                <div class="input-group">
                    <label>Категория</label>
                    <select name="category" required>
                        <option value="">Выберите категорию</option>
                        <option value="компьютеры">Компьютеры</option>
                        <option value="телефоны">Телефоны</option>
                        <option value="фототехника">Фототехника</option>
                    </select>
                </div>
                
                <div class="input-group">
                    <label>Заголовок</label>
                    <input type="text" name="title" required placeholder="Заголовок объявления">
                </div>
                
                <div class="input-group">
                    <label>Текст объявления</label>
                    <textarea name="text" required placeholder="Подробное описание"></textarea>
                </div>
                
                <button type="submit">Добавить</button>
            </form>
        </div>
        
        <?php if (!empty($ads)): ?>
        <h2>Список объявлений</h2>
        <table class="ads-table">
            <thead>
                <tr>
                    <th>Категория</th>
                    <th>Заголовок</th>
                    <th>Текст</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?= htmlspecialchars($ad['category']) ?></td>
                    <td><?= htmlspecialchars($ad['title']) ?></td>
                    <td><?= htmlspecialchars($ad['text']) ?></td>
                    <td><?= htmlspecialchars($ad['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>
