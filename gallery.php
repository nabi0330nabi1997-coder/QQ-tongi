<!DOCTYPE html>
<html lang="uz" class="light" id="htmlTag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotogalereya — Qoraqalpog'iston Tongi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; transition: background-color 0.3s, color 0.3s; }
        .bg-brand-sky { background-color: #0088cc; }
        .text-brand-sky { color: #0088cc; }
        .dark body { background-color: #0f172a; color: #f8fafc; }
        .dark header, .dark .bg-white { background-color: #1e293b !important; color: #f8fafc !important; border-color: #334155 !important; }
        .dark .text-gray-900, .dark .text-gray-600 { color: #f1f5f9 !important; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <div class="bg-brand-sky text-white py-2 px-4 text-xs shadow-inner">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-3">
            <span class="font-medium">📷 Qoraqalpog'iston fotosuretlarda</span>
            <div class="flex items-center gap-2 font-semibold">
                <button id="lang-qr" onclick="changeLanguage('qr')" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition flex items-center gap-2">Qaraqalpaqsha</button>
                <button id="lang-uz" onclick="changeLanguage('uz')" class="bg-white text-brand-sky px-3 py-1.5 rounded-lg shadow font-bold flex items-center gap-2">O'zbekcha</button>
                <button id="lang-ru" onclick="changeLanguage('ru')" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition flex items-center gap-2">Русский</button>
                <button onclick="toggleDarkMode()" class="bg-slate-900 text-amber-400 px-3 py-1.5 rounded-lg shadow font-bold transition ml-2">🌙</button>
            </div>
        </div>
    </div>

    <header class="bg-white border-b border-gray-200 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="index.html" class="nav-link font-black text-xl text-brand-sky">QORAQALPOG'ISTON TONGI</a>
            <a href="index.html" class="nav-link bg-brand-sky hover:bg-sky-600 text-white font-bold text-xs px-4 py-2 rounded-xl transition" data-lang="back_home">← Bosh sahifa</a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8 flex-grow w-full">
        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-6" data-lang="gal_title">🖼️ Fotogalereya</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                <img src="https://images.unsplash.com/photo-1572949645841-094f3a9c4c94?q=80&w=800&auto=format&fit=crop" class="w-full h-52 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-sm text-gray-900 mb-1" data-lang="img1_title">Oqchako'l bo'yidagi manzara</h3>
                    <p class="text-xs text-gray-500">Mo'ynoq tumani, 2026</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=800&auto=format&fit=crop" class="w-full h-52 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-sm text-gray-900 mb-1" data-lang="img2_title">Qoraqalpog'iston dalalari</h3>
                    <p class="text-xs text-gray-500">Agrar soha, 2026</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                <img src="https://images.unsplash.com/photo-1477959858617-67f30ac4ce78?q=80&w=800&auto=format&fit=crop" class="w-full h-52 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-sm text-gray-900 mb-1" data-lang="img3_title">Nukus shahri markazi</h3>
                    <p class="text-xs text-gray-500">Nukus, 2026</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-gray-400 py-6 text-center text-xs border-t border-slate-800">
        © 2026 «Qoraqalpog'iston Tongi». Barcha huquqlar himoyalangan.
    </footer>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        let currentLang = urlParams.get('lang') || localStorage.getItem('site_lang') || 'uz';

        const tr = {
            uz: { back_home: '← Bosh sahifa', gal_title: '🖼️ Fotogalereya', img1_title: 'Oqchako\'l bo\'yidagi manzara', img2_title: 'Qoraqalpog\'iston dalalari', img3_title: 'Nukus shahri markazi' },
            qr: { back_home: '← Bas bet', gal_title: '🖼️ Fotogalereya', img1_title: 'Oqshakól boyındagı kórinis', img2_title: 'Qaraqalpaqstan atızları', img3_title: 'Nukus qalası orayı' },
            ru: { back_home: '← Главная', gal_title: '🖼️ Фотогалерея', img1_title: 'Вид на озеро Акчаколь', img2_title: 'Поля Каракалпакстана', img3_title: 'Центр города Нукус' }
        };

        function changeLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('site_lang', lang);
            document.querySelectorAll('[data-lang]').forEach(el => {
                const k = el.getAttribute('data-lang');
                if (tr[lang] && tr[lang][k]) el.textContent = tr[lang][k];
            });
            document.querySelectorAll('.nav-link').forEach(a => {
                const b = a.getAttribute('href').split('?')[0];
                a.setAttribute('href', `${b}?lang=${lang}`);
            });
        }

        function toggleDarkMode() { document.getElementById('htmlTag').classList.toggle('dark'); }
        changeLanguage(currentLang);
    </script>
</body>
</html>