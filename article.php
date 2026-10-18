<?php
require_once 'db.php';

// Получаем ID статьи из URL (например, article.php?id=1)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Берем нужную статью из базы данных
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

// Если статья не найдена, показываем ошибку
if (!$article) {
    die("Новость не найдена!");
}

// Увеличиваем счетчик просмотров на +1
$updateViews = $pdo->prepare("UPDATE articles SET views_count = views_count + 1 WHERE id = ?");
$updateViews->execute([$id]);
?>
<!DOCTYPE html>
<html lang="uz" class="light" id="htmlTag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqola – Qoraqalpog'iston tongi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; transition: background-color 0.3s, color 0.3s; }
        .bg-brand-sky { background-color: #0088cc; }
        .text-brand-sky { color: #0088cc; }
        
        /* Исправление темной темы: при удалении класса dark фоны автоматически становятся белыми */
        .dark body { background-color: #0f172a !important; color: #f8fafc !important; }
        .dark header, .dark nav, .dark article, .dark .bg-white { background-color: #1e293b !important; color: #f8fafc !important; border-color: #334155 !important; }
        .dark .text-gray-900, .dark .text-gray-800, .dark .text-gray-700, .dark .text-gray-500 { color: #f1f5f9 !important; }
        .dark input { background-color: #0f172a !important; color: #ffffff !important; border-color: #334155 !important; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
<div class="bg-brand-sky text-white py-2 px-4 text-xs shadow-inner">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
        
        <!-- ЛЕВАЯ ЧАСТЬ: Кнопка, Дата, Часы, Погода, Курсы -->
        <div class="flex flex-wrap items-center gap-3 font-medium">
            <a href="index.html" data-lang="back_home" class="inline-flex items-center shrink-0 bg-white text-brand-sky hover:bg-sky-50 px-3 py-1 rounded-lg shadow font-bold transition text-xs">
             ← Bosh sahifa
            </a>
            <span id="liveDate">📅 ...</span>
            <span>⏰ <strong id="liveClock">00:00:00</strong></span>
            <span id="weatherInfo" class="bg-white/20 px-2 py-0.5 rounded-md">🌤️ Nukus: --°C</span>
            <span id="currencyInfo" class="bg-white/20 px-2 py-0.5 rounded-md">💵 USD: -- | EUR: -- | RUB: --</span>
        </div>

        <!-- ПРАВАЯ ЧАСТЬ: Языки и Тёмный режим (ТОЛЬКО ОДИН РАЗ) -->
        <div class="flex items-center gap-2 font-semibold shrink-0">
            <button id="lang-qr" onclick="changeLanguage('qr')" class="lang-btn bg-white/20 hover:bg-white/30 text-white px-2.5 py-1 rounded-lg transition flex items-center gap-1.5">
                <svg class="w-5 h-3.5 rounded shadow-sm shrink-0 border border-white/20" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
                    <rect width="600" height="300" fill="#0088cc"/>
                    <rect y="100" width="600" height="10" fill="#d80027"/>
                    <rect y="110" width="600" height="80" fill="#ffd700"/>
                    <rect y="190" width="600" height="10" fill="#d80027"/>
                    <rect y="200" width="600" height="100" fill="#10b981"/>
                    <circle cx="50" cy="50" r="22" fill="#ffffff"/>
                    <circle cx="58" cy="50" r="18" fill="#0088cc"/>
                    <g fill="#ffffff">
                        <circle cx="95" cy="50" r="3"/><circle cx="110" cy="50" r="3"/><circle cx="125" cy="50" r="3"/>
                        <circle cx="102" cy="36" r="3"/><circle cx="117" cy="36" r="3"/>
                    </g>
                </svg>
                <span>Qaraqalpaqsha</span>
            </button>

            <button id="lang-uz" onclick="changeLanguage('uz')" class="lang-btn bg-white/20 hover:bg-white/30 text-white px-2.5 py-1 rounded-lg transition flex items-center gap-1.5">
                <svg class="w-5 h-3.5 rounded shadow-sm shrink-0 border border-gray-200" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
                    <rect width="600" height="300" fill="#0099b5"/>
                    <rect y="95" width="600" height="10" fill="#d80027"/>
                    <rect y="105" width="600" height="90" fill="#ffffff"/>
                    <rect y="195" width="600" height="10" fill="#d80027"/>
                    <rect y="205" width="600" height="95" fill="#10b981"/>
                    <circle cx="50" cy="48" r="22" fill="#ffffff"/>
                    <circle cx="58" cy="48" r="18" fill="#0099b5"/>
                    <g fill="#ffffff">
                        <circle cx="125" cy="28" r="2.5"/><circle cx="140" cy="28" r="2.5"/><circle cx="155" cy="28" r="2.5"/>
                        <circle cx="110" cy="48" r="2.5"/><circle cx="125" cy="48" r="2.5"/><circle cx="140" cy="48" r="2.5"/><circle cx="155" cy="48" r="2.5"/>
                        <circle cx="95" cy="68" r="2.5"/><circle cx="110" cy="68" r="2.5"/><circle cx="125" cy="68" r="2.5"/><circle cx="140" cy="68" r="2.5"/><circle cx="155" cy="68" r="2.5"/>
                    </g>
                </svg>
                <span>O'zbekcha</span>
            </button>

            <button id="lang-ru" onclick="changeLanguage('ru')" class="lang-btn bg-white/20 hover:bg-white/30 text-white px-2.5 py-1 rounded-lg transition flex items-center gap-1.5">
                <svg class="w-5 h-3.5 rounded shadow-sm shrink-0 border border-white/20" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
                    <rect width="600" height="100" fill="#ffffff"/>
                    <rect y="100" width="600" height="100" fill="#0039a6"/>
                    <rect y="200" width="600" height="100" fill="#d52b1e"/>
                </svg>
                <span>Русский</span>
            </button>
<button onclick="toggleDarkMode()" class="bg-slate-900 hover:bg-slate-800 text-amber-400 px-2.5 py-1 rounded-lg shadow font-bold transition flex items-center gap-1 ml-1 shrink-0">
    <span id="themeIcon">☀️</span> 
    <span id="themeText" data-lang="theme_day" class="hidden sm:inline">Kunduzgi rejim</span>
</button>
        </div>

    </div>
</div>           
 <!-- ШАПКА: ЛОГОТИП СЛЕГКА УМЕНЬШЕН ПО ШИРИНЕ И РАСТЯНУТ ПО ВЫСОТЕ -->
    <header class="bg-white border-b border-gray-200 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            
            <a href="index.html" class="block mb-3">
                <img src="logo.png" alt="Qoraqalpog'iston Tongi" class="max-w-5xl w-full h-56 sm:h-72 object-fill mx-auto block rounded-lg" onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x400?text=QORAQALPOG%27ISTON+TONGI';">
            </a>

            <div class="flex justify-end items-center gap-3 w-full border-t border-gray-100 pt-2">
                <form onsubmit="event.preventDefault();" class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <div class="relative w-full sm:w-80">
                        <input type="text" id="searchInput" placeholder="Yangiliklarni qidirish..." class="w-full pl-3 pr-8 py-2 text-xs border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-sky text-gray-900">
                        <button type="submit" class="absolute right-2.5 top-2 text-gray-400 text-xs">🔍</button>
                    </div>
                    <a href="archive.html" class="shrink-0 bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                        <span>📚</span> <span data-lang="archive_btn">Gazeta Arxivi</span>
                    </a>
                </form>
            </div>

        </div>
    </header>
    <!-- Контент статьи -->
    <main class="max-w-4xl mx-auto px-4 py-8 flex-grow w-full">
        <article class="bg-white p-6 sm:p-10 rounded-3xl border border-gray-200 shadow-sm space-y-6">
            <div class="flex items-center gap-3 text-xs text-gray-500 font-medium">
                <span class="bg-sky-100 text-brand-sky px-3 py-1 rounded-md font-bold uppercase">Jamiyat</span>
                <span>📅 24-Avgust, 2026</span>
                <span>👁 <?php echo $article['views_count']; ?> ko'rildi</span>
            </div>

<h1 class="text-2xl sm:text-4xl font-black text-gray-900 leading-tight">
    <?php echo $article['title_uz']; ?>
</h1>

            <img src="<?php echo $article['image_url']; ?>" class="w-full h-80 sm:h-96 object-cover rounded-2xl">

            <div class="prose max-w-none text-gray-700 leading-relaxed text-sm sm:text-base space-y-4">
    <?php echo nl2br($article['content_uz']); ?>
</div>
        </article>
    </main>

    <footer class="bg-slate-900 text-gray-300 border-t-4 border-brand-sky mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap justify-between items-center gap-4 text-xs">
            <div>
                <h3 class="text-white font-extrabold text-sm">📰 «Qoraqalpog'iston Tongi»</h3>
                <p class="text-gray-400 mt-1">© 2026 Barcha huquqlar himoyalangan.</p>
            </div>
            <div>
                <a href="https://t.me/qqtongi1992" target="_blank" class="bg-sky-500 hover:bg-sky-600 text-white font-bold px-4 py-2 rounded-xl transition flex items-center gap-2">
                    ✈️ Telegram kanalimiz
                </a>
            </div>
        </div>
    </footer>

    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('liveClock').textContent = now.toLocaleTimeString('ru-RU');
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('liveDate').textContent = '📅 ' + now.toLocaleDateString('uz-UZ', options);
        }
        setInterval(updateClock, 1000);
        updateClock();

        async function fetchWeather() {
            try {
                const res = await fetch('https://api.open-meteo.com/v1/forecast?latitude=42.4608&longitude=59.6166&current_weather=true');
                const data = await res.json();
                const temp = Math.round(data.current_weather.temperature);
                document.getElementById('weatherInfo').textContent = `🌤️ Nukus: ${temp > 0 ? '+' : ''}${temp}°C`;
            } catch (e) {
                document.getElementById('weatherInfo').textContent = '🌤️ Nukus: +28°C';
            }
        }
        fetchWeather();

        async function fetchCurrency() {
            try {
                const res = await fetch('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');
                const data = await res.json();
                const usd = data.find(c => c.Ccy === 'USD')?.Rate || '--';
                const eur = data.find(c => c.Ccy === 'EUR')?.Rate || '--';
                const rub = data.find(c => c.Ccy === 'RUB')?.Rate || '--';
                document.getElementById('currencyInfo').textContent = `💵 USD: ${usd} | EUR: ${eur} | RUB: ${rub}`;
            } catch (e) {
                document.getElementById('currencyInfo').textContent = '💵 USD: 12650 | EUR: 13800 | RUB: 140';
            }
        }
        fetchCurrency();
        
        const tr = {
            uz: {
                back_home: "← Bosh sahifa",
                gazeta_arxivi: "Gazeta Arxivi",
                search_ph: "Yangiliklarni qidirish...",
                theme_day: "Kunduzgi rejim",
                theme_night: "Tungi rejim"
            },
            qr: {
                back_home: "← Bas bet",
                gazeta_arxivi: "Gazeta Arxivi",
                search_ph: "Jan'aliqlardi izlew...",
                theme_day: "Ku'ndizgi rejim",
                theme_night: "Tungi rejim"
            },
            ru: {
                back_home: "← Главная",
                gazeta_arxivi: "Архив газеты",
                search_ph: "Поиск новостей...",
                theme_day: "Дневной режим",
                theme_night: "Ночной режим"
            }
        };

        let currentLang = localStorage.getItem('site_lang') || 'uz';

        function changeLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('site_lang', lang);

            // Перевод элементов с data-lang
            document.querySelectorAll('[data-lang]').forEach(el => {
                const key = el.getAttribute('data-lang');
                if (tr[lang] && tr[lang][key]) el.textContent = tr[lang][key];
            });

            // Перевод placeholder в поиске
            const searchInput = document.getElementById('searchInput');
            if (searchInput && tr[lang] && tr[lang].search_ph) {
                searchInput.placeholder = tr[lang].search_ph;
            }

            // Подсветка активной кнопки языка
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.className = "lang-btn bg-white/20 hover:bg-white/30 text-white px-2.5 py-1 rounded-lg transition flex items-center gap-1.5 font-semibold";
            });

            const activeBtn = document.getElementById(`lang-${lang}`);
            if (activeBtn) {
                activeBtn.className = "lang-btn bg-white text-brand-sky px-2.5 py-1 rounded-lg shadow font-bold transition flex items-center gap-1.5";
            }

            const isDark = document.documentElement.classList.contains('dark');
            updateThemeUI(isDark);
        }

        function updateThemeUI(isDark) {
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');

            if (isDark) {
                document.documentElement.classList.add('dark');
                if (themeIcon) themeIcon.textContent = '🌙';
                if (themeText) themeText.textContent = tr[currentLang]?.theme_night || 'Tungi rejim';
            } else {
                document.documentElement.classList.remove('dark');
                if (themeIcon) themeIcon.textContent = '☀️';
                if (themeText) themeText.textContent = tr[currentLang]?.theme_day || 'Kunduzgi rejim';
            }
        }

        function toggleDarkMode() {
            const isDark = !document.documentElement.classList.contains('dark');
            localStorage.setItem('site_theme', isDark ? 'dark' : 'light');
            updateThemeUI(isDark);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('site_theme') || 'light';
            updateThemeUI(savedTheme === 'dark');
            changeLanguage(currentLang);
        });

function changeLanguage(lang) {
    currentLang = lang;
    localStorage.setItem('site_lang', lang);

    // Перевод текстовых элементов с data-lang
    document.querySelectorAll('[data-lang]').forEach(el => {
        const key = el.getAttribute('data-lang');
        if (tr[lang] && tr[lang][key]) el.textContent = tr[lang][key];
    });

    // Перевод placeholder поиска
    const searchInput = document.querySelector('input[type="text"]');
    if (searchInput && tr[lang] && tr[lang].search_ph) {
        searchInput.placeholder = tr[lang].search_ph;
    }

    // Подсветка кнопок
    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.className = "lang-btn bg-white/20 hover:bg-white/30 text-white px-2.5 py-1 rounded-lg transition flex items-center gap-1.5 font-semibold";
    });

    const activeBtn = document.getElementById(`lang-${lang}`);
    if (activeBtn) {
        activeBtn.className = "lang-btn bg-white text-brand-sky px-2.5 py-1 rounded-lg shadow font-bold transition flex items-center gap-1.5";
    }
  }
function updateThemeUI(isDark) {
    const themeIcon = document.getElementById('themeIcon');
    const themeText = document.getElementById('themeText');

    if (isDark) {
        document.documentElement.classList.add('dark');
        if (themeIcon) themeIcon.textContent = '🌙';
        if (themeText) themeText.textContent = 'Tungi rejim';
    } else {
        document.documentElement.classList.remove('dark');
        if (themeIcon) themeIcon.textContent = '☀️';
        if (themeText) themeText.textContent = 'Kunduzgi rejim';
    }
}

function toggleDarkMode() {
    const isDark = !document.documentElement.classList.contains('dark');
    localStorage.setItem('site_theme', isDark ? 'dark' : 'light');
    updateThemeUI(isDark);
}
// Автоматический запуск при загрузке страницы
changeLanguage(currentLang);
// При загрузке страницы проверяем сохраненную тему
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('site_theme') || 'light';
    updateThemeUI(savedTheme === 'dark');
});
    </script>
</body>
</html>