<?php
require_once 'config/database.php';
$db = getDatabase();

$slidesStmt = $db->query("SELECT * FROM slides WHERE active = 1 ORDER BY sort_order");
$slides = $slidesStmt->fetchAll();

$productsStmt = $db->query("SELECT * FROM products WHERE featured = 1 LIMIT 6");
$products = $productsStmt->fetchAll();

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order");
$categories = $categoriesStmt->fetchAll();

$aboutStmt = $db->query("SELECT content_json FROM content WHERE page = 'about'");
$aboutRow = $aboutStmt->fetch();
$about = $aboutRow ? json_decode($aboutRow['content_json'], true) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>Premium Doors & Windows Sharjah | AL TANWEER Gates, Metalwork & Automation UAE</title>
    <meta name="description"
        content="Leading doors, windows & gates company in Sharjah. Custom metalwork, automation, powder coating. Villa gates, steel doors, fencing & staircases. Sajaa Industrial Area. Call 0566007896">
    <meta name="keywords"
        content="doors and windows sharjah, metalwork sharjah uae, gates company sharjah, custom doors sharjah, iron gates sharjah, steel gates, aluminum doors uae, villa gates, entrance gates, metal fabrication sharjah, powder coating sharjah, gate automation, fencing sharjah, staircases sharjah, sajaa industrial area, AL TANWEER doors, tanweer windows">
    <meta name="author" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="https://altanweerdoors.com/index.php">

    <!-- Open Graph / Social Media Tags -->
    <meta property="og:locale" content="en_AE">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Premium Doors & Windows Sharjah | AL TANWEER Gates & Metalwork UAE">
    <meta property="og:description"
        content="Leading doors, windows & gates company in Sharjah. Custom metalwork, automation,powder coating. Professional installation across UAE.">
    <meta property="og:url" content="https://altanweerdoors.com/">
    <meta property="og:site_name" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta property="og:image" content="https://altanweerdoors.com/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Premium Doors & Windows Sharjah | AL TANWEER">
    <meta name="twitter:description"
        content="Leading doors, windows & gates company in Sharjah. Custom metalwork, automation, powder coating.">
    <meta name="twitter:image" content="https://altanweerdoors.com/images/og-image.jpg">

    <!-- Geo Tags for Local SEO -->
    <meta name="geo.region" content="AE-SH">
    <meta name="geo.placename" content="Sharjah">
    <meta name="geo.position" content="25.346255;55.420932">
    <meta name="ICBM" content="25.346255, 55.420932">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">

    <!-- Structured Data / Schema Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "AL TANWEER DOORS & WINDOWS TR.",
        "image": "https://altanweerdoors.com/images/logo-icon.png",
        "@id": "https://altanweerdoors.com",
        "url": "https://altanweerdoors.com",
        "telephone": "+971-50-549-7469",
        "priceRange": "$$-$$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Ind Area Sajaa",
            "addressLocality": "Sharjah",
            "addressRegion": "SH",
            "postalCode": "",
            "addressCountry": "AE"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 25.346255,
            "longitude": 55.420932
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Saturday",
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday"
            ],
            "opens": "08:00",
            "closes": "18:00"
        },
        "sameAs": [
            "https://www.instagram.com/tanweerdoors",
            "https://wa.me/0566007896"
        ],
        "description": "Premier doors, windows, gates and metalwork company in Sharjah, UAE. Specializing in custom metal fabrication, gate automation, powder coating, and professional installation services. Serving Sharjah, Dubai, and across UAE with 20+ years of experience.",
        "areaServed": [
            "Sharjah",
            "Dubai",
            "Ajman",
            "Umm Al Quwain",
            "Ras Al Khaimah",
            "Fujairah",
            "Abu Dhabi",
            "United Arab Emirates"
        ],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Doors, Windows & Gates Services",
            "itemListElement": [
                {
                    "@type": "OfferCatalog",
                    "name": "Gates",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Custom Gates Installation"
                            }
                        }
                    ]
                },
                {
                    "@type": "OfferCatalog",
                    "name": "Doors & Windows",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Aluminum Doors & Windows"
                            }
                        }
                    ]
                },
                {
                    "@type": "OfferCatalog",
                    "name": "Metalwork Services",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Custom Metal Fabrication"
                            }
                        },
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Powder Coating Services"
                            }
                        },
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Gate Automation"
                            }
                        }
                    ]
                }
            ]
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "AL TANWEER DOORS & WINDOWS TR.",
        "alternateName": "AL TANWEER",
        "url": "https://altanweerdoors.com",
        "logo": "https://altanweerdoors.com/images/logo-icon.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+971-50-549-7469",
            "contactType": "customer service",
            "areaServed": "AE",
            "availableLanguage": ["en", "ar"]
        },
        "sameAs": [
            "https://www.instagram.com/tanweerdoors",
            "https://wa.me/0566007896"
        ]
    }
    </script>
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
                    <!-- <img src="images/logo-arabi.png" alt="AL TANWEER" style="height: 40px;"> -->
                </a>
                <ul class="nav-links">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="powder-coating.php">Powder Coating</a></li>
                    <li><a href="about.php">About</a></li>
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

    <section class="hero-slider">
        <?php if (!empty($slides)): ?>
            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="slide-bg"
                        style="background-image: url('<?php echo htmlspecialchars($slide['image_path'] ?: 'images/slide-default.jpg'); ?>'); background-color: #111;">
                    </div>
                    <div class="slide-overlay"></div>
                    <div class="slide-content">
                        <p class="slide-subtitle"><?php echo htmlspecialchars($slide['subtitle'] ?: 'Premium Metalwork'); ?></p>
                        <h1 class="slide-title"><?php echo htmlspecialchars($slide['title'] ?: 'Crafting Excellence'); ?></h1>
                        <?php if ($slide['button_text']): ?>
                            <div class="slide-btn">
                                <a href="<?php echo htmlspecialchars($slide['button_link'] ?: 'products.php'); ?>"
                                    class="btn btn-primary"><?php echo htmlspecialchars($slide['button_text']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="slide active">
                <div class="slide-bg" style="background-color: #111;"></div>
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <p class="slide-subtitle">Premium Metalwork & Automation</p>
                    <h1 class="slide-title">Crafting Excellence in <span>Doors & Gates</span></h1>
                    <div class="slide-btn">
                        <a href="products.php" class="btn btn-primary">Explore Collection</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (count($slides) > 1): ?>
            <div class="slider-arrows">
                <button class="slider-arrow slider-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow slider-next"><i class="fas fa-chevron-right"></i></button>
            </div>

            <div class="slider-nav">
                <?php foreach ($slides as $index => $slide): ?>
                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>"></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="hero-scroll">
            <span>Scroll</span>
            <div class="line"></div>
        </div>
    </section>

    <section class="specializations" id="specializations">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Our Expertise</span>
                <h2 class="section-title">What We <span class="gold-text">Specialize</span> In</h2>
                <p class="section-description">Combining traditional craftsmanship with modern technology to deliver
                    exceptional metalwork solutions that stand the test of time.</p>
            </div>
            <div class="spec-grid">
                <div class="spec-card">
                    <div class="spec-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3>Precision Casting</h3>
                    <p>Expert metal casting for decorative and structural components with intricate, timeless designs.
                    </p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">
                        <i class="fas fa-hammer"></i>
                    </div>
                    <h3>Custom Fabrication</h3>
                    <p>Bespoke metal fabrication using advanced techniques for durable, museum-quality products.</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3>Smart Automation</h3>
                    <p>State-of-the-art automation systems for gates and doors with intelligent access control.</p>
                </div>
                <div class="spec-card">
                    <div class="spec-icon">
                        <i class="fas fa-ruler-combined"></i>
                    </div>
                    <h3>Expert Installation</h3>
                    <p>Professional installation services ensuring perfect fit and lifetime performance guarantee.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="products-section" id="products">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Featured Collection</span>
                <h2 class="section-title">Our <span class="gold-text">Masterpieces</span></h2>
                <p class="section-description">Discover our curated selection of premium metalwork designed to transform
                    and elevate your property.</p>
            </div>
            <div class="products-grid">
                <?php foreach ($products as $product):
                    $specs = json_decode($product['specifications_json'], true) ?? [];
                    ?>
                    <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                        <div class="product-image">
                            <span
                                class="product-category"><?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $product['category']))); ?></span>
                            <?php if ($product['image_path'] && file_exists($product['image_path'])): ?>
                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy">
                            <?php else: ?>
                                <i class="fas fa-door-open placeholder-icon"></i>
                            <?php endif; ?>
                            <div class="product-overlay">
                                <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-white">View
                                    Details</a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-link">
                                Discover More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 60px;">
                <a href="products.php" class="btn btn-outline">View All Collection</a>
            </div>
        </div>
    </section>

    <section class="categories-showcase">
        <div class="categories-scroll">
            <?php foreach (array_merge($categories, $categories) as $cat): ?>
                <a href="products.php?category=<?php echo urlencode($cat['slug']); ?>" class="category-item">
                    <i class="fas <?php echo htmlspecialchars($cat['icon'] ?: 'fa-door-closed'); ?>"></i>
                    <span><?php echo htmlspecialchars($cat['name']); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <span class="section-tag">About Us</span>
                <h2><?php echo htmlspecialchars($about['title'] ?? 'Crafting Excellence Since Decades'); ?></h2>
                <p><?php echo htmlspecialchars($about['content'] ?? 'AL TANWEER DOORS & WINDOWS TR. is a premier metalwork and automation company based in Sharjah, UAE.'); ?>
                </p>
                <div class="about-stats">
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['experience'] ?? '20+'); ?></h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['projects'] ?? '5000+'); ?></h3>
                        <p>Projects Done</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo htmlspecialchars($about['clients'] ?? '3000+'); ?></h3>
                        <p>Happy Clients</p>
                    </div>
                </div>
                <a href="about.php" class="btn btn-primary" style="margin-top: 40px;">Learn More</a>
            </div>
            <!-- <div class="about-image">
                <div class="about-image-placeholder">
                    <i class="fas fa-building"></i>
                </div>
            </div> -->
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Ready to Transform Your Space?</h2>
            <p>Let's bring your vision to life with exceptional craftsmanship and attention to detail.</p>
            <a href="contact.php" class="btn btn-primary">Start Your Project</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="images/logo-arabic.png" alt="AL TANWEER">
                    <p>Premier destination for luxury gates, doors, staircases, and custom metalwork in Sharjah, UAE.
                        Expert craftsmanship delivering excellence for decades.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/tanweerdoors?igsh=cGQzNHpxa3FuMzhl" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/971566007896" target="_blank"><i class="fab fa-whatsapp"></i></a>
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
                    <h4>Products</h4>
                    <ul class="footer-links">
                        <?php foreach (array_slice($categories, 0, 5) as $cat): ?>
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
                            <span>050 549 7469<br>050 201 1482</span>
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

    <a href="https://wa.me/971566007896" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/script.js"></script>
</body>

</html>