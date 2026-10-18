<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC LIMIT 1");
$article = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="uz" class="light" id="htmlTag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qoraqalpog'iston Tongi вЂ” Web-portal</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style> 
        body { font-family: 'Inter', sans-serif; transition: background-color 0.3s, color 0.3s; }
        .bg-brand-sky { background-color: #0088cc; }
        .border-brand-sky { border-color: #0088cc; }
        .text-brand-sky { color: #0088cc; }
        
        .dark body { background-color: #0f172a; color: #f8fafc; }
        .dark header, .dark nav, .dark .bg-white { background-color: #1e293b !important; color: #f8fafc !important; border-color: #334155 !important; }
        .dark .text-gray-900, .dark .text-gray-800, .dark .text-gray-700, .dark .text-gray-600 { color: #f1f5f9 !important; }
        .dark .bg-gray-50, .dark .bg-gray-100 { background-color: #0f172a !important; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <!-- Р’Р•Р РҐРќРЇРЇ РџРђРќР•Р›Р¬: Р”РђРўРђ, РџРћР“РћР”Рђ Р РўРћР§РќР«Р• Р¤Р›РђР“Р -->
    <div class="bg-brand-sky text-white py-2 px-4 text-xs shadow-inner">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-3">
            
            <div class="flex items-center gap-3 font-medium flex-wrap">
                <span id="liveDate">рџ“… ...</span>
                <span>вЏ° <strong id="liveClock">00:00:00</strong></span>
                <span class="border-l border-white/30 pl-3">вЂпёЏ Nukus: <strong id="liveWeather" class="text-amber-300">+32В°C</strong></span>
                <span id="currencyInfo" class="bg-white/20 px-2.5 py-1 rounded-md font-semibold">рџ’µ USD: -- | EUR: -- | RUB: --</span>
            </div>

            <!-- РџР•Р Р•РљР›Р®Р§Р•РќРР• РЇР—Р«РљРћР’ РЎ РўРћР§РќР«РњР Р’Р•РљРўРћР РќР«РњР Р¤Р›РђР“РђРњР -->
            <div class="flex items-center gap-2 font-semibold">
                
                <!-- Р¤Р›РђР“ РљРђР РђРљРђР›РџРђРљРЎРўРђРќРђ -->
                <button id="lang-qr" onclick="changeLanguage('qr')" class="lang-btn bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition flex items-center gap-2">
                    <svg class="w-6 h-4 rounded shadow-sm shrink-0 border border-white/20" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
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

                <!-- Р¤Р›РђР“ РЈР—Р‘Р•РљРРЎРўРђРќРђ -->
                <button id="lang-uz" onclick="changeLanguage('uz')" class="lang-btn bg-white text-brand-sky px-3 py-1.5 rounded-lg shadow font-bold flex items-center gap-2">
                    <svg class="w-6 h-4 rounded shadow-sm shrink-0 border border-gray-200" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
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

                <!-- Р¤Р›РђР“ Р РћРЎРЎРР -->
                <button id="lang-ru" onclick="changeLanguage('ru')" class="lang-btn bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition flex items-center gap-2">
                    <svg class="w-6 h-4 rounded shadow-sm shrink-0 border border-white/20" viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
                        <rect width="600" height="100" fill="#ffffff"/>
                        <rect y="100" width="600" height="100" fill="#0039a6"/>
                        <rect y="200" width="600" height="100" fill="#d52b1e"/>
                    </svg>
                    <span>Р СѓСЃСЃРєРёР№</span>
                </button>

                <button onclick="toggleDarkMode()" class="bg-slate-900 hover:bg-slate-800 text-amber-400 px-2.5 py-1 rounded-lg shadow font-bold transition flex items-center gap-1 ml-1 shrink-0">
                    <span id="themeIcon">вЂпёЏ</span> 
                    <span id="themeText" data-lang="theme_day" class="hidden sm:inline">Kunduzgi rejim</span>
                </button>
            </div>

        </div>
    </div>

    <!-- РЁРђРџРљРђ -->
    <header class="bg-white border-b border-gray-200 py-3 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            
            <a href="index.php" class="block mb-3">
                <img src="logo.png" alt="Qoraqalpog'iston Tongi" class="max-w-5xl w-full h-56 sm:h-72 object-fill mx-auto block rounded-lg" onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x400?text=QORAQALPOG%27ISTON+TONGI';">
            </a>

            <div class="flex justify-end items-center gap-3 w-full border-t border-gray-100 pt-2">
                <form onsubmit="event.preventDefault();" class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <div class="relative w-full sm:w-80">
                        <input type="text" id="searchInput" placeholder="Yangiliklarni qidirish..." class="w-full pl-3 pr-8 py-2 text-xs border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-sky text-gray-900">
                        <button type="submit" class="absolute right-2.5 top-2 text-gray-400 text-xs">рџ”Ќ</button>
                    </div>
                    <a href="archive.html" class="shrink-0 bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                        <span>рџ“љ</span> <span data-lang="archive_btn">Gazeta Arxivi</span>
                    </a>
                </form>
            </div>

        </div>
    </header>

    <!-- РќРђР’РР“РђР¦РРЇ -->
    <nav class="bg-brand-sky text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap items-center space-x-1 sm:space-x-2 text-xs md:text-sm font-bold py-2">
                <li><a href="index.php" data-lang="nav_home" class="bg-white/20 px-3.5 py-2 rounded-lg block">Bosh sahifa</a></li>
                
                <li class="relative">
                    <button onclick="toggleDropdown('dropdown1')" class="hover:bg-white/10 px-3.5 py-2 rounded-lg transition flex items-center gap-1 focus:outline-none">
                        <span data-lang="nav_about">Gazeta haqida</span> в–ѕ
                    </button>
                    <div id="dropdown1" class="hidden absolute left-0 w-48 bg-slate-900 text-white text-xs p-2 rounded-b-xl shadow-2xl border border-slate-800 z-50 mt-1">
                        <a href="article.html" class="art-link block p-2 hover:bg-slate-800 rounded" data-lang="drop_history">Tahririyat tarixi</a>
                        <a href="contact.html" class="block p-2 hover:bg-slate-800 rounded" data-lang="drop_team">Jamoa va Rekvizitlar</a>
                    </div>
                <li>
                    <a href="category.php?cat_id=1" class="art-link hover:bg-white/10 px-3.5 py-2 rounded-lg transition block" data-lang="nav_society">Jamiyat</a></li>
                <li><a href="category.php?cat_id=2" class="art-link hover:bg-white/10 px-3.5 py-2 rounded-lg transition block" data-lang="nav_economy">Ekonomika</a></li>
                <li><a href="category.php?cat_id=3" class="art-link hover:bg-white/10 px-3.5 py-2 rounded-lg transition block" data-lang="nav_agrar">Agrar yo'nalishlar</a></li>
                
                <li class="relative">
                    <button onclick="toggleDropdown('dropdown2')" class="hover:bg-white/10 px-3.5 py-2 rounded-lg transition flex items-center gap-1 focus:outline-none">
                        рџ“Ќ <span data-lang="nav_regions">Hududlar</span> в–ѕ
                    </button>
                    <div id="dropdown2" class="hidden absolute left-0 grid grid-cols-2 sm:grid-cols-3 w-80 sm:w-[480px] bg-slate-900 text-gray-200 text-xs p-4 rounded-b-xl shadow-2xl border border-slate-700 gap-2 z-50 mt-1">
                        <!-- Ссылки для районов -->
                            <a href="category.php?region=Mo'ynoq">Mo'ynoq tumani</a>
                            <a href="category.php?region=Nukus">Nukus shahri</a>
                            <a href="category.php?region=Chimboy">Chimboy tumani</a>
                            <a href="category.php?region=Beruniy">Beruniy tumani</a>
                            <a href="category.php?region=Amudaryo">Amudaryo tumani</a>
                            <a href="category.php?region=Ellikqala">Ellikqala tumani</a>
                            <a href="category.php?region=Qorao'zak">Qorao'zak tumani</a>
                            <a href="category.php?region=Taxtako'pir">Taxtako'pir tumani</a>
                            <a href="category.php?region=Xo'jayli">Xo'jayli tumani</a>
                            <a href="category.php?region=Shumanay">Shumanay tumani</a>
                            <a href="category.php?region=Qo'ng'irot">Qo'ng'irot tumani</a>
                            <a href="category.php?region=Qonliko'l">Qonliko'l tumani</a>
                            <a href="category.php?region=Taxiatosh">Taxiatosh tumani</a>
                            <a href="category.php?region=Bozataw">Bozataw tumani</a>
                    </div>
                </li>

                <li><a href="gallery.html" data-lang="nav_gallery" class="hover:bg-white/10 px-3.5 py-2 rounded-lg transition block">Fotogalereya</a></li>
                <li><a href="archive.html" data-lang="nav_archive" class="hover:bg-white/10 px-3.5 py-2 rounded-lg transition block">Gazeta Arxivi</a></li>
                <li><a href="contact.html" data-lang="nav_contact" class="hover:bg-white/10 px-3.5 py-2 rounded-lg transition block">Aloqa</a></li>
            </ul>
        </div>
    </nav>

    <!-- РџРћР›РќР«Р™ РљРћРќРўР•РќРў -->
    <main class="max-w-7xl mx-auto px-4 py-8 flex-grow w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                    <a href="article.html" class="art-link">
                        <img src="<?php echo $article['image_url']; ?>" alt="Rasm">
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="bg-sky-100 text-brand-sky text-xs font-bold px-3 py-1 rounded-md">рџ“Ќ Mo'ynoq tumani</span>
                            <span class="text-xs text-gray-400">рџ“… Bugun, 14:30</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 leading-tight mb-3 hover:text-brand-sky tr">
                    <a href="article.php?id=<?php echo $article['id']; ?>" class="art-link">
                    <?php echo $article['title_uz']; ?>
                    </a>
                    </h1>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4">
                         <?php echo $article['content_uz']; ?>
                              </p>
                        <a href="article.html" class="art-link inline-block bg-brand-sky hover:bg-sky-600 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow transition" data-lang="read_more">
                            Batafsil o'qish в†’
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                        <span class="text-[10px] text-gray-400 font-bold">рџ“… 8-Avgust, 2026</span>
                        <h3 class="font-bold text-sm text-gray-900 mt-1 mb-2">
                            <a href="article.html" class="art-link hover:text-brand-sky" data-lang="sub1_title">Qoraqalpog'istonda agrar soha vakillari uchun yangi imkoniyatlar</a>
                        </h3>
                        <p class="text-xs text-gray-500 mb-3" data-lang="sub1_desc">Qishloq xo'jaligi va suv resurslaridan unumli foydalanish masalalari ko'rib chiqildi.</p>
                        <a href="article.html" class="art-link text-brand-sky font-bold text-xs hover:underline" data-lang="read_more_short">O'qish в†’</a>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                        <span class="text-[10px] text-gray-400 font-bold">рџ“… 7-Avgust, 2026</span>
                        <h3 class="font-bold text-sm text-gray-900 mt-1 mb-2">
                            <a href="article.html" class="art-link hover:text-brand-sky" data-lang="sub2_title">Nukus shahrida obodonlashtirish ishlari jadallik bilan davom etmoqda</a>
                        </h3>
                        <p class="text-xs text-gray-500 mb-3" data-lang="sub2_desc">Shahar infratuzilmasini yaxshilash va ko'kalamzorlashtirish loyihalari boshlandi.</p>
                        <a href="article.html" class="art-link text-brand-sky font-bold text-xs hover:underline" data-lang="read_more_short">O'qish в†’</a>
                    </div>
                </div>
            </div>

            <!-- РџР РђР’РђРЇ РљРћР›РћРќРљРђ -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
                    <h3 class="text-base font-extrabold text-gray-900 mb-4 border-b-2 border-brand-sky pb-2 flex items-center gap-1">
                        <span>рџ“°</span> <span data-lang="new_issue">Gazetaning yangi soni</span>
                    </h3>
                    <div class="bg-sky-50 rounded-2xl p-4 border border-sky-100 text-center mb-4">
                        <span class="text-4xl block mb-2">рџ—ћпёЏ</span>
                        <h4 class="font-black text-sm text-gray-900">в„– 32 (10 450)</h4>
                        <p class="text-xs text-gray-500">8-Avgust, 2026 yil</p>
                    </div>
                    <a href="archive.html" class="block text-center bg-slate-900 hover:bg-brand-sky text-white font-bold text-xs py-3 rounded-xl transition">
                        <span>рџ“Ґ</span> <span data-lang="download_pdf">PDF Yuklab olish (Arxiv)</span>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
                    <h3 class="text-base font-extrabold text-gray-900 mb-3 border-b-2 border-brand-sky pb-2 flex items-center gap-1">
                        <span>вњ‰пёЏ</span> <span data-lang="editorial">Tahririyat</span>
                    </h3>
                    <p class="text-xs text-gray-600 mb-2"><strong data-lang="address_lbl">Manzil:</strong> Nukus sh., I.Karimov guzari, 111-uy.</p>
                    <p class="text-xs text-gray-600 mb-4"><strong>Tel:</strong> +998 (61) 222-81-18</p>
                    <a href="contact.html" data-lang="contact_btn" class="block text-center bg-brand-sky text-white font-bold text-xs py-2.5 rounded-xl hover:bg-sky-600 transition">
                        Bog'lanish sahifasi
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- РџРћР”Р’РђР› -->
    <footer class="bg-slate-900 text-gray-300 border-t-4 border-brand-sky mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white font-extrabold text-base mb-3">рџ“° В«Qoraqalpog'iston TongiВ»</h3>
                <p data-lang="footer_desc" class="text-xs leading-relaxed text-gray-400">
                    Qoraqalpog'iston Respublikasi ijtimoiy-siyosiy, iqtisodiy va madaniy hayotini yorituvchi rasmiy nashr.
                </p>
            </div>
            <div>
                <h4 data-lang="footer_sections" class="text-white font-bold text-xs mb-3 text-amber-400">Bo'limlar</h4>
                <ul class="space-y-1.5 text-xs text-gray-400">
                    <li><a href="index.php" data-lang="nav_home" class="hover:text-white transition">Bosh sahifa</a></li>
                    <li><a href="article.html" class="art-link hover:text-white transition" data-lang="nav_society">Jamiyat</a></li>
                    <li><a href="article.html" class="art-link hover:text-white transition" data-lang="nav_economy">Ekonomika</a></li>
                    <li><a href="archive.html" data-lang="nav_archive" class="hover:text-white transition">Gazeta Arxivi</a></li>
                </ul>
            </div>
            <div>
                <h4 data-lang="nav_contact" class="text-white font-bold text-xs mb-3 text-amber-400">Aloqa</h4>
                <p class="text-xs text-gray-400 mb-1">рџ“Ќ Nukus sh., I.Karimov guzari, 111-uy.</p>
                <p class="text-xs text-gray-400 mb-1">рџ“ћ +998 (61) 222-81-18</p>
                <p class="text-xs text-gray-400">вњ‰пёЏ qq-tongi59@mail.ru</p>
            </div>
            <div>
                <h4 data-lang="footer_social" class="text-white font-bold text-xs mb-3 text-amber-400">Ijtimoiy tarmoqlar</h4>
                <div class="flex gap-2">
                    <a href="https://t.me" target="_blank" class="bg-slate-800 hover:bg-sky-500 text-white text-xs px-3 py-2 rounded-xl border border-slate-700 transition">Telegram</a>
                    <a href="https://facebook.com" target="_blank" class="bg-slate-800 hover:bg-blue-600 text-white text-xs px-3 py-2 rounded-xl border border-slate-700 transition">Facebook</a>
                </div>
            </div>
        </div>
        <div class="bg-slate-950 py-4 text-center text-xs text-gray-500 border-t border-slate-800">
            В© 2026 В«Qoraqalpog'iston TongiВ». Barcha huquqlar himoyalangan.
        </div>
    </footer>

    <!-- JS РЎРљР РРџРў (Р•Р”РРќР«Р™ Р Р§РРЎРўР«Р™) -->
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        let currentLang = urlParams.get('lang') || localStorage.getItem('site_lang') || 'uz';

        const days = {
            uz: ['Yakshanba', 'Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba'],
            qr: ['Sheshembi', 'DГєyshembi', 'Sheshembi', 'SГЎrshembi', 'Piyshembi', 'Juma', 'Shenbi'],
            ru: ['Р’РѕСЃРєСЂРµСЃРµРЅСЊРµ', 'РџРѕРЅРµРґРµР»СЊРЅРёРє', 'Р’С‚РѕСЂРЅРёРє', 'РЎСЂРµРґР°', 'Р§РµС‚РІРµСЂРі', 'РџСЏС‚РЅРёС†Р°', 'РЎСѓР±Р±РѕС‚Р°']
        };
        const months = {
            uz: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avgust', 'Sentyabr', 'Oktabr', 'Noyabr', 'Dekabr'],
            qr: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avgust', 'Sentyabr', 'Oktabr', 'Noyabr', 'Dekabr'],
            ru: ['РЇРЅРІР°СЂСЏ', 'Р¤РµРІСЂР°Р»СЏ', 'РњР°СЂС‚Р°', 'РђРїСЂРµР»СЏ', 'РњР°СЏ', 'РСЋРЅСЏ', 'РСЋР»СЏ', 'РђРІРіСѓСЃС‚Р°', 'РЎРµРЅС‚СЏР±СЂСЏ', 'РћРєС‚СЏР±СЂСЏ', 'РќРѕСЏР±СЂСЏ', 'Р”РµРєР°Р±СЂСЏ']
        };

        const translations = {
            uz: {
                search_ph: 'Yangiliklarni qidirish...',
                archive_btn: 'Gazeta Arxivi',
                nav_home: 'Bosh sahifa',
                nav_about: 'Gazeta haqida',
                drop_history: 'Tahririyat tarixi',
                drop_team: 'Jamoa va Rekvizitlar',
                nav_society: 'Jamiyat',
                nav_economy: 'Ekonomika',
                nav_agrar: 'Agrar yo\'nalishlar',
                nav_regions: 'Hududlar',
                nav_gallery: 'Fotogalereya',
                nav_archive: 'Gazeta Arxivi',
                nav_contact: 'Aloqa',
                main_title: 'Oqchako\'l bo\'yida zamonaviy turistik zona barpo etildi',
                main_desc: 'Qoraqalpog\'iston Respublikasi Mo\'ynoq tumanida Oqchako me\'moriy va turizm loyihasi doirasida yangi dam olish maskani foydalanishga topshirildi...',
                read_more: 'Batafsil o\'qish в†’',
                read_more_short: 'O\'qish в†’',
                sub1_title: 'Qoraqalpog\'istonda agrar soha vakillari uchun yangi imkoniyatlar',
                sub1_desc: 'Qishloq xo\'jaligi va suv resurslaridan unumli foydalanish masalalari ko\'rib chiqildi.',
                sub2_title: 'Nukus shahrida obodonlashtirish ishlari jadallik bilan davom etmoqda',
                sub2_desc: 'Shahar infratuzilmasini yaxshilash va ko\'kalamzorlashtirish loyihalari boshlandi.',
                new_issue: 'Gazetaning yangi soni',
                download_pdf: 'PDF Yuklab olish (Arxiv)',
                editorial: 'Tahririyat',
                address_lbl: 'Manzil:',
                contact_btn: 'Bog\'lanish sahifasi',
                footer_desc: 'Qoraqalpog\'iston Respublikasi ijtimoiy-siyosiy, iqtisodiy va madaniy hayotini yorituvchi rasmiy nashr.',
                footer_sections: 'Bo\'limlar',
                footer_social: 'Ijtimoiy tarmoqlar',
                theme_day: 'Kunduzgi rejim',
                theme_night: 'Tungi rejim'
            },
            qr: {
                search_ph: 'XabarlardД± izlew...',
                archive_btn: 'Gazeta Arxivi',
                nav_home: 'Bas bet',
                nav_about: 'Gazeta haqqД±nda',
                drop_history: 'Redaksiya tariyxД±',
                drop_team: 'Jamoa hГЎm Revizitlar',
                nav_society: 'Chetel ham Jamiyet',
                nav_economy: 'Ekonomika',
                nav_agrar: 'Agressiv tarawlar',
                nav_regions: 'Aymaqlar',
                nav_gallery: 'Fotogalereya',
                nav_archive: 'Gazeta Arxivi',
                nav_contact: 'BaylanД±s',
                main_title: 'OqshakГіl boyД±nda zamonaviy turistlik zona paydalanД±wЗµa tapsД±rД±ldД±',
                main_desc: 'Qaraqalpaqstan RespublikasД± Moynaq rayonД±nda OqshakГіl turizm joybarД± sheЕ„berinde jaЕ„a dem alД±w ornД± ashД±ldД±...',
                read_more: 'TolД±qroq oqД±w в†’',
                read_more_short: 'OqД±w в†’',
                sub1_title: 'Qaraqalpaqstanda agrar tarawД± wkilleri ushД±n jaЕ„a imkaniyatlar',
                sub1_desc: 'AГЅyl xojalД±ЗµД± hГЎm suw resurslarД±n nГЎtiyjeli paydalanД±w mГЎseleleri kГіrip chiqД±ldД±.',
                sub2_title: 'Nukus qalasД±nda abadanlastД±rД±w jumД±slarД± dawam etpekte',
                sub2_desc: 'Qala infrastrukturasД±n jaqsД±law hГЎm kГіkalamzarlastД±rД±w loyihalarД± baslandД±.',
                new_issue: 'GazetanД±Е„ jaЕ„a sanД±',
                download_pdf: 'PDF JГєklep alД±w (Arxiv)',
                editorial: 'Redaksiya',
                address_lbl: 'MГЎnzil:',
                contact_btn: 'BaylanД±s beti',
                footer_desc: 'Qaraqalpaqstan RespublikasД± sociallД±q-politikalД±q, ekonomikalД±q hГЎm mГЎdeniy turmД±sД±n sГЎwlelendiriwshi rГЎsmiy baspa.',
                footer_sections: 'BГіlimler',
                footer_social: 'SociallД±q tarmaqlar',
                theme_day: "Ku'ndizgi rejim",
                theme_night: 'Tungi rejim'
            },
            ru: {
                search_ph: 'РџРѕРёСЃРє РЅРѕРІРѕСЃС‚РµР№...',
                archive_btn: 'РђСЂС…РёРІ РіР°Р·РµС‚С‹',
                nav_home: 'Р“Р»Р°РІРЅР°СЏ',
                nav_about: 'Рћ РіР°Р·РµС‚Рµ',
                drop_history: 'РСЃС‚РѕСЂРёСЏ СЂРµРґР°РєС†РёРё',
                drop_team: 'РљРѕРјР°РЅРґР° Рё СЂРµРєРІРёР·РёС‚С‹',
                nav_society: 'РћР±С‰РµСЃС‚РІРѕ',
                nav_economy: 'Р­РєРѕРЅРѕРјРёРєР°',
                nav_agrar: 'РђРіСЂР°СЂРЅС‹Р№ СЃРµРєС‚РѕСЂ',
                nav_regions: 'Р РµРіРёРѕРЅС‹',
                nav_gallery: 'Р¤РѕС‚РѕРіР°Р»РµСЂРµСЏ',
                nav_archive: 'РђСЂС…РёРІ РіР°Р·РµС‚С‹',
                nav_contact: 'РљРѕРЅС‚Р°РєС‚С‹',
                main_title: 'РќР° Р±РµСЂРµРіСѓ РѕР·РµСЂР° РђРєС‡Р°РєРѕР»СЊ СЃРѕР·РґР°РЅР° СЃРѕРІСЂРµРјРµРЅРЅР°СЏ С‚СѓСЂРёСЃС‚СЃРєР°СЏ Р·РѕРЅР°',
                main_desc: 'Р’ РњСѓР№РЅР°РєСЃРєРѕРј СЂР°Р№РѕРЅРµ Р РµСЃРїСѓР±Р»РёРєРё РљР°СЂР°РєР°Р»РїР°РєСЃС‚Р°РЅ РІ СЂР°РјРєР°С… Р°СЂС…РёС‚РµРєС‚СѓСЂРЅРѕ-С‚СѓСЂРёСЃС‚СЃРєРѕРіРѕ РїСЂРѕРµРєС‚Р° СЃРґР°РЅР° РІ СЌРєСЃРїР»СѓР°С‚Р°С†РёСЋ РЅРѕРІР°СЏ Р·РѕРЅР° РѕС‚РґС‹С…Р°...',
                read_more: 'Р§РёС‚Р°С‚СЊ РґР°Р»РµРµ в†’',
                read_more_short: 'Р§РёС‚Р°С‚СЊ в†’',
                sub1_title: 'РќРѕРІС‹Рµ РІРѕР·РјРѕР¶РЅРѕСЃС‚Рё РґР»СЏ РїСЂРµРґСЃС‚Р°РІРёС‚РµР»РµР№ Р°РіСЂР°СЂРЅРѕРіРѕ СЃРµРєС‚РѕСЂР° РљР°СЂР°РєР°Р»РїР°РєСЃС‚Р°РЅР°',
                sub1_desc: 'Р Р°СЃСЃРјРѕС‚СЂРµРЅС‹ РІРѕРїСЂРѕСЃС‹ СЌС„С„РµРєС‚РёРІРЅРѕРіРѕ РёСЃРїРѕР»СЊР·РѕРІР°РЅРёСЏ СЃРµР»СЊСЃРєРѕРіРѕ С…РѕР·СЏР№СЃС‚РІР° Рё РІРѕРґРЅС‹С… СЂРµСЃСѓСЂСЃРѕРІ.',
                sub2_title: 'Р’ РіРѕСЂРѕРґРµ РќСѓРєСѓСЃ Р°РєС‚РёРІРЅРѕ РїСЂРѕРґРѕР»Р¶Р°СЋС‚СЃСЏ СЂР°Р±РѕС‚С‹ РїРѕ Р±Р»Р°РіРѕСѓСЃС‚СЂРѕР№СЃС‚РІСѓ',
                sub2_desc: 'Р—Р°РїСѓС‰РµРЅС‹ РїСЂРѕРµРєС‚С‹ РїРѕ СѓР»СѓС‡С€РµРЅРёСЋ РіРѕСЂРѕРґСЃРєРѕР№ РёРЅС„СЂР°СЃС‚СЂСѓРєС‚СѓСЂС‹ Рё РѕР·РµР»РµРЅРµРЅРёСЋ.',
                new_issue: 'РќРѕРІС‹Р№ РІС‹РїСѓСЃРє РіР°Р·РµС‚С‹',
                download_pdf: 'РЎРєР°С‡Р°С‚СЊ PDF (РђСЂС…РёРІ)',
                editorial: 'Р РµРґР°РєС†РёСЏ',
                address_lbl: 'РђРґСЂРµСЃ:',
                contact_btn: 'РЎС‚СЂР°РЅРёС†Р° РєРѕРЅС‚Р°РєС‚РѕРІ',
                footer_desc: 'РћС„РёС†РёР°Р»СЊРЅРѕРµ РёР·РґР°РЅРёРµ, РѕСЃРІРµС‰Р°СЋС‰РµРµ РѕР±С‰РµСЃС‚РІРµРЅРЅРѕ-РїРѕР»РёС‚РёС‡РµСЃРєСѓСЋ, СЌРєРѕРЅРѕРјРёС‡РµСЃРєСѓСЋ Рё РєСѓР»СЊС‚СѓСЂРЅСѓСЋ Р¶РёР·РЅСЊ Р РµСЃРїСѓР±Р»РёРєРё РљР°СЂР°РєР°Р»РїР°РєСЃС‚Р°РЅ.',
                footer_sections: 'Р Р°Р·РґРµР»С‹',
                footer_social: 'РЎРѕС†РёР°Р»СЊРЅС‹Рµ СЃРµС‚Рё',
                theme_day: 'Р”РЅРµРІРЅРѕР№ СЂРµР¶РёРј',
                theme_night: 'РќРѕС‡РЅРѕР№ СЂРµР¶РёРј'
            }
        };

        function updateDateTime() {
            const now = new Date();
            const dayName = days[currentLang] ? days[currentLang][now.getDay()] : days['uz'][now.getDay()];
            const monthName = months[currentLang] ? months[currentLang][now.getMonth()] : months['uz'][now.getMonth()];
            document.getElementById('liveDate').textContent = `рџ“… ${dayName}, ${now.getDate()}-${monthName}, ${now.getFullYear()}`;
            
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('liveClock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateDateTime, 1000);

        function changeLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('site_lang', lang);

            // РљРЅРѕРїРєРё СЏР·С‹РєРѕРІ
            ['qr', 'uz', 'ru'].forEach(l => {
                const btn = document.getElementById(`lang-${l}`);
                if (btn) {
                    if (l === lang) {
                        btn.className = "lang-btn bg-white text-brand-sky px-3 py-1.5 rounded-lg shadow font-bold flex items-center gap-2";
                    } else {
                        btn.className = "lang-btn bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg transition flex items-center gap-2";
                    }
                }
            });

            const searchInput = document.getElementById('searchInput');
            if (searchInput && translations[lang]) {
                searchInput.placeholder = translations[lang].search_ph;
            }

            document.querySelectorAll('[data-lang]').forEach(el => {
                const key = el.getAttribute('data-lang');
                if (translations[lang] && translations[lang][key]) {
                    el.textContent = translations[lang][key];
                }
            });

            // РџСЂРѕРїРёСЃС‹РІР°РµРј ?lang= РІРѕ РІСЃРµ СЃСЃС‹Р»РєРё РЅР° СЃС‚Р°С‚СЊРё
            document.querySelectorAll('.art-link').forEach(a => {
                const baseUrl = a.getAttribute('href').split('?')[0];
                a.setAttribute('href', `${baseUrl}?lang=${lang}`);
            });

            const isDark = document.documentElement.classList.contains('dark');
            updateThemeUI(isDark);
            updateDateTime();
        }

        function updateThemeUI(isDark) {
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');

            if (isDark) {
                document.documentElement.classList.add('dark');
                if (themeIcon) themeIcon.textContent = 'рџЊ™';
                if (themeText) {
                    themeText.setAttribute('data-lang', 'theme_night');
                    themeText.textContent = translations[currentLang] ? translations[currentLang].theme_night : 'Tungi rejim';
                }
            } else {
                document.documentElement.classList.remove('dark');
                if (themeIcon) themeIcon.textContent = 'вЂпёЏ';
                if (themeText) {
                    themeText.setAttribute('data-lang', 'theme_day');
                    themeText.textContent = translations[currentLang] ? translations[currentLang].theme_day : 'Kunduzgi rejim';
                }
            }
        }

        function toggleDarkMode() {
            const isDark = !document.documentElement.classList.contains('dark');
            localStorage.setItem('site_theme', isDark ? 'dark' : 'light');
            updateThemeUI(isDark);
        }

        function toggleDropdown(id) {
            const el = document.getElementById(id);
            const isHidden = el.classList.contains('hidden');
            document.querySelectorAll('[id^="dropdown"]').forEach(d => d.classList.add('hidden'));
            if (isHidden) el.classList.remove('hidden');
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('li.relative')) {
                document.querySelectorAll('[id^="dropdown"]').forEach(d => d.classList.add('hidden'));
            }
        });

        async function fetchCurrency() {
            try {
                const res = await fetch('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');
                const data = await res.json();
                const usd = data.find(c => c.Ccy === 'USD')?.Rate || '--';
                const eur = data.find(c => c.Ccy === 'EUR')?.Rate || '--';
                const rub = data.find(c => c.Ccy === 'RUB')?.Rate || '--';
                document.getElementById('currencyInfo').textContent = `рџ’µ USD: ${usd} | EUR: ${eur} | RUB: ${rub}`;
            } catch (e) {
                document.getElementById('currencyInfo').textContent = 'рџ’µ USD: 12650 | EUR: 13800 | RUB: 140';
            }
        }

        // Р—Р°РїСѓСЃРє РїСЂРё Р·Р°РіСЂСѓР·РєРµ СЃС‚СЂР°РЅРёС†С‹
        document.addEventListener('DOMContentLoaded', () => {
            fetchCurrency();
            const savedTheme = localStorage.getItem('site_theme') || 'light';
            updateThemeUI(savedTheme === 'dark');
            
            changeLanguage(currentLang);
        });
    </script>
</body>
</html>