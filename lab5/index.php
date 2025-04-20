<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска объявлений</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Доска объявлений</h1>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="category">Категория:</label>
                <select id="category" name="category" required>
                    <option value="">Выберите категорию</option>
                    <option value="телефоны">Телефоны</option>
                    <option value="компьютеры">Компьютеры</option>
                    <option value="робототехника">Робототехника</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="title">Заголовок объявления:</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="text">Текст объявления:</label>
                <textarea id="text" name="text" rows="4" required></textarea>
            </div>
            
            <button type="submit" name="submit">Добавить</button>
        </form>
        
        <h2>Список объявлений</h2>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Категория</th>
                    <th>Заголовок</th>
                    <th>Текст</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // папки категорий
                $categories = ['телефоны', 'компьютеры', 'робототехника'];
                foreach ($categories as $category) {
                    if (!file_exists("categories/$category")) {
                        mkdir("categories/$category", 0777, true);
                    }
                }
                
                // Обработка формы
                if (isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $category = $_POST['category'];
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    
                    // Создаем файл с объявлением
                    $filename = "categories/$category/" . preg_replace('/[^a-zA-Zа-яА-Я0-9]/u', '_', $title) . ".txt";
                    file_put_contents($filename, $text);
                }
                
                // Вывод объявлений
                $ads = [];
                foreach ($categories as $category) {
                    $files = glob("categories/$category/*.txt");
                    foreach ($files as $file) {
                        $title = basename($file, '.txt');
                        $title = str_replace('_', ' ', $title);
                        $text = file_get_contents($file);
                        $ads[] = [
                            'email' => 'Не указан', // В реальном приложении нужно хранить email
                            'category' => $category,
                            'title' => $title,
                            'text' => $text
                        ];
                    }
                }
                
                // Сортировка объявлений по дате
                usort($ads, function($a, $b) {
                    return strcmp($b['title'], $a['title']);
                });
                
                // Вывод объявления в таблицу
                foreach ($ads as $ad) {
                    echo "<tr>
                            <td>{$ad['email']}</td>
                            <td>{$ad['category']}</td>
                            <td>{$ad['title']}</td>
                            <td>{$ad['text']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
