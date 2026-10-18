<!DOCTYPE html>
<html lang="uz" class="light" id="htmlTag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gazeta Arxivi — Qoraqalpog'iston Tongi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; transition: background-color 0.3s, color 0.3s; }
        .bg-brand-sky { background-color: #0088cc; }
        .text-brand-sky { color: #0088cc; }
        .dark body { background-color: #0f172a; color: #f8fafc; }
        .dark header, .dark nav, .dark .bg-white { background-color: #1e293b !important; color: #f8fafc !important; border-color: #334155 !important; }
        .dark .text-gray-900, .dark .text-gray-800, .dark .text-gray-700, .dark .text-gray-600 { color: #f1f5f9 !important; }
    </style>
</head>
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

    <main class="max-w-7xl mx-auto px-4 py-8 flex-grow w-full">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200 shadow-sm mb-8">
            <h1 data-lang="archive_title" class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">📚 Gazetaning PDF Arxivi</h1>
            <p data-lang="archive_sub" class="text-gray-500 text-sm mb-6">O'zingizga kerakli yil va sonni tanlab, PDF formatda yuklab oling.</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label data-lang="lbl_year" class="block text-xs font-bold text-gray-700 mb-1">Yilni tanlang:</label>
                    <select class="w-full border border-gray-300 rounded-xl p-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-sky">
                        <option>2026 yil</option>
                        <option>2025 yil</option>
                    </select>
                </div>
                <div>
                    <label data-lang="lbl_month" class="block text-xs font-bold text-gray-700 mb-1">Oyni tanlang:</label>
                    <select class="w-full border border-gray-300 rounded-xl p-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-sky">
                        <option>Avgust</option>
                        <option>Iyul</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button data-lang="btn_filter" class="w-full bg-brand-sky hover:bg-sky-600 text-white font-bold py-2.5 rounded-xl shadow transition text-sm">Qidirish 🔍</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm text-center">
                <span class="text-5xl block mb-3">🗞️</span>
                <h3 class="font-black text-base text-gray-900">№ 32 (10 450)</h3>
                <p class="text-xs text-gray-500 mb-4">8-Avgust, 2026 yil</p>
                <a href="#" download class="block bg-slate-900 hover:bg-brand-sky text-white font-bold text-xs py-3 rounded-xl transition" data-lang="btn_dl">📥 PDF Yuklab olish</a>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm text-center">
                <span class="text-5xl block mb-3">🗞️</span>
                <h3 class="font-black text-base text-gray-900">№ 31 (10 449)</h3>
                <p class="text-xs text-gray-500 mb-4">1-Avgust, 2026 yil</p>
                <a href="#" download class="block bg-slate-900 hover:bg-brand-sky text-white font-bold text-xs py-3 rounded-xl transition" data-lang="btn_dl">📥 PDF Yuklab olish</a>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm text-center">
                <span class="text-5xl block mb-3">🗞️</span>
                <h3 class="font-black text-base text-gray-900">№ 30 (10 448)</h3>
                <p class="text-xs text-gray-500 mb-4">25-Iyul, 2026 yil</p>
                <a href="#" download class="block bg-slate-900 hover:bg-brand-sky text-white font-bold text-xs py-3 rounded-xl transition" data-lang="btn_dl">📥 PDF Yuklab olish</a>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-gray-400 py-6 text-center text-xs border-t border-slate-800">
        © 2026 «Qoraqalpog'iston Tongi». Barcha huquqlar himoyalangan.
    </footer>

    <script>
        // Дата и часы
        function updateClock() {
            const now = new Date();
            document.getElementById('liveClock').textContent = now.toLocaleTimeString('ru-RU');
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('liveDate').textContent = '📅 ' + now.toLocaleDateString('uz-UZ', options);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Погода в Нукусе (Open-Meteo API)
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

        // Курс валют ЦБ Узбекистана
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

        // Переключение языков
        const urlParams = new URLSearchParams(window.location.search);
        let currentLang = urlParams.get('lang') || localStorage.getItem('site_lang') || 'uz';

        const tr = {
            uz: {
                back_home: "← Bosh sahifa",
                gazeta_arxivi: "Gazeta Arxivi",
                search_ph: "Yangiqlarni qidirish...",
                theme_day: "Kunduzgi rejim",
                theme_night: "Tungi rejim",
                archive_title: "📚 Gazetaning PDF Arxivi",
                archive_sub: "O'zingizga kerakli yil va sonni tanlab, PDF formatda yuklab oling.",
                lbl_year: "Yilni tanlang:",
                lbl_month: "Oyni tanlang:",
                btn_filter: "Qidirish 🔍",
                btn_dl: "📥 PDF Yuklab olish"
            },
            qr: {
                back_home: "← Bas bet",
                gazeta_arxivi: "Gazeta Arxivi",
                search_ph: "Jan'aliqlardi izlew...",
                theme_day: "Ku'ndizgi rejim",
                theme_night: "Tungi rejim",
                archive_title: "📚 Gazetanin PDF Arxivi",
                archive_sub: "O'zin'izge kerekli jil ham sandi saylap, PDF formatta juklep alin'.",
                lbl_year: "Jildi saylan':",
                lbl_month: "Aydi saylan':",
                btn_filter: "Izlew 🔍",
                btn_dl: "📥 PDF Juklep aliw"
            },
            ru: {
                back_home: "← Главная",
                gazeta_arxivi: "Архив газеты",
                search_ph: "Поиск новостей...",
                theme_day: "Дневной режим",
                theme_night: "Ночной режим",
                archive_title: "📚 PDF Архив газеты",
                archive_sub: "Выберите нужный год и номер для скачивания в формате PDF.",
                lbl_year: "Выберите год:",
                lbl_month: "Выберите месяц:",
                btn_filter: "Поиск 🔍",
                btn_dl: "📥 Скачать PDF"
            }
        };
        function changeLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('site_lang', lang);

            document.querySelectorAll('[data-lang]').forEach(el => {
                const key = el.getAttribute('data-lang');
                if (tr[lang] && tr[lang][key]) {
                    el.textContent = tr[lang][key];
                }
            });

            const searchInput = document.getElementById('searchInput');
            if (searchInput && tr[lang] && tr[lang].search_ph) {
                searchInput.placeholder = tr[lang].search_ph;
            }

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
                if (themeText) {
                    themeText.setAttribute('data-lang', 'theme_night');
                    themeText.textContent = tr[currentLang] ? tr[currentLang].theme_night : 'Tungi rejim';
                }
            } else {
                document.documentElement.classList.remove('dark');
                if (themeIcon) themeIcon.textContent = '☀️';
                if (themeText) {
                    themeText.setAttribute('data-lang', 'theme_day');
                    themeText.textContent = tr[currentLang] ? tr[currentLang].theme_day : 'Kunduzgi rejim';
                }
            }
        }

        function toggleDarkMode() {
            const isDark = !document.documentElement.classList.contains('dark');
            localStorage.setItem('site_theme', isDark ? 'dark' : 'light');
            updateThemeUI(isDark);
        }

        // Автоматически применяем выбранный язык при загрузке
        changeLanguage(currentLang);

// При загрузке страницы проверяем сохраненную тему
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('site_theme') || 'light';
    updateThemeUI(savedTheme === 'dark');
});

    </script>
</body>
</html>