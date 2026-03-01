<?php
require_once 'config/database.php';
$db = getDatabase();

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order LIMIT 5");
$categories = $categoriesStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>Powder Coating Services Sharjah UAE | GCI RAL Colors | AL TANWEER Metal Finishing</title>
    <meta name="description"
        content="Professional powder coating services in Sharjah UAE. Complete RAL color range, GCI powder coatings. Metal finishing for gates, doors, fencing, furniture. Free color consultation. Call 0566007896">
    <meta name="keywords"
        content="powder coating sharjah, powder coating services uae, ral color coating, gci powder coatings, metal finishing sharjah, gate powder coating, door powder coating, fence coating, anti corrosion coating, color coating sharjah, metal paint sharjah, furniture coating, powder coating near me">
    <meta name="author" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://altanweerdoors.com/powder-coating.php">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Powder Coating Services Sharjah | GCI RAL Colors - AL TANWEER">
    <meta property="og:description"
        content="Professional powder coating with complete RAL color range. Metal finishing for gates, doors, fencing. Free consultation.">
    <meta property="og:url" content="https://altanweerdoors.com/powder-coating.php">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">
    <style>
        .powder-coating-section {
            padding: 80px 0;
            background: var(--primary-bg);
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

        .pdf-container {
            background: var(--card-bg);
            border: 2px solid var(--border-gold);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 60px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .pdf-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .pdf-header h3 {
            font-size: 32px;
            color: var(--text-white);
            margin-bottom: 15px;
        }

        .pdf-header p {
            color: var(--text-muted);
            font-size: 16px;
        }

        .pdf-viewer {
            width: 100%;
            height: 800px;
            border: 2px solid rgba(200, 168, 86, 0.2);
            border-radius: 8px;
            background: #2a2a2a;
        }

        .pdf-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .pdf-btn {
            padding: 15px 35px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: var(--primary-bg);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .pdf-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(200, 168, 86, 0.4);
        }

        .notice-box {
            background: rgba(200, 168, 86, 0.1);
            border: 1px solid var(--gold);
            padding: 25px;
            border-radius: 8px;
            margin-top: 40px;
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

        @media (max-width: 768px) {
            .gci-branding h2 {
                font-size: 36px;
            }

            .gci-branding .subtitle {
                font-size: 18px;
            }

            .pdf-viewer {
                height: 600px;
            }

            .pdf-header h3 {
                font-size: 24px;
            }

            .pdf-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .pdf-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .pdf-viewer {
                height: 500px;
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
            <p>Premium GCI Powder Coatings - Complete Color Catalog</p>
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
                <h2>AL Tanweer Doors & Windows </h2>
                <p class="subtitle">POWDER COATINGS</p>
                <p style="color: var(--text-muted); margin-bottom: 15px;">Premium quality powder coating solutions for
                    exceptional finishes</p>

                <div class="gci-contact">
                    <div class="gci-contact-item">
                        <i class="fas fa-phone"></i>
                        <span>Mobile: 0566007896</span>
                    </div>
                    <div class="gci-contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>Email: tanweerdoor@gmail.com</span>
                    </div>
                </div>
            </div>

            <div class="pdf-container">
                <div class="pdf-header">
                    <h3>Complete Powder Coating Catalog</h3>
                    <p>Browse our comprehensive range of colors, finishes, and coating specifications</p>
                </div>

                <iframe src="ATDPOWDERCOATING.pdf" class="pdf-viewer" frameborder="0" type="application/pdf">
                    <p>Your browser does not support PDFs. <a href="ATDPOWDERCOATING.pdf" download>Download the
                            PDF</a> instead.</p>
                </iframe>

                <div class="pdf-buttons">
                    <a href="ATDPOWDERCOATING.pdf" download class="pdf-btn">
                        <i class="fas fa-download"></i> Download Catalog
                    </a>
                    <a href="ATDPOWDERCOATING.pdf" target="_blank" class="pdf-btn">
                        <i class="fas fa-external-link-alt"></i> Open in New Tab
                    </a>
                    <a href="contact.php?subject=Powder Coating Inquiry" class="pdf-btn">
                        <i class="fas fa-envelope"></i> Request Quote
                    </a>
                </div>

                <div class="notice-box">
                    <h4><i class="fas fa-info-circle"></i> IMPORTANT NOTICE</h4>
                    <p>Due to different production processes and pigments, colors displayed may vary. For accurate color
                        matching, please refer to official RAL color cards or contact us for physical samples. Our team
                        is ready to assist with color selection and customization.</p>
                </div>
            </div>
        </div>
    </section>

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
</body>

</html>