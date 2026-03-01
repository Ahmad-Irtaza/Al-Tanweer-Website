<?php
require_once 'config/database.php';
$db = getDatabase();

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order LIMIT 5");
$categories = $categoriesStmt->fetchAll();
    'YELLOW & BEIGE' => [
        'RAL 1000' => ['Green beige', '#BEBD7F'],
        'RAL 1001' => ['Beige', '#C2B078'],
        'RAL 1002' => ['Sand yellow', '#C6A664'],
        'RAL 1003' => ['Signal yellow', '#E5BE01'],
        'RAL 1004' => ['Golden yellow', '#CDA434'],
        'RAL 1005' => ['Honey yellow', '#8b6e0cff'],
        'RAL 1006' => ['Maize yellow', '#E4A010'],
        'RAL 1007' => ['Daffodil yellow', '#DC9D00'],
        'RAL 1011' => ['Brown beige', '#8A6642'],
        'RAL 1012' => ['Lemon yellow', '#C7B446'],
        'RAL 1013' => ['Oyster white', '#EAE6CA'],
        'RAL 1014' => ['Ivory', '#E1CC4F'],
        'RAL 1015' => ['Light ivory', '#E6D690'],
        'RAL 1016' => ['Sulfur yellow', '#EDFF21'],
        'RAL 1017' => ['Saffron yellow', '#F5D033'],
        'RAL 1018' => ['Zinc yellow', '#F8F32B'],
        'RAL 1019' => ['Grey beige', '#9E9764'],
        'RAL 1020' => ['Olive yellow', '#999950'],
        'RAL 1021' => ['Rape yellow', '#F3DA0B'],
        'RAL 1023' => ['Traffic yellow', '#FAD201'],
        'RAL 1024' => ['Ochre yellow', '#AEA04B'],
        'RAL 1026' => ['Luminous yellow', '#FFFF00'],
        'RAL 1027' => ['Curry', '#9D9101'],
        'RAL 1028' => ['Melon yellow', '#F4A900'],
        'RAL 1032' => ['Broom yellow', '#D6AE01'],
        'RAL 1033' => ['Dahlia yellow', '#F3A505'],
        'RAL 1034' => ['Pastel yellow', '#EFA94A'],
        'RAL 1037' => ['Sun yellow', '#F39F18'],
    ],
    'ORANGE' => [
        'RAL 2000' => ['Yellow orange', '#ED760E'],
        'RAL 2001' => ['Red orange', '#C93C20'],
        'RAL 2002' => ['Vermilion', '#CB2821'],
        'RAL 2003' => ['Pastel orange', '#F39230'],
        'RAL 2004' => ['Pure orange', '#ED5B21'],
        'RAL 2005' => ['Luminous orange', '#FF4F00'],
        'RAL 2007' => ['Luminous bright orange', '#FFA421'],
        'RAL 2008' => ['Bright red orange', '#F75B26'],
        'RAL 2009' => ['Traffic orange', '#DA4F17'],
        'RAL 2010' => ['Signal orange', '#D84F17'],
        'RAL 2011' => ['Deep orange', '#EB6602'],
        'RAL 2012' => ['Salmon orange', '#ED7D42'],
        'RAL 2013' => ['Pearl orange', '#964A2F'],
    ],
    'RED' => [
        'RAL 3000' => ['Flame red', '#AF2B1E'],
        'RAL 3001' => ['Signal red', '#A32C28'],
        'RAL 3002' => ['Carmine red', '#A52B2A'],
        'RAL 3003' => ['Ruby red', '#8E2F2D'],
        'RAL 3004' => ['Purple red', '#7F282B'],
        'RAL 3005' => ['Wine red', '#6B292D'],
        'RAL 3007' => ['Black red', '#472F2D'],
        'RAL 3009' => ['Oxide red', '#6C332D'],
        'RAL 3011' => ['Brown red', '#7A2D2B'],
        'RAL 3012' => ['Beige red', '#B06D5F'],
        'RAL 3013' => ['Tomato red', '#9E2F2D'],
        'RAL 3014' => ['Antique pink', '#D47970'],
        'RAL 3015' => ['Light pink', '#D79590'],
        'RAL 3016' => ['Coral red', '#A3332D'],
        'RAL 3017' => ['Rose', '#CD5857'],
        'RAL 3018' => ['Strawberry red', '#CD4A51'],
        'RAL 3020' => ['Traffic red', '#C11B17'],
        'RAL 3022' => ['Salmon red', '#EB796C'],
        'RAL 3024' => ['Luminous red', '#FF0000'],
        'RAL 3026' => ['Luminous bright red', '#FF0000'],
        'RAL 3027' => ['Raspberry red', '#C73347'],
        'RAL 3028' => ['Pure red', '#C40233'],
        'RAL 3031' => ['Oriental red', '#A52B2A'],
        'RAL 3032' => ['Pearl ruby red', '#7A2D2B'],
        'RAL 3033' => ['Pearl pink', '#C75757'],
    ],
    'VIOLET' => [
        'RAL 4001' => ['Red lilac', '#8F669B'],
        'RAL 4002' => ['Red violet', '#86365C'],
        'RAL 4003' => ['Heather violet', '#C079A3'],
        'RAL 4004' => ['Claret violet', '#6F2F4F'],
        'RAL 4005' => ['Blue lilac', '#8E7BA6'],
        'RAL 4006' => ['Traffic purple', '#A33671'],
        'RAL 4007' => ['Purple violet', '#562D4A'],
        'RAL 4008' => ['Signal violet', '#9B5685'],
        'RAL 4009' => ['Pastel violet', '#AD91A5'],
        'RAL 4010' => ['Telemagenta', '#CF4B7B'],
        'RAL 4011' => ['Pearl violet', '#4C4656'],
        'RAL 4012' => ['Pearl blackcurrant', '#4A444C'],
    ],
    'BLUE' => [
        'RAL 5000' => ['Violet blue', '#334B5C'],
        'RAL 5001' => ['Green blue', '#2A495C'],
        'RAL 5002' => ['Ultramarine blue', '#2A365C'],
        'RAL 5003' => ['Sapphire blue', '#2F3947'],
        'RAL 5004' => ['Black blue', '#2A3642'],
        'RAL 5005' => ['Signal blue', '#1E336C'],
        'RAL 5007' => ['Brillant blue', '#4A6E8A'],
        'RAL 5008' => ['Grey blue', '#33475C'],
        'RAL 5009' => ['Azure blue', '#2D5670'],
        'RAL 5010' => ['Gentian blue', '#00366D'],
        'RAL 5011' => ['Steel blue', '#2A364F'],
        'RAL 5012' => ['Light blue', '#2A79A5'],
        'RAL 5013' => ['Cobalt blue', '#2F3C5C'],
        'RAL 5014' => ['Pigeon blue', '#667B9E'],
        'RAL 5015' => ['Sky blue', '#2E6B8D'],
        'RAL 5017' => ['Traffic blue', '#004A79'],
        'RAL 5018' => ['Turquoise blue', '#2F7C7C'],
        'RAL 5019' => ['Capri blue', '#005C80'],
        'RAL 5020' => ['Ocean blue', '#2C4A6B'],
        'RAL 5021' => ['Water blue', '#00667C'],
        'RAL 5022' => ['Night blue', '#28365B'],
        'RAL 5023' => ['Distant blue', '#4A7A8F'],
        'RAL 5024' => ['Pastel blue', '#6998B0'],
        'RAL 5025' => ['Pearl gentian blue', '#2E4B6E'],
        'RAL 5026' => ['Pearl night blue', '#2D3E5C'],
    ],
    'GREEN' => [
        'RAL 6000' => ['Patina green', '#366657'],
        'RAL 6001' => ['Emerald green', '#336B4F'],
        'RAL 6002' => ['Leaf green', '#336B33'],
        'RAL 6003' => ['Olive green', '#4A5C33'],
        'RAL 6004' => ['Blue green', '#2D5C5B'],
        'RAL 6005' => ['Moss green', '#2F4F31'],
        'RAL 6006' => ['Grey olive', '#4C594A'],
        'RAL 6007' => ['Bottle green', '#314231'],
        'RAL 6008' => ['Brown green', '#4A4A33'],
        'RAL 6009' => ['Fir green', '#2F4733'],
        'RAL 6010' => ['Grass green', '#476633'],
        'RAL 6011' => ['Reseda green', '#668666'],
        'RAL 6012' => ['Black green', '#3A4742'],
        'RAL 6013' => ['Reed green', '#7A795C'],
        'RAL 6014' => ['Yellow olive', '#6F664A'],
        'RAL 6015' => ['Black olive', '#474742'],
        'RAL 6016' => ['Turquoise green', '#006B5B'],
        'RAL 6017' => ['May green', '#5C9E5C'],
        'RAL 6018' => ['Yellow green', '#66A533'],
        'RAL 6019' => ['Pastel green', '#B0D4B0'],
        'RAL 6020' => ['Chrome green', '#4A5642'],
        'RAL 6021' => ['Pale green', '#8FB09B'],
        'RAL 6022' => ['Olive drab', '#47472F'],
        'RAL 6024' => ['Traffic green', '#006B4A'],
        'RAL 6025' => ['Fern green', '#4A6E4F'],
        'RAL 6026' => ['Opal green', '#006E5C'],
        'RAL 6027' => ['Light green', '#A5D2C2'],
        'RAL 6028' => ['Pine green', '#2F6E4A'],
        'RAL 6029' => ['Mint green', '#00794F'],
        'RAL 6032' => ['Signal green', '#338C5B'],
        'RAL 6033' => ['Mint turquoise', '#5C9E8F'],
        'RAL 6034' => ['Pastel turquoise', '#6FA3A3'],
        'RAL 6035' => ['Pearl green', '#4A5C4F'],
        'RAL 6036' => ['Pearl opal green', '#4A5F5E'],
        'RAL 6037' => ['Pure green', '#00994F'],
        'RAL 6038' => ['Luminous green', '#00FF00'],
    ],
    'BROWN' => [
        'RAL 8000' => ['Green brown', '#7A6F56'],
        'RAL 8001' => ['Ochre brown', '#7A5B3B'],
        'RAL 8002' => ['Signal brown', '#6E4A3B'],
        'RAL 8003' => ['Clay brown', '#7A5C3B'],
        'RAL 8004' => ['Copper brown', '#8F4A3B'],
        'RAL 8007' => ['Fawn brown', '#6F4A3B'],
        'RAL 8008' => ['Olive brown', '#795C33'],
        'RAL 8011' => ['Nut brown', '#664A33'],
        'RAL 8012' => ['Red brown', '#663B33'],
        'RAL 8014' => ['Sepia brown', '#5E4A3B'],
        'RAL 8015' => ['Chestnut brown', '#663B33'],
        'RAL 8016' => ['Mahogany brown', '#5E3B33'],
        'RAL 8017' => ['Chocolate brown', '#4A3B33'],
        'RAL 8019' => ['Grey brown', '#4A3B36'],
        'RAL 8022' => ['Black brown', '#2F2F2F'],
        'RAL 8023' => ['Orange brown', '#9E5C3B'],
        'RAL 8024' => ['Beige brown', '#7F5F4A'],
        'RAL 8025' => ['Pale brown', '#7A6B5C'],
        'RAL 8028' => ['Terra brown', '#6F5E4A'],
        'RAL 8029' => ['Pearl copper', '#7A4F3B'],
    ],
    'GREY' => [
        'RAL 7000' => ['Squirrel grey', '#7A868C'],
        'RAL 7001' => ['Silver grey', '#8A9BA5'],
        'RAL 7002' => ['Olive grey', '#70705E'],
        'RAL 7003' => ['Moss grey', '#70706B'],
        'RAL 7004' => ['Signal grey', '#9B9E9E'],
        'RAL 7005' => ['Mouse grey', '#666E6E'],
        'RAL 7006' => ['Beige grey', '#797066'],
        'RAL 7008' => ['Khaki grey', '#7A7056'],
        'RAL 7009' => ['Green grey', '#5C6B66'],
        'RAL 7010' => ['Tarpaulin grey', '#5E6666'],
        'RAL 7011' => ['Iron grey', '#4A565E'],
        'RAL 7012' => ['Basalt grey', '#5C666E'],
        'RAL 7013' => ['Brown grey', '#5E5B53'],
        'RAL 7015' => ['Slate grey', '#5C666E'],
        'RAL 7016' => ['Anthracite grey', '#36424A'],
        'RAL 7021' => ['Black grey', '#3B444A'],
        'RAL 7022' => ['Umbra grey', '#4A4A42'],
        'RAL 7023' => ['Concrete grey', '#7A7D75'],
        'RAL 7024' => ['Graphite grey', '#4A4F5C'],
        'RAL 7026' => ['Granite grey', '#3D4A52'],
        'RAL 7030' => ['Stone grey', '#8F8F80'],
        'RAL 7031' => ['Blue grey', '#5C6B7A'],
        'RAL 7032' => ['Pebble grey', '#B0B0A3'],
        'RAL 7033' => ['Cement grey', '#79867A'],
        'RAL 7034' => ['Yellow grey', '#9E9E8C'],
        'RAL 7035' => ['Light grey', '#B0B0B0'],
        'RAL 7036' => ['Platinum grey', '#8F8F86'],
        'RAL 7037' => ['Dusty grey', '#7A7A7A'],
        'RAL 7038' => ['Agate grey', '#A5A59B'],
        'RAL 7039' => ['Quartz grey', '#666661'],
        'RAL 7040' => ['Window grey', '#9B9BA5'],
        'RAL 7042' => ['Traffic grey A', '#8F9BA5'],
        'RAL 7043' => ['Traffic grey B', '#4A565E'],
        'RAL 7044' => ['Silk grey', '#AFAAAA'],
        'RAL 7045' => ['Telegrey 1', '#9E9E9E'],
        'RAL 7046' => ['Telegrey 2', '#8F8F9B'],
        'RAL 7047' => ['Telegrey 4', '#C4C4C4'],
        'RAL 7048' => ['Pearl mouse grey', '#70706E'],
    ],
    'WHITE & BLACK' => [
        'RAL 9001' => ['Cream', '#EAE6D2'],
        'RAL 9002' => ['Grey white', '#C7C7B0'],
        'RAL 9003' => ['Signal white', '#EAEAEB'],
        'RAL 9004' => ['Signal black', '#2F2F2F'],
        'RAL 9005' => ['Jet black', '#000000'],
        'RAL 9006' => ['White aluminium', '#9BA5A5'],
        'RAL 9007' => ['Grey aluminium', '#868686'],
        'RAL 9010' => ['Pure white', '#FFFFFF'],
        'RAL 9011' => ['Graphite black', '#2F363B'],
        'RAL 9012' => ['Clean room white', '#E3E3E3'],
        'RAL 9016' => ['Traffic white', '#F5F5F5'],
        'RAL 9017' => ['Traffic black', '#2F2F2F'],
        'RAL 9018' => ['Papyrus white', '#D4D4CE'],
        'RAL 9022' => ['Pearl light grey', '#666666'],
        'RAL 9023' => ['Pearl dark grey', '#565656'],
    ],
    'SPECIAL FINISHES' => [
        'RAL 1035' => ['Pearl beige', '#6A5D4D'],
        'RAL 1036' => ['Pearl gold', '#705335'],
        'RAL 2005' => ['Luminous orange', '#FF4F00'],
        'RAL 2007' => ['Luminous bright orange', '#FFA421'],
        'RAL 3024' => ['Luminous red', '#FF0000'],
        'RAL 3026' => ['Luminous bright red', '#FF2A00'],
        'RAL 6038' => ['Luminous green', '#00FF00'],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Powder Coating - AL TANWEER DOORS & WINDOWS TR.</title>
    <meta name="description"
        content="Professional powder coating services with GCI Powder Coatings. Wide range of RAL colors available for your metalwork projects.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">
    <style>
        .powder-coating-section {
            padding: 80px 0;
            background: var(--primary-bg);
        }

        .color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 20px;
            margin-top: 50px;
        }

        .color-card {
            background: var(--card-bg);
            border: 1px solid var(--border-gold);
            padding: 15px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
        }

        .color-card.selected {
            border-color: var(--gold);
            box-shadow: 0 0 20px rgba(200, 168, 86, 0.5);
            transform: translateY(-5px);
        }

        .color-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-gold);
            border-color: var(--gold);
        }

        .color-sample {
            width: 100%;
            height: 80px;
            border-radius: 8px;
            margin-bottom: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .color-code {
            font-size: 13px;
            font-weight: 600;
            color: var(--gold);
            margin-bottom: 5px;
        }

        .color-name {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        .category-section {
            margin-bottom: 60px;
        }

        .category-title {
            font-size: 28px;
            color: var(--text-white);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gold);
            display: inline-block;
        }

        .gci-branding {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, var(--card-bg) 0%, var(--secondary-bg) 100%);
            border: 1px solid var(--border-gold);
            margin-bottom: 60px;
            border-radius: 8px;
        }

        .gci-branding h2 {
            font-size: 48px;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .gci-branding .subtitle {
            font-size: 24px;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .gci-contact {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .gci-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-muted);
        }

        .gci-contact-item i {
            color: var(--gold);
            font-size: 20px;
        }

        .notice-box {
            background: rgba(200, 168, 86, 0.1);
            border: 1px solid var(--gold);
            padding: 25px;
            border-radius: 8px;
            margin-top: 60px;
        }

        .notice-box h4 {
            color: var(--gold);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .notice-box p {
            color: var(--text-light);
            line-height: 1.8;
            font-size: 14px;
        }

        .select-btn {
            margin-top: 8px;
            padding: 6px 12px;
            background: var(--gold);
            color: var(--primary-bg);
            border: none;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .select-btn:hover {
            background: var(--gold-light);
            transform: scale(1.05);
        }

        .selected-colors-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--card-bg);
            border-top: 2px solid var(--gold);
            padding: 20px;
            display: none;
            z-index: 1000;
            box-shadow: 0 -5px 30px rgba(0, 0, 0, 0.5);
        }

        .selected-colors-bar.active {
            display: block;
        }

        .selected-colors-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .selected-color-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: rgba(200, 168, 86, 0.1);
            border: 1px solid var(--gold);
            border-radius: 4px;
            color: var(--text-light);
            font-size: 12px;
        }

        .selected-color-chip .color-preview {
            width: 24px;
            height: 24px;
            border-radius: 3px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .selected-color-chip .remove-color {
            background: none;
            border: none;
            color: var(--gold);
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            margin-left: 4px;
        }

        .inquiry-btn {
            padding: 12px 30px;
            background: var(--gold);
            color: var(--primary-bg);
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: var(--transition);
        }

        .inquiry-btn:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(200, 168, 86, 0.4);
        }

        @media (max-width: 768px) {
            .color-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 15px;
            }

            .gci-branding h2 {
                font-size: 36px;
            }

            .gci-branding .subtitle {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <header>
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">
                    <img src="images/logo-icon.png" alt="AL TANWEER Logo">
                </a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="powder-coating.php" class="active">Powder Coating</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php" class="nav-cta">Get Quote</a></li>
                </ul>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
        <div class="mobile-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="powder-coating.php">Powder Coating</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </header>

    <section class="page-header">
        <div class="page-header-content">
            <span class="section-tag">Professional Finishing</span>
            <h1>Powder <span class="gold-text">Coating</span></h1>
            <p>Premium GCI Powder Coatings - Full RAL Color Range</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Powder Coating</span>
            </div>
        </div>
    </section>

    <section class="powder-coating-section">
        <div class="container">
            <div class="gci-branding">
                <h2>GOLDEN POWDER COATINGS</h2>
                <p class="subtitle">Jordan</p>
                <p style="color: var(--text-muted); margin-bottom: 15px;">Premium quality powder coating solutions for
                    exceptional finishes</p>

                <div class="gci-contact">
                    <div class="gci-contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+962 79 721 9999</span>
                    </div>
                    <div class="gci-contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@gcijo.com</span>
                    </div>
                    <div class="gci-contact-item">
                        <i class="fas fa-globe"></i>
                        <span>gcipaint.com</span>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <span class="section-tag">Complete Color Range</span>
                <h2 class="section-title">RAL <span class="gold-text">Color Guide</span></h2>
                <p class="section-description">Choose from over 200 RAL colors for your premium powder coating needs.
                    Click colors to select and inquire.</p>
            </div>

            <?php foreach ($ralColors as $categoryName => $colors): ?>
                <div class="category-section">
                    <h3 class="category-title"><?php echo htmlspecialchars($categoryName); ?></h3>
                    <div class="color-grid">
                        <?php foreach ($colors as $code => $details):
                            $name = $details[0];
                            $hexColor = $details[1];
                            ?>
                            <div class="color-card"
                                onclick="selectColor('<?php echo htmlspecialchars($code); ?>', '<?php echo htmlspecialchars($name); ?>', '<?php echo htmlspecialchars($hexColor); ?>')">
                                <div class="color-sample" style="background-color: <?php echo htmlspecialchars($hexColor); ?>;">
                                </div>
                                <div class="color-code"><?php echo htmlspecialchars($code); ?></div>
                                <div class="color-name"><?php echo htmlspecialchars($name); ?></div>
                                <button class="select-btn"
                                    onclick="event.stopPropagation(); selectColor('<?php echo htmlspecialchars($code); ?>', '<?php echo htmlspecialchars($name); ?>', '<?php echo htmlspecialchars($hexColor); ?>')">Select</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="notice-box">
                <h4><i class="fas fa-info-circle"></i> IMPORTANT NOTICE</h4>
                <p>Due to the different production processes and pigments, the colours and gloss levels displayed should
                    only be used as a guide and cannot be guaranteed to match the official RAL colour standards. To
                    ensure an accurate assessment of colour and gloss level, always refer to the original RAL colour
                    cards.</p>
            </div>
        </div>
    </section>

    <!-- Selected Colors Bar -->
    <div class="selected-colors-bar" id="selectedColorsBar">
        <div class="selected-colors-container">
            <strong style="color: var(--gold);">Selected Colors:</strong>
            <div id="selectedColorsList" style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1;"></div>
            <button class="inquiry-btn" onclick="sendInquiry()">
                <i class="fas fa-envelope"></i> Send Inquiry
            </button>
        </div>
    </div>

    <section class="cta-section">
        <div class="container">
            <h2>Need Professional Powder Coating?</h2>
            <p>Contact us for premium powder coating services with the complete RAL color range</p>
            <a href="contact.php" class="btn btn-primary">Request Quote</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="images/logo-arabic.png" alt="AL TANWEER">
                    <p>Premier destination for luxury gates, doors, staircases, and custom metalwork in Sharjah, UAE.
                    </p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/tanweerdoors?igsh=cGQzNHpxa3FuMzhl" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/0566007896" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="mailto:tanweerdoor@gmail.com"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="powder-coating.php">Powder Coating</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Categories</h4>
                    <ul class="footer-links">
                        <?php foreach ($categories as $cat): ?>
                            <li><a
                                    href="products.php?category=<?php echo urlencode($cat['slug']); ?>"><?php echo htmlspecialchars($cat['name']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>050 549 7469 / 050 201 1482</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>tanweerdoor@gmail.com</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Ind Aera Sajaa Sharjah</span>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="footer-copyright">
                &copy; <?php echo date('Y'); ?> Developed & Manage By Irtaza Butt. All rights reserved.
                <a href="https://ahmad-irtaza.github.io/Portfolio/">Visit Portfolio</a>
            </p>
        </div>
    </footer>

    <a href="https://wa.me/0566007896" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/script.js"></script>
    <script>
        // Color selection functionality
        let selectedColors = [];

        function selectColor(code, name, hex) {
            const color = { code, name, hex };

            // Check if already selected
            const index = selectedColors.findIndex(c => c.code === code);

            if (index > -1) {
                // Deselect
                selectedColors.splice(index, 1);
                document.querySelectorAll('.color-card').forEach(card => {
                    if (card.querySelector('.color-code').textContent === code) {
                        card.classList.remove('selected');
                    }
                });
            } else {
                // Select
                selectedColors.push(color);
                document.querySelectorAll('.color-card').forEach(card => {
                    if (card.querySelector('.color-code').textContent === code) {
                        card.classList.add('selected');
                    }
                });
            }

            updateSelectedColorsBar();
        }

        function updateSelectedColorsBar() {
            const bar = document.getElementById('selectedColorsBar');
            const list = document.getElementById('selectedColorsList');

            if (selectedColors.length > 0) {
                bar.classList.add('active');
                list.innerHTML = selectedColors.map(color => `
                    <div class="selected-color-chip">
                        <div class="color-preview" style="background-color: ${color.hex};"></div>
                        <span>${color.code}</span>
                        <button class="remove-color" onclick="removeColor('${color.code}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `).join('');
            } else {
                bar.classList.remove('active');
            }
        }

        function removeColor(code) {
            selectColor(code, '', ''); // Toggle to deselect
        }

        function sendInquiry() {
            if (selectedColors.length === 0) {
                alert('Please select at least one color');
                return;
            }

            // Create list of selected colors
            const colorList = selectedColors.map(c => `${c.code} - ${c.name}`).join(', ');

            // Redirect to contact page with selected colors
            const message = encodeURIComponent(`Hi, I would like to inquire about powder coating services for the following RAL colors: ${colorList}`);
            window.location.href = `contact.php?message=${message}&subject=Powder Coating Inquiry`;
        }
    </script>
</body>

</html>
