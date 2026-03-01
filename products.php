<!-- products.php -->
<?php
require_once 'config/database.php';
$db = getDatabase();

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order");
$categories = $categoriesStmt->fetchAll();

if ($categoryFilter) {
    $stmt = $db->prepare("SELECT * FROM products WHERE category = ? ORDER BY name");
    $stmt->execute([$categoryFilter]);
} else {
    $stmt = $db->query("SELECT * FROM products ORDER BY category, name");
}
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>Premium Gates, Doors & Windows | AL TANWEER Metalwork Products Sharjah UAE</title>
    <meta name="description"
        content="Browse premium gates, doors, windows, staircases, fencing & pergolas. Custom metalwork, aluminum doors, iron gates, steel fabrication. Professional installation in Sharjah & Dubai UAE.">
    <meta name="keywords"
        content="aluminum doors uae, iron gates sharjah, steel gates, villa gates, entrance gates, driveway gates, main door designs, security gates, sliding gates, swing gates, metal fabrication sharjah, custom metalwork uae, wrought iron gates, aluminum fencing, steel staircases, decorative gates, compound gates, boundary gates, ornamental gates">
    <meta name="author" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://altanweerdoors.com/products.php">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Premium Gates, Doors & Windows | AL TANWEER Sharjah UAE">
    <meta property="og:description"
        content="Browse premium gates, doors, windows, staircases, fencing. Custom metalwork with professional installation.">
    <meta property="og:url" content="https://altanweerdoors.com/products.php">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://altanweerdoors.com/images/products-og.jpg">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">

    <!-- Breadcrumb Schema Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://altanweerdoors.com/"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "Products",
            "item": "https://altanweerdoors.com/products.php"
        }]
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
                    <!-- <img src="images/logo-arabic.png" alt="AL TANWEER" style="height: 40px;"> -->
                </a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php" class="active">Products</a></li>
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

    <section class="page-header">
        <div class="page-header-content">
            <span class="section-tag">Our Collection</span>
            <h1>Premium <span class="gold-text">Products</span></h1>
            <p>Explore our curated collection of masterfully crafted metalwork</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Products</span>
            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="container">
            <div class="filter-buttons">
                <button class="filter-btn <?php echo !$categoryFilter ? 'active' : ''; ?>"
                    onclick="window.location='products.php'">All Products</button>
                <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn <?php echo $categoryFilter === $cat['slug'] ? 'active' : ''; ?>"
                        onclick="window.location='products.php?category=<?php echo urlencode($cat['slug']); ?>'"><?php echo htmlspecialchars($cat['name']); ?></button>
                <?php endforeach; ?>
            </div>

            <div class="products-grid">
                <?php foreach ($products as $product): ?>
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

            <?php if (empty($products)): ?>
                <div style="text-align: center; padding: 80px 20px;">
                    <i class="fas fa-box-open"
                        style="font-size: 80px; color: var(--gold); opacity: 0.3; margin-bottom: 30px; display: block;"></i>
                    <h3 style="color: var(--text-white); margin-bottom: 15px; font-size: 28px;">No Products Found</h3>
                    <p style="color: var(--text-muted); font-size: 16px;">Check back soon for our latest masterpieces.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Need a Custom Design?</h2>
            <p>We specialize in bespoke metalwork tailored to your exact specifications.</p>
            <a href="contact.php" class="btn btn-primary">Request Custom Quote</a>
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
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Categories</h4>
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