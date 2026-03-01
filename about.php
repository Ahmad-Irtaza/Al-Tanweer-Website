<?php
require_once 'config/database.php';
$db = getDatabase();

$aboutStmt = $db->query("SELECT content_json FROM content WHERE page = 'about'");
$aboutRow = $aboutStmt->fetch();
$about = $aboutRow ? json_decode($aboutRow['content_json'], true) : [];

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order LIMIT 5");
$categories = $categoriesStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>About AL TANWEER - Premier Doors, Gates & Metalwork Company Sharjah UAE | 20+ Years</title>
    <meta name="description"
        content="Trusted metalwork, doors & gates company in Sharjah with 20+ years experience. Professional fabrication, installation, gate automation. 5000+ projects, 3000+ happy clients. Expert craftsmen serving UAE.">
    <meta name="keywords"
        content="best gate company sharjah, trusted metalwork uae, doors company sharjah, professional metalwork, certified welding, quality gates, experienced craftsmen, sharjah metalwork company, AL TANWEER about, reliable gate installer, licensed contractors sharjah">
    <meta name="author" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://altanweerdoors.com/about.php">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="About AL TANWEER - Premier Metalwork Company Sharjah UAE">
    <meta property="og:description"
        content="20+ years of excellence in doors, gates & metalwork. 5000+ projects completed. Professional craftsmen serving Sharjah & UAE.">
    <meta property="og:url" content="https://altanweerdoors.com/about.php">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">



    <style>
        /* ===================================
   ABOUT PAGE - CENTERED LAYOUT
   =================================== */

        /* About Section */
        .about-section {
            padding: 120px 0;
            background: linear-gradient(180deg, #000000 0%, #0a0a0a 50%, #000000 100%);
            position: relative;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(212, 175, 55, 0.4) 50%,
                    transparent 100%);
        }

        .about-section .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content .section-tag {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: var(--gold);
            padding: 10px 28px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 25px;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .about-content h2 {
            font-size: 3.5rem;
            color: #ffffff;
            margin-bottom: 35px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            text-align: center;
        }

        .about-content p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.15rem;
            line-height: 2;
            margin-bottom: 30px;
            font-weight: 300;
            text-align: center;
        }

        .about-content p strong {
            color: var(--gold);
            font-weight: 700;
        }

        /* About Stats */
        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            margin-top: 80px;
            padding-top: 60px;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .stat-item {
            text-align: center;
            padding: 30px;
            background: rgba(212, 175, 55, 0.05);
            border: 2px solid rgba(212, 175, 55, 0.15);
            border-radius: 20px;
            transition: all 0.4s ease;
        }

        .stat-item:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 15px 50px rgba(212, 175, 55, 0.2);
            background: rgba(212, 175, 55, 0.1);
        }

        .stat-item h3 {
            font-size: 4rem;
            color: var(--gold);
            margin-bottom: 15px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-item p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Specializations Section */
        .specializations {
            padding: 120px 0;
            background: #000000;
            position: relative;
        }

        .specializations .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header .section-tag {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: var(--gold);
            padding: 10px 28px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 25px;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .section-title {
            font-size: 3.5rem;
            color: #ffffff;
            margin-bottom: 25px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .section-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
            font-weight: 300;
        }

        /* Values Grid */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .value-item {
            text-align: center;
            padding: 50px 35px;
            background: rgba(255, 255, 255, 0.02);
            border: 2px solid rgba(212, 175, 55, 0.15);
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .value-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            transition: width 0.4s ease;
        }

        .value-item:hover {
            transform: translateY(-15px);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 20px 60px rgba(212, 175, 55, 0.2);
            background: rgba(212, 175, 55, 0.05);
        }

        .value-item:hover::before {
            width: 100%;
        }

        .value-item i {
            font-size: 3.5rem;
            color: var(--gold);
            margin-bottom: 30px;
            display: inline-block;
            transition: all 0.4s ease;
        }

        .value-item:hover i {
            transform: scale(1.15) rotateY(360deg);
        }

        .value-item h4 {
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .value-item p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            line-height: 1.8;
            margin: 0;
            font-weight: 300;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.05) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 70% 50%, rgba(212, 175, 55, 0.06) 0%, transparent 60%);
        }

        .cta-section .container {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .cta-section h2 {
            font-size: 3.5rem;
            color: #ffffff;
            margin-bottom: 25px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .cta-section p {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 45px;
            font-weight: 300;
        }

        .cta-section .btn {
            display: inline-block;
            padding: 22px 55px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: #000000;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.15rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .cta-section .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.5);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .values-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 35px;
            }
        }

        @media (max-width: 992px) {

            .about-content h2,
            .section-title,
            .cta-section h2 {
                font-size: 3rem;
            }

            .about-stats {
                gap: 35px;
                margin-top: 60px;
                padding-top: 50px;
            }

            .stat-item h3 {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {

            .about-section,
            .specializations {
                padding: 80px 0;
            }

            .about-section .container,
            .specializations .container,
            .cta-section .container {
                padding: 0 25px;
            }

            .about-content h2,
            .section-title,
            .cta-section h2 {
                font-size: 2.5rem;
            }

            .about-content p,
            .section-description {
                font-size: 1.05rem;
            }

            .about-stats {
                grid-template-columns: 1fr;
                gap: 25px;
                margin-top: 50px;
                padding-top: 40px;
            }

            .stat-item {
                padding: 25px;
            }

            .stat-item h3 {
                font-size: 3rem;
            }

            .section-header {
                margin-bottom: 60px;
            }

            .values-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .value-item {
                padding: 40px 30px;
            }

            .value-item i {
                font-size: 3rem;
                margin-bottom: 25px;
            }

            .value-item h4 {
                font-size: 1.3rem;
            }

            .cta-section {
                padding: 80px 0;
            }

            .cta-section p {
                font-size: 1.15rem;
            }
        }

        @media (max-width: 480px) {

            .about-section,
            .specializations {
                padding: 60px 0;
            }

            .about-section .container,
            .specializations .container,
            .cta-section .container {
                padding: 0 20px;
            }

            .about-content h2,
            .section-title,
            .cta-section h2 {
                font-size: 2rem;
                letter-spacing: -0.5px;
            }

            .about-content p,
            .section-description {
                font-size: 1rem;
                line-height: 1.8;
            }

            .stat-item h3 {
                font-size: 2.5rem;
            }

            .stat-item p {
                font-size: 1rem;
            }

            .value-item {
                padding: 35px 25px;
            }

            .value-item i {
                font-size: 2.5rem;
            }

            .value-item h4 {
                font-size: 1.2rem;
            }

            .cta-section {
                padding: 60px 0;
            }

            .cta-section p {
                font-size: 1.05rem;
                margin-bottom: 35px;
            }

            .cta-section .btn {
                padding: 18px 45px;
                font-size: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about-content,
        .section-header {
            animation: fadeInUp 0.8s ease-out;
        }

        .stat-item,
        .value-item {
            animation: fadeInUp 0.7s ease-out backwards;
        }

        .stat-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .value-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .value-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .value-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .value-item:nth-child(4) {
            animation-delay: 0.4s;
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
                    <!-- <img src="images/logo-text.png" alt="AL TANWEER" style="height: 40px;"> -->
                </a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="powder-coating.php">Powder Coating</a></li>

                    <li><a href="about.php" class="active">About</a></li>
                    <!-- <li><a href="contact.php">Contact</a></li> -->
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
            <span class="section-tag">Our Story</span>
            <h1>About <span class="gold-text">AL TANWEER</span></h1>
            <p>Decades of excellence in premium metalwork craftsmanship</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>About</span>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <span class="section-tag">Who We Are</span>
                <h2><?php echo htmlspecialchars($about['title'] ?? 'Crafting Excellence Since Decades'); ?></h2>
                <p><?php echo htmlspecialchars($about['content'] ?? 'AL TANWEER DOORS & WINDOWS TR. is a premier metalwork and automation company based in Sharjah, UAE. With decades of expertise in casting, fabrication, and installation, we deliver premium quality gates, fencing, pergolas, and automated systems that combine durability with aesthetic excellence.'); ?>
                </p>
                <p><strong>Our Mission:</strong>
                    <?php echo htmlspecialchars($about['mission'] ?? 'To provide exceptional metalwork solutions that enhance the security and beauty of every property we serve.'); ?>
                </p>
                <p><strong>Our Vision:</strong>
                    <?php echo htmlspecialchars($about['vision'] ?? 'To be the leading provider of premium doors, windows, and metal fabrication services in the UAE.'); ?>
                </p>
                <div class="about-stats">
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['experience'] ?? '20+'); ?></h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['projects'] ?? '5000+'); ?></h3>
                        <p>Projects Completed</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['clients'] ?? '3000+'); ?></h3>
                        <p>Happy Clients</p>
                    </div>
                </div>
            </div>
            <!-- <div class="about-image">
                <div class="about-image-placeholder">
                    <i class="fas fa-building"></i>
                </div>
            </div> -->
        </div>
    </section>

    <section class="specializations">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Why Choose Us</span>
                <h2 class="section-title">Our Core <span class="gold-text">Values</span></h2>
                <p class="section-description">The principles that guide our work and define our commitment to
                    excellence.</p>
            </div>
            <div class="values-grid">
                <div class="value-item">
                    <i class="fas fa-gem"></i>
                    <h4>Premium Quality</h4>
                    <p>We use only the finest materials and maintain the highest standards in every project we
                        undertake.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-handshake"></i>
                    <h4>Integrity</h4>
                    <p>Honest pricing, transparent processes, and reliable service you can trust completely.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-lightbulb"></i>
                    <h4>Innovation</h4>
                    <p>Combining traditional craftsmanship with modern technology and contemporary designs.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-users"></i>
                    <h4>Client Focus</h4>
                    <p>Your satisfaction is our priority - we listen, adapt, and deliver beyond expectations.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Let's Create Something Beautiful</h2>
            <p>Ready to transform your space? Get in touch for a consultation.</p>
            <a href="contact.php" class="btn btn-primary">Start Your Project</a>
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
                        <a href="https://instagram.com/tanweerdoors" target="_blank"><i
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
    </footer>

    <a href="https://wa.me/0566007896" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/script.js"></script>
</body>

</html>