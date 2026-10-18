<?php
require_once 'db.php';

// Получаем выбранную категорию или район из URL
$cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;
$region = isset($_GET['region']) ? $_GET['region'] : '';

// Запрос в базу данных
if ($region != '') {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE region = ? ORDER BY id DESC");
    $stmt->execute([$region]);
    $title_page = "Hudud: " . htmlspecialchars($region);
} elseif ($cat_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE category_id = ? ORDER BY id DESC");
    $stmt->execute([$cat_id]);
    $title_page = "Kategoriya bo'yicha yangiliklar";
} else {
    $stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC");
    $title_page = "Barcha yangiliklar";
}

$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title_page; ?> - Qoraqalpog'iston Tongi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Подключаем шапку или создаем меню -->
    <header class="bg-sky-600 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold">Qoraqalpog'iston Tongi</a>
            <a href="index.php" class="bg-white/20 hover:bg-white/30 px-3 py-1.5 rounded-lg text-sm">← Bosh sahifa</a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6 w-full flex-grow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6"><?php echo $title_page; ?></h1>

        <?php if (empty($articles)): ?>
            <p class="text-gray-500">Ushbu bo'limda hozircha yangiliklar yo'q.</p>
        <?php else: ?>
            <!-- Сетка карточек-блоков -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($articles as $item): ?>
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                        <?php if (!empty($item['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" class="w-full h-48 object-cover">
                        <?php endif; ?>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="mb-2">
                                <span class="text-xs font-bold text-sky-600 bg-sky-50 px-2.5 py-1 rounded-md">
                                    📍 <?php echo !empty($item['region']) ? htmlspecialchars($item['region']) : 'Nukus'; ?>
                                </span>
                            </div>

                            <h3 class="font-bold text-gray-900 mb-2 text-base leading-snug">
                                <?php echo htmlspecialchars($item['title_uz']); ?>
                            </h3>

                            <p class="text-xs text-gray-600 mb-4 line-clamp-3 flex-grow">
                                <?php echo htmlspecialchars(mb_strimwidth($item['content_uz'], 0, 150, "...")); ?>
                            </p>

                            <a href="article.php?id=<?php echo $item['id']; ?>" class="inline-block text-center bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition">
                                Batafsil o'qish →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>