<!DOCTYPE html>
<html lang="uz" class="light" id="htmlTag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aloqa — Qoraqalpog'iston Tongi</title>
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
            <span class="font-medium">✉️ Tahririyat bilan bog'lanish</span>
            <div class="flex items-center gap-2 font-semibold">
                <button id="lang-qr" onclick="changeLanguage('qr')" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition">Qaraqalpaqsha</button>
                <button id="lang-uz" onclick="changeLanguage('uz')" class="bg-white text-brand-sky px-3 py-1.5 rounded-lg shadow font-bold">O'zbekcha</button>
                <button id="lang-ru" onclick="changeLanguage('ru')" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition">Русский</button>
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200 shadow-sm">
                <h1 class="text-2xl font-black text-gray-900 mb-4" data-lang="contact_title">📍 Tahririyat rekvizitlari</h1>
                <div class="space-y-4 text-xs sm:text-sm text-gray-600">
                    <p><strong class="text-gray-900" data-lang="lbl_add">Manzil:</strong> Qoraqalpog'iston Respublikasi, Nukus sh., I.Karimov guzari, 111-uy.</p>
                    <p><strong class="text-gray-900">Tel:</strong> +998 (61) 222-81-18</p>
                    <p><strong class="text-gray-900">Email:</strong> qq-tongi59@mail.ru</p>
                    <p><strong class="text-gray-900" data-lang="lbl_work">Ish vaqti:</strong> Dushanba — Juma, 09:00 - 18:00</p>
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200 shadow-sm">
                <h2 class="text-2xl font-black text-gray-900 mb-4" data-lang="form_title">💬 Murojaat yuborish</h2>
                <form onsubmit="event.preventDefault(); alert('Murojaatingiz qabul qilindi!');" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1" data-lang="lbl_name">Ismingiz:</label>
                        <input type="text" required class="w-full border border-gray-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-brand-sky">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Telefon / Email:</label>
                        <input type="text" required class="w-full border border-gray-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-brand-sky">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1" data-lang="lbl_msg">Xabaringiz:</label>
                        <textarea rows="4" required class="w-full border border-gray-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-brand-sky"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-brand-sky hover:bg-sky-600 text-white font-bold text-xs py-3 rounded-xl transition shadow" data-lang="btn_send">
                        Xabarni yuborish 🚀
                    </button>
                </form>
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
            uz: { back_home: '← Bosh sahifa', contact_title: '📍 Tahririyat rekvizitlari', lbl_add: 'Manzil:', lbl_work: 'Ish vaqti:', form_title: '💬 Murojaat yuborish', lbl_name: 'Ismingiz:', lbl_msg: 'Xabaringiz:', btn_send: 'Xabarni yuborish 🚀' },
            qr: { back_home: '← Bas bet', contact_title: '📍 Redaksiya rekvizitları', lbl_add: 'Mánzil:', lbl_work: 'Jumıs vaqtı:', form_title: '💬 Múrajaat jiberiw', lbl_name: 'Atıńız:', lbl_msg: 'Xabarıńız:', btn_send: 'Xabardı jiberiw 🚀' },
            ru: { back_home: '← Главная', contact_title: '📍 Реквизиты редакции', lbl_add: 'Адрес:', lbl_work: 'Рабочее время:', form_title: '💬 Отправить обращение', lbl_name: 'Ваше имя:', lbl_msg: 'Ваше сообщение:', btn_send: 'Отправить сообщение 🚀' }
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