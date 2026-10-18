<?php
require_once 'db.php';

$message = '';

// Обработка отправки формы добавления новости
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $title_uz   = $_POST['title_uz'];
    $title_qr   = $_POST['title_qr'];
    $title_ru   = $_POST['title_ru'];
    $content_uz = $_POST['content_uz'];
    $content_qr = $_POST['content_qr'];
    $content_ru = $_POST['content_ru'];
    $image_url  = $_POST['image_url'];
    $category_id = (int)$_POST['category_id'];

    if (!empty($title_uz) && !empty($content_uz)) {
        $stmt = $pdo->prepare("INSERT INTO articles (title_uz, title_qr, title_ru, content_uz, content_qr, content_ru, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title_uz, $title_qr, $title_ru, $content_uz, $content_qr, $content_ru, $image_url, $category_id]);
        $message = "Новость успешно добавлена!";
    } else {
        $message = "Заполните хотя бы заголовок и текст на узбекском!";
    }
}

// Получаем список категорий для выбора
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора - Qoraqalpog'iston Tongi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Панель управления статьями</h1>

        <?php if ($message): ?>
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="admin.php" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Категория:</label>
                <select name="category_id" class="w-full mt-1 p-2 border rounded-md">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name_ru']; ?> (<?php echo $cat['name_uz']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Заголовок (UZ) *:</label>
                <input type="text" name="title_uz" required class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Заголовок (QR):</label>
                <input type="text" name="title_qr" class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Заголовок (RU):</label>
                <input type="text" name="title_ru" class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ссылка на картинку (URL):</label>
                <input type="text" name="image_url" placeholder="https://..." class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Текст статьи (UZ) *:</label>
                <textarea name="content_uz" rows="4" required class="w-full mt-1 p-2 border rounded-md"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Текст статьи (QR):</label>
                <textarea name="content_qr" rows="4" class="w-full mt-1 p-2 border rounded-md"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Текст статьи (RU):</label>
                <textarea name="content_ru" rows="4" class="w-full mt-1 p-2 border rounded-md"></textarea>
            </div>

            <button type="submit" name="add_article" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 font-bold">
                Опубликовать новость
            </button>
        </form>
    </div>
</body>
</html>