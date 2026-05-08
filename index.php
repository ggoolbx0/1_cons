<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أداة تحديد السيارة والبحث عن رقم القطعة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #ff8c00;
            --secondary-color: #1a1a1a;
            --tertiary-color: #2d2d2d;
            --text-light: #e0e0e0;
            --border-radius: 15px;
        }

        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }

        header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ff6b35 100%);
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .container-app {
            max-width: 600px;
            margin: 0 auto;
            padding: 15px;
            padding-bottom: 150px;
        }

        .card {
            background: var(--tertiary-color);
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            padding: 25px;
            border-top: 3px solid var(--primary-color);
        }

        .card-header {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-light);
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select,
        datalist {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--tertiary-color);
            background: #1a1a1a;
            color: var(--text-light);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus,
        datalist:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
        }

        .btn {
            padding: 14px 24px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ff6b35 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
            color: white;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #404040;
            color: var(--text-light);
        }

        .btn-secondary:hover {
            background: #505050;
            color: white;
        }

        .btn-group-search {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-search {
            background: var(--tertiary-color);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 12px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-search:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .vehicle-info {
            background: linear-gradient(135deg, #1a1a1a 0%, #252525 100%);
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-right: 4px solid var(--primary-color);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #404040;
            font-size: 15px;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            color: var(--primary-color);
            font-weight: 600;
            flex: 0 0 45%;
        }

        .info-value {
            color: var(--text-light);
            text-align: left;
            flex: 1;
            word-break: break-word;
        }

        .loader {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            border: 4px solid #404040;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .alert {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: none;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background: linear-gradient(135deg, #8b0000 0%, #5c0000 100%);
            color: #ff6b6b;
            border-right: 4px solid #ff6b6b;
        }

        .alert-warning {
            background: linear-gradient(135deg, #8b6914 0%, #5c4a0a 100%);
            color: #ffd93d;
            border-right: 4px solid #ffd93d;
        }

        .alert-success {
            background: linear-gradient(135deg, #006b21 0%, #004a15 100%);
            color: #4ade80;
            border-right: 4px solid #4ade80;
        }

        .hidden {
            display: none !important;
        }

        .btn-copy {
            background: var(--tertiary-color);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 12px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }

        .btn-copy:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .search-queries {
            background: linear-gradient(135deg, #1a1a1a 0%, #252525 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-right: 4px solid var(--primary-color);
            font-size: 14px;
            line-height: 1.6;
            word-break: break-word;
            max-height: 150px;
            overflow-y: auto;
        }

        .search-queries-label {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .search-query {
            color: var(--text-light);
            padding: 8px;
            background: #1a1a1a;
            border-radius: 5px;
            margin-bottom: 8px;
            font-family: monospace;
            border-left: 3px solid var(--primary-color);
            padding-left: 10px;
        }

        .search-buttons-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .btn-search-small {
            background: var(--tertiary-color);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 10px 12px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            text-align: center;
        }

        .btn-search-small:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--secondary-color);
            border-top: 2px solid var(--primary-color);
            padding: 12px;
            text-align: center;
            font-size: 12px;
            color: var(--text-light);
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 576px) {
            header h1 {
                font-size: 20px;
            }

            .card {
                padding: 18px;
                margin-bottom: 15px;
            }

            .btn {
                padding: 12px 20px;
                font-size: 15px;
            }

            .info-row {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .search-buttons-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>
            <i class="bi bi-car-front-fill"></i>
            أداة تحديد السيارة والبحث عن رقم القطعة
        </h1>
    </header>

    <div class="container-app">
        <!-- Alert Messages -->
        <div id="alertMessage" class="alert"></div>

        <!-- VIN Input Card -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-key-fill"></i>
                إدخال رقم VIN
            </div>
            <div class="form-group">
                <label for="vinInput">أدخل رقم VIN (17 خانة):</label>
                <input type="text" id="vinInput" placeholder="مثال: WBADT43452G073980" maxlength="17">
            </div>
            <button class="btn btn-primary" onclick="checkVehicle()">
                <i class="bi bi-search"></i>
                فحص السيارة
            </button>
            <div id="vinLoader" class="loader">
                <div class="spinner"></div>
                <p style="margin-top: 10px; color: var(--primary-color);">جاري فحص السيارة...</p>
            </div>
        </div>

        <!-- Vehicle Info Card -->
        <div id="vehicleCard" class="card hidden">
            <div class="card-header">
                <i class="bi bi-info-circle-fill"></i>
                بيانات السيارة
            </div>
            <div id="vehicleInfo"></div>
        </div>

        <!-- Part Search Card -->
        <div id="partSearchCard" class="card hidden">
            <div class="card-header">
                <i class="bi bi-tools"></i>
                البحث عن القطعة
            </div>
            <div class="form-group">
                <label for="partNameInput">أدخل اسم القطعة بالعربي:</label>
                <input 
                    type="text" 
                    id="partNameInput" 
                    placeholder="مثال: فحمات أمامية، رديتر، فلتر زيت..."
                    list="partsList"
                    autocomplete="off"
                >
                <datalist id="partsList"></datalist>
            </div>
            <button class="btn btn-primary" onclick="prepareSearch()">
                <i class="bi bi-gear-fill"></i>
                تجهيز البحث
            </button>
        </div>

        <!-- Search Results Card -->
        <div id="resultCard" class="card hidden">
            <div class="card-header">
                <i class="bi bi-search"></i>
                عبارات البحث المقترحة
            </div>
            
            <div id="translationAlert"></div>
            
            <div class="search-queries">
                <div class="search-queries-label">عبارات البحث:</div>
                <div id="searchQueriesContainer"></div>
            </div>

            <button class="btn-copy" onclick="copySearchQueries()">
                <i class="bi bi-clipboard"></i>
                نسخ عبارات البحث
            </button>

            <div class="btn-group-search">
                <div class="search-buttons-grid">
                    <button class="btn-search-small" onclick="openGoogleSearch(1)">
                        <i class="bi bi-google"></i>
                        بحث عام
                    </button>
                    <button class="btn-search-small" onclick="openGoogleSearch(2)">
                        <i class="bi bi-search"></i>
                        بحث VIN
                    </button>
                    <button class="btn-search-small" onclick="openGoogleSearch(3)">
                        <i class="bi bi-chat-dots"></i>
                        بحث عربي
                    </button>
                    <button class="btn-search-small" onclick="openGoogleSearch(4)">
                        <i class="bi bi-image"></i>
                        صور Google
                    </button>
                </div>

                <button class="btn-search" onclick="openGoogleSearch(5)" style="margin-top: 10px;">
                    <i class="bi bi-shopping-bag"></i>
                    بحث شراء أون لاين
                </button>

                <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #404040;">
                    <p style="font-size: 12px; color: var(--primary-color); margin-bottom: 10px; font-weight: 600;">
                        <i class="bi bi-star"></i> مواقع متخصصة في قطع الغيار:
                    </p>
                    <div class="search-buttons-grid">
                        <button class="btn-search-small" onclick="openGoogleSearch(6)">
                            <i class="bi bi-car-front"></i>
                            RockAuto
                        </button>
                        <button class="btn-search-small" onclick="openGoogleSearch(7)">
                            <i class="bi bi-gear"></i>
                            PartsGeek
                        </button>
                        <button class="btn-search-small" onclick="openGoogleSearch(8)">
                            <i class="bi bi-cart"></i>
                            eBay
                        </button>
                        <button class="btn-search-small" onclick="openGoogleSearch(9)">
                            <i class="bi bi-box"></i>
                            Amazon
                        </button>
                    </div>
                </div>

                <button class="btn-search" onclick="openGoogleSearch(10)" style="margin-top: 10px;">
                    <i class="bi bi-search"></i>
                    بحث VIN متقدم
                </button>
            </div>

            <button class="btn btn-secondary" onclick="resetApp()" style="margin-top: 15px;">
                <i class="bi bi-arrow-counterclockwise"></i>
                إعادة ضبط
            </button>
        </div>
    </div>

    <footer>
        <p><i class="bi bi-info-circle"></i> الأداة تساعدك على البحث ولا تضمن رقم القطعة إلا من مصدر رسمي.</p>
    </footer>

    <script>
        // HTML Escape Function
        function escapeHTML(value) {
            return String(value ?? '-').replace(/[&<>"']/g, function (char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[char];
            });
        }

        // Clean Value Function
        function cleanValue(value) {
            const v = String(value ?? '').trim();
            return v === '' ? '-' : v;
        }

        // Valid Term Function
        function validTerm(value) {
            return value && value !== '-' && String(value).trim().length > 0;
        }

        // Parts Dictionary with Arabic synonyms
        const PARTS_MAP = [
            { ar:["فحمات اماميه","فحمات أمامية","اقمشة امامية","اقمشة أمامية","قماشات اماميه","قماشات أمامية"], en:"front brake pads" },
            { ar:["فحمات خلفيه","فحمات خلفية","اقمشة خلفية","اقمشة خلفيه","قماشات خلفيه","قماشات خلفية"], en:"rear brake pads" },
            { ar:["هوبات اماميه","هوبات أمامية","دسكات امامية","دسكات أمامية","دسكات فرامل امامية"], en:"front brake rotors" },
            { ar:["هوبات خلفيه","هوبات خلفية","دسكات خلفية","دسكات فرامل خلفية"], en:"rear brake rotors" },
            { ar:["كلبر امامي","كليبر امامي","ماسك فرامل امامي"], en:"front brake caliper" },
            { ar:["كلبر خلفي","كليبر خلفي","ماسك فرامل خلفي"], en:"rear brake caliper" },
            { ar:["ماستر فرامل","علبة فرامل","ماستر بريك"], en:"brake master cylinder" },
            { ar:["باكم فرامل","سيرفو فرامل"], en:"brake booster" },
            { ar:["علبة زيت فرامل","خزان زيت فرامل"], en:"brake fluid reservoir" },
            { ar:["حساس ABS","حساس اي بي اس","حساس فرامل ABS"], en:"ABS wheel speed sensor" },
            { ar:["ليات فرامل","لي فرامل"], en:"brake hose" },
            { ar:["فلتر زيت","سيفون زيت","فلتر الزيت"], en:"oil filter" },
            { ar:["فلتر هواء","فلتر المكينة","فلتر هواء مكينة"], en:"engine air filter" },
            { ar:["فلتر مكيف","فلتر كبينة","فلتر هواء داخلي"], en:"cabin air filter" },
            { ar:["فلتر بنزين","فلتر وقود"], en:"fuel filter" },
            { ar:["طرمبة بنزين","مضخة بنزين","طرمبه وقود","مضخة وقود"], en:"fuel pump" },
            { ar:["بخاخ","بخاخات","بخاخ بنزين","رشاش"], en:"fuel injector" },
            { ar:["صفاية بنزين","صفاية وقود"], en:"fuel strainer" },
            { ar:["غطاء بنزين","غطا بنزين"], en:"fuel cap" },
            { ar:["بواجي","شمعة احتراق","شمعات احتراق","شمعة مكينة"], en:"spark plugs" },
            { ar:["كويل","كويلات","بوبينة","بوبينات"], en:"ignition coil" },
            { ar:["اسلاك بواجي","سلك بواجي"], en:"spark plug wires" },
            { ar:["ثروتل","بوابة هواء","بوابة دعسة"], en:"throttle body" },
            { ar:["حساس دعسة","حساس بوابة","حساس TPS"], en:"throttle position sensor" },
            { ar:["حساس هواء","حساس MAF","ماف"], en:"mass air flow sensor" },
            { ar:["حساس MAP","ماب"], en:"manifold absolute pressure sensor" },
            { ar:["حساس اكسجين","حساس شكمان","حساس O2"], en:"oxygen sensor" },
            { ar:["حساس كرنك","حساس عمود كرنك"], en:"crankshaft position sensor" },
            { ar:["حساس كام","حساس عمود كامات"], en:"camshaft position sensor" },
            { ar:["حساس حرارة","حساس حرارة ماء"], en:"engine coolant temperature sensor" },
            { ar:["حساس ضغط زيت"], en:"oil pressure sensor" },
            { ar:["حساس طرق","حساس طقطقة"], en:"knock sensor" },
            { ar:["حساس دبة تلوث"], en:"catalytic converter sensor" },
            { ar:["رديتر","راديتر","مبرد ماء"], en:"radiator" },
            { ar:["غطاء رديتر","غطا رديتر"], en:"radiator cap" },
            { ar:["مروحة رديتر","مروحة تبريد"], en:"radiator cooling fan" },
            { ar:["كلتش مروحة","كلتش المروحة"], en:"fan clutch" },
            { ar:["ثرموستات","بلف حرارة"], en:"thermostat" },
            { ar:["طرمبة ماء","مضخة ماء"], en:"water pump" },
            { ar:["قربة ماء","علبة ماء","خزان ماء رديتر"], en:"coolant reservoir" },
            { ar:["لي ماء علوي","هوز ماء علوي"], en:"upper radiator hose" },
            { ar:["لي ماء سفلي","هوز ماء سفلي"], en:"lower radiator hose" },
            { ar:["مبرد زيت","رديتر زيت"], en:"engine oil cooler" },
            { ar:["دينمو","مولد كهرباء"], en:"alternator" },
            { ar:["سلف","مارش","بادئ الحركة"], en:"starter motor" },
            { ar:["بطارية","بطاريه"], en:"car battery" },
            { ar:["اصبع بطارية","قطب بطارية"], en:"battery terminal" },
            { ar:["علبة فيوزات","صندوق فيوزات"], en:"fuse box" },
            { ar:["فيوز","فيوزات"], en:"fuse" },
            { ar:["كتاوت","ريليه"], en:"relay" },
            { ar:["ظفيرة","ضفيرة","اسلاك مكينة","ظفيرة مكينة"], en:"engine wiring harness" },
            { ar:["كمبروسر مكيف","ضاغط مكيف"], en:"AC compressor" },
            { ar:["ثلاجة مكيف","مبخر مكيف"], en:"AC evaporator" },
            { ar:["رديتر مكيف","مكثف مكيف"], en:"AC condenser" },
            { ar:["مروحة مكيف"], en:"AC condenser fan" },
            { ar:["بلف مكيف","صمام تمدد"], en:"AC expansion valve" },
            { ar:["فلتر فريون","دراير مكيف"], en:"AC receiver drier" },
            { ar:["لي مكيف","هوز مكيف"], en:"AC hose" },
            { ar:["حساس ضغط مكيف"], en:"AC pressure sensor" },
            { ar:["كلتش كمبروسر"], en:"AC compressor clutch" },
            { ar:["دودة دركسون","علبة دركسون","علبة دريكسون"], en:"steering rack" },
            { ar:["طرمبة دركسون","مضخة دركسون"], en:"power steering pump" },
            { ar:["زيت دركسون"], en:"power steering fluid" },
            { ar:["لي دركسون","هوز دركسون"], en:"power steering hose" },
            { ar:["عمود دركسون"], en:"steering column" },
            { ar:["جلدة دركسون"], en:"steering rack boot" },
            { ar:["رمان دركسون"], en:"steering bearing" },
            { ar:["مساعد امامي","مساعد أمامي","مساعد قدام"], en:"front shock absorber" },
            { ar:["مساعد خلفي","مساعد ورا"], en:"rear shock absorber" },
            { ar:["ياي امامي","سستة امامية","سسته اماميه"], en:"front coil spring" },
            { ar:["ياي خلفي","سستة خلفية","سسته خلفيه"], en:"rear coil spring" },
            { ar:["مقص امامي","مقص أمامي","ذراع امامي"], en:"front control arm" },
            { ar:["مقص خلفي","ذراع خلفي"], en:"rear control arm" },
            { ar:["جلدة مقص","جلد مقص"], en:"control arm bushing" },
            { ar:["مسمار توازن","عمود توازن"], en:"sway bar link" },
            { ar:["جلدة توازن"], en:"sway bar bushing" },
            { ar:["مقص علوي"], en:"upper control arm" },
            { ar:["مقص سفلي"], en:"lower control arm" },
            { ar:["ركبة","صرة","هوب صرة"], en:"steering knuckle" },
            { ar:["رمان عجل","رمان كفر","رمان بلي"], en:"wheel bearing" },
            { ar:["صرة كفر","هوب عجل"], en:"wheel hub assembly" },
            { ar:["عكس امامي","عكس","اكسل امامي"], en:"front CV axle shaft" },
            { ar:["جلدة عكس"], en:"CV axle boot" },
            { ar:["قير","جير","ناقل حركة"], en:"transmission" },
            { ar:["مخ قير","مخ الجير","بلوف قير"], en:"transmission valve body" },
            { ar:["زيت قير"], en:"transmission fluid" },
            { ar:["فلتر قير"], en:"transmission filter" },
            { ar:["مبرد قير"], en:"transmission cooler" },
            { ar:["حساس قير"], en:"transmission speed sensor" },
            { ar:["كلتش","دسك كلتش"], en:"clutch disc" },
            { ar:["صحن كلتش"], en:"pressure plate" },
            { ar:["فحمة كلتش"], en:"clutch release bearing" },
            { ar:["كرونة","دفرنس"], en:"differential" },
            { ar:["عمود كردان","عامود كردان"], en:"drive shaft" },
            { ar:["صدام امامي","صدام أمامي"], en:"front bumper" },
            { ar:["صدام خلفي"], en:"rear bumper" },
            { ar:["شبك امامي","شبك أمامي","شبك"], en:"front grille" },
            { ar:["كبوت","غطاء مكينة"], en:"hood" },
            { ar:["رفرف امامي يمين"], en:"front right fender" },
            { ar:["رفرف امامي يسار"], en:"front left fender" },
            { ar:["رفرف خلفي يمين"], en:"rear right quarter panel" },
            { ar:["رفرف خلفي يسار"], en:"rear left quarter panel" },
            { ar:["باب امامي يمين"], en:"front right door" },
            { ar:["باب امامي يسار"], en:"front left door" },
            { ar:["باب خلفي يمين"], en:"rear right door" },
            { ar:["باب خلفي يسار"], en:"rear left door" },
            { ar:["شنطة","باب شنطة"], en:"trunk lid" },
            { ar:["باب خلفي","باب صندوق"], en:"tailgate" },
            { ar:["غطاء تانكي","غطاء بنزين"], en:"fuel door" },
            { ar:["رفرف داخلي","بطانة رفرف"], en:"fender liner" },
            { ar:["حامل صدام","دعامة صدام"], en:"bumper reinforcement" },
            { ar:["شمعة ��مامية يمين","شمعه اماميه يمين","نور امامي يمين"], en:"right headlight" },
            { ar:["شمعة امامية يسار","شمعه اماميه يسار","نور امامي يسار"], en:"left headlight" },
            { ar:["اسطب خلفي يمين","اصطب خلفي يمين"], en:"right tail light" },
            { ar:["اسطب خلفي يسار","اصطب خلفي يسار"], en:"left tail light" },
            { ar:["كشاف ضباب يمين"], en:"right fog light" },
            { ar:["كشاف ضباب يسار"], en:"left fog light" },
            { ar:["لمبة زينون","زينون"], en:"xenon bulb" },
            { ar:["لمبة LED","ليد"], en:"LED bulb" },
            { ar:["حساس نور"], en:"headlight sensor" },
            { ar:["مراية يمين","مرآة يمين"], en:"right side mirror" },
            { ar:["مراية يسار","مرآة يسار"], en:"left side mirror" },
            { ar:["قزاز امامي","زجاج امامي","قزازة امامية"], en:"windshield" },
            { ar:["قزاز خلفي","زجاج خلفي"], en:"rear windshield" },
            { ar:["قزاز باب امامي يمين"], en:"front right door glass" },
            { ar:["قزاز باب امامي يسار"], en:"front left door glass" },
            { ar:["ماكينة قزاز","مكينة قزاز"], en:"window regulator" },
            { ar:["مساحة امامية","مساحات امامية"], en:"front windshield wiper blades" },
            { ar:["دينمو مساحة","موتور مساحة"], en:"wiper motor" },
            { ar:["طرمبة مساحات"], en:"windshield washer pump" },
            { ar:["علبة مساحات"], en:"washer reservoir" },
            { ar:["حساس صدام","حساس موقف","حساس باركنج"], en:"parking sensor" },
            { ar:["كاميرا خلفية","كاميرا رجوع"], en:"rear view camera" },
            { ar:["رادار امامي","رادار أمامي"], en:"front radar sensor" },
            { ar:["حساس زاوية"], en:"steering angle sensor" },
            { ar:["حساس كفر","حساس ضغط كفر","TPMS"], en:"tire pressure sensor" },
            { ar:["كمبيوتر مكينة","كمبيوتر السيارة","ECU"], en:"engine control module ECU" },
            { ar:["كمبيوتر قير","TCM"], en:"transmission control module TCM" },
            { ar:["كمبيوتر ABS"], en:"ABS control module" },
            { ar:["كمبيوتر ايرباق","كمبيوتر ارباق"], en:"airbag control module" },
            { ar:["طبلون","تابلوه"], en:"dashboard" },
            { ar:["عداد","عداد طبلون"], en:"instrument cluster" },
            { ar:["دركسون","طارة"], en:"steering wheel" },
            { ar:["ايرباق دركسون","ارباق دركسون"], en:"steering wheel airbag" },
            { ar:["ايرباق راكب","ارباق راكب"], en:"passenger airbag" },
            { ar:["حزام امان","حزام"], en:"seat belt" },
            { ar:["كرسي امامي","مقعد امامي"], en:"front seat" },
            { ar:["مسجل","شاشة","شاشه"], en:"infotainment screen" },
            { ar:["ازرار مكيف","لوحة مكيف"], en:"AC control panel" },
            { ar:["عصا قير","يد قير"], en:"gear shifter" },
            { ar:["كاتم","دبة تلوث","دبة بيئة"], en:"catalytic converter" },
            { ar:["شكمان","اكزوز"], en:"exhaust pipe" },
            { ar:["دبة شكمان","دبه شكمان"], en:"muffler" },
            { ar:["ثلاجة مكينة","منفولد سحب"], en:"intake manifold" },
            { ar:["منفولد شكمان","هدرز"], en:"exhaust manifold" },
            { ar:["وجه راس","جلدة راس"], en:"cylinder head gasket" },
            { ar:["وجه غطاء بلوف"], en:"valve cover gasket" },
            { ar:["غطاء بلوف"], en:"valve cover" },
            { ar:["كرتير زيت","حوض زيت"], en:"engine oil pan" },
            { ar:["وجه كرتير"], en:"oil pan gasket" },
            { ar:["سير مكينة","سير خارجي"], en:"serpentine belt" },
            { ar:["شداد سير","بكرة شداد"], en:"belt tensioner" },
            { ar:["بكرة سير"], en:"idler pulley" },
            { ar:["جنزير مكينة","سلسلة توقيت"], en:"timing chain" },
            { ar:["سير تايمن","سير توقيت"], en:"timing belt" },
            { ar:["شداد تايمن"], en:"timing belt tensioner" },
            { ar:["قاعدة مكينة","كرسي مكينة"], en:"engine mount" },
            { ar:["قاعدة قير","كرسي قير"], en:"transmission mount" }
        ];

        // Global variables
        let vehicleData = null;
        let partEnglish = null;
        let partArabic = null;

        // Normalize Arabic text
        function normalizeArabic(text) {
            if (!text) return '';
            text = text.replace(/[\u064E\u064F\u0650\u0651\u0652\u0653\u0654\u0655\u0656\u0657\u0658]/g, '');
            text = text.replace(/[أإآا]/g, 'ا');
            text = text.replace(/ة/g, 'ه');
            text = text.replace(/ى/g, 'ي');
            text = text.replace(/\s+/g, ' ').trim().toLowerCase();
            return text;
        }

        // Initialize parts datalist
        function initPartsList() {
            const datalist = document.getElementById('partsList');
            const uniqueParts = new Set();
            
            PARTS_MAP.forEach(part => {
                part.ar.forEach(name => {
                    uniqueParts.add(name);
                });
            });
            
            datalist.innerHTML = Array.from(uniqueParts)
                .sort()
                .map(part => `<option value="${part}">`)
                .join('');
        }

        // Show alert message
        function showAlert(message, type) {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.textContent = message;
            alertDiv.className = `alert alert-${type}`;
            alertDiv.style.display = 'block';
            
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 5000);
        }

        // Clean VIN input
        function cleanVIN(vin) {
            return vin.replace(/\s/g, '').toUpperCase();
        }

        // Validate VIN
        function validateVIN(vin) {
            if (!vin || vin.trim() === '') {
                showAlert('⚠️ الرجاء إدخال رقم VIN', 'error');
                return false;
            }
            
            const cleanedVIN = cleanVIN(vin);
            const vinPattern = /^[A-HJ-NPR-Z0-9]{17}$/;
            
            if (!vinPattern.test(cleanedVIN)) {
                showAlert('⚠️ رقم VIN يجب أن يكون 17 خانة بدون I، O، Q', 'error');
                return false;
            }
            
            return true;
        }

        // Check vehicle via API
        async function checkVehicle() {
            const vinInput = document.getElementById('vinInput').value;
            
            if (!validateVIN(vinInput)) return;
            
            const cleanedVIN = cleanVIN(vinInput);
            document.getElementById('vinInput').value = cleanedVIN;
            
            const loader = document.getElementById('vinLoader');
            loader.style.display = 'block';
            
            try {
                const response = await fetch(`https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValues/${encodeURIComponent(cleanedVIN)}?format=json`);
                const data = await response.json();
                
                if (!data.Results || data.Results.length === 0) {
                    showAlert('❌ لم يتم العثور على بيانات السيارة', 'error');
                    loader.style.display = 'none';
                    return;
                }
                
                const result = data.Results[0];
                
                if (!result.Make || !result.Model) {
                    showAlert('⚠️ البيانات ناقصة أو رقم VIN غير مدعوم', 'warning');
                    loader.style.display = 'none';
                    return;
                }
                
                vehicleData = {
                    make: cleanValue(result.Make),
                    model: cleanValue(result.Model),
                    year: cleanValue(result.ModelYear),
                    bodyClass: cleanValue(result.BodyClass),
                    engine: cleanValue(result.EngineModel),
                    displacement: cleanValue(result.DisplacementL),
                    country: cleanValue(result.PlantCountry),
                    vin: cleanedVIN
                };
                
                displayVehicleInfo();
                loader.style.display = 'none';
                
                document.getElementById('vehicleCard').classList.remove('hidden');
                document.getElementById('partSearchCard').classList.remove('hidden');
                document.getElementById('resultCard').classList.add('hidden');
                
                showAlert('✅ تم فحص السيارة بنجاح', 'success');
                
            } catch (error) {
                console.error('Error:', error);
                showAlert('❌ خطأ في الاتصال بالخادم. تحقق من الإنترنت', 'error');
                loader.style.display = 'none';
            }
        }

        // Display vehicle information
        function displayVehicleInfo() {
            const vehicleInfo = document.getElementById('vehicleInfo');
            vehicleInfo.innerHTML = `
                <div class="vehicle-info">
                    <div class="info-row">
                        <span class="info-label">الشركة (Make):</span>
                        <span class="info-value">${escapeHTML(vehicleData.make)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الموديل (Model):</span>
                        <span class="info-value">${escapeHTML(vehicleData.model)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">السنة (Year):</span>
                        <span class="info-value">${escapeHTML(vehicleData.year)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">نوع الجسم:</span>
                        <span class="info-value">${escapeHTML(vehicleData.bodyClass)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">المحرك:</span>
                        <span class="info-value">${escapeHTML(vehicleData.engine)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">السعة (L):</span>
                        <span class="info-value">${escapeHTML(vehicleData.displacement)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">بلد التصنيع:</span>
                        <span class="info-value">${escapeHTML(vehicleData.country)}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">VIN:</span>
                        <span class="info-value">${escapeHTML(vehicleData.vin)}</span>
                    </div>
                </div>
            `;
        }

        // Search for part in dictionary
        function searchPart(arabicName) {
            const normalized = normalizeArabic(arabicName);
            
            for (let part of PARTS_MAP) {
                for (let arName of part.ar) {
                    if (normalizeArabic(arName) === normalized) {
                        return part.en;
                    }
                }
            }
            
            return null;
        }

        // Prepare search queries
        function prepareSearch() {
            const partInput = document.getElementById('partNameInput').value;
            
            if (!partInput || partInput.trim() === '') {
                showAlert('⚠️ الرجاء إدخال اسم القطعة', 'error');
                return;
            }
            
            partArabic = partInput;
            partEnglish = searchPart(partInput);
            
            let translationAlert = document.getElementById('translationAlert');
            if (!partEnglish) {
                partEnglish = partArabic;
                translationAlert.innerHTML = `<div class="alert alert-warning" style="display:block;">ℹ️ لم يتم العثور على ترجمة دقيقة، سيتم البحث بالنص المدخل كما هو.</div>`;
            } else {
                translationAlert.innerHTML = `<div class="alert alert-success" style="display:block;">✅ تم العثور على المصطلح الإنجليزي: <strong>${escapeHTML(partEnglish)}</strong></div>`;
            }
            
            generateSearchQueries();
            document.getElementById('resultCard').classList.remove('hidden');
        }

        // Generate search queries
        function generateSearchQueries() {
            const year = vehicleData.year;
            const make = vehicleData.make;
            const model = vehicleData.model;
            const engine = vehicleData.engine;
            const vin = vehicleData.vin;
            const partEn = partEnglish;
            const partAr = partArabic;

            // Build clean vehicle base
            const vehicleBase = [year, make, model].filter(validTerm).join(' ');
            const engineTerm = validTerm(engine) ? engine : '';
            
            const queries = {
                query1: engineTerm ? `${vehicleBase} ${engineTerm} ${partEn} OEM part number` : `${vehicleBase} ${partEn} OEM part number`,
                query2: `${vin} ${partEn} part number`,
                query3: `${make} ${model} ${year} ${partAr} رقم القطعة`,
                query4: `${vehicleBase} ${partEn} part number`,
                query5: `${vehicleBase} ${partEn} buy online`,
                query6: `${vehicleBase} ${partEn} site:rockauto.com`,
                query7: `${vehicleBase} ${partEn} site:partsgeek.com`,
                query8: `${vehicleBase} ${partEn} OEM part number site:ebay.com`,
                query9: `${vehicleBase} ${partEn} part number site:amazon.com`,
                query10: `${vin} ${partEn} OEM`
            };
            
            displaySearchQueries(queries);
            window.currentQueries = queries;
        }

        // Display search queries
        function displaySearchQueries(queries) {
            const container = document.getElementById('searchQueriesContainer');
            container.innerHTML = `
                <div class="search-query"><strong>1.</strong> ${escapeHTML(queries.query1)}</div>
                <div class="search-query"><strong>2.</strong> ${escapeHTML(queries.query2)}</div>
                <div class="search-query"><strong>3.</strong> ${escapeHTML(queries.query3)}</div>
                <div class="search-query"><strong>4.</strong> ${escapeHTML(queries.query4)}</div>
                <div class="search-query"><strong>5.</strong> ${escapeHTML(queries.query5)}</div>
                <div class="search-query"><strong>6.</strong> ${escapeHTML(queries.query6)}</div>
                <div class="search-query"><strong>7.</strong> ${escapeHTML(queries.query7)}</div>
                <div class="search-query"><strong>8.</strong> ${escapeHTML(queries.query8)}</div>
                <div class="search-query"><strong>9.</strong> ${escapeHTML(queries.query9)}</div>
                <div class="search-query"><strong>10.</strong> ${escapeHTML(queries.query10)}</div>
            `;
        }

        // Open Google search
        function openGoogleSearch(queryType) {
            if (!window.currentQueries) {
                showAlert('⚠️ جهّز البحث أولاً', 'warning');
                return;
            }

            const queries = window.currentQueries;
            let query = '';
            
            if (queryType === 1) query = queries.query1;
            else if (queryType === 2) query = queries.query2;
            else if (queryType === 3) query = queries.query3;
            else if (queryType === 4) query = queries.query4;
            else if (queryType === 5) query = queries.query5;
            else if (queryType === 6) query = queries.query6;
            else if (queryType === 7) query = queries.query7;
            else if (queryType === 8) query = queries.query8;
            else if (queryType === 9) query = queries.query9;
            else if (queryType === 10) query = queries.query10;
            
            let url = '';
            if (queryType === 4) {
                url = `https://www.google.com/search?tbm=isch&q=${encodeURIComponent(query)}`;
            } else {
                url = `https://www.google.com/search?q=${encodeURIComponent(query)}`;
            }
            
            window.open(url, '_blank');
        }

        // Copy search queries
        function copySearchQueries() {
            if (!window.currentQueries) {
                showAlert('⚠️ لا توجد عبارات للنسخ', 'warning');
                return;
            }

            const queries = window.currentQueries;
            const text = `عبارات البحث المقترحة:\n\n1. ${queries.query1}\n2. ${queries.query2}\n3. ${queries.query3}\n4. ${queries.query4}\n5. ${queries.query5}\n6. ${queries.query6}\n7. ${queries.query7}\n8. ${queries.query8}\n9. ${queries.query9}\n10. ${queries.query10}`;
            
            navigator.clipboard.writeText(text).then(() => {
                showAlert('✅ تم نسخ عبارات البحث', 'success');
            }).catch(() => {
                showAlert('❌ فشل النسخ', 'error');
            });
        }

        // Reset app
        function resetApp() {
            document.getElementById('vinInput').value = '';
            document.getElementById('partNameInput').value = '';
            document.getElementById('vehicleCard').classList.add('hidden');
            document.getElementById('partSearchCard').classList.add('hidden');
            document.getElementById('resultCard').classList.add('hidden');
            document.getElementById('alertMessage').style.display = 'none';
            vehicleData = null;
            partEnglish = null;
            partArabic = null;
            window.currentQueries = null;
            window.scrollTo(0, 0);
        }

        // Initialize on page load
        window.addEventListener('load', () => {
            initPartsList();
            document.getElementById('vinInput').focus();
        });
    </script>
</body>
</html>