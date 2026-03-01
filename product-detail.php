<!--product-detail.php  -->
<?php
require_once 'config/database.php';
$db = getDatabase();

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php');
    exit;
}

$specs = json_decode($product['specifications_json'], true) ?? [];

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order LIMIT 5");
$categories = $categoriesStmt->fetchAll();

$relatedStmt = $db->prepare("SELECT * FROM products WHERE category = ? AND id != ? LIMIT 3");
$relatedStmt->execute([$product['category'], $product['id']]);
$relatedProducts = $relatedStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - AL TANWEER</title>
    <meta name="description" content="<?php echo htmlspecialchars($product['description']); ?>">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">


    <style>
        /* Product Detail Section */
        .product-detail {
            padding: 80px 0;
            background: var(--bg-dark);
        }

        .product-detail .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .product-gallery {
            width: 100%;
            position: sticky;
            top: 100px;
        }

        .product-main-image {
            width: 100%;
            height: 600px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-main-image:hover img {
            transform: scale(1.05);
        }

        .product-main-image .placeholder-icon {
            font-size: 120px;
            color: var(--gold);
            opacity: 0.3;
        }

        .product-info {
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* .product-info .category {
    display: inline-block;
    padding: 8px 18px;
    background: rgba(212, 175, 55, 0.15);
    color: var(--gold);
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
    align-self: flex-start;
}

.product-info h1 {
    font-size: 48px;
    color: var(--text-white);
    margin-bottom: 24px;
    line-height: 1.2;
    font-weight: 700;
}

.product-info .description {
    color: var(--text-muted);
    font-size: 17px;
    line-height: 1.8;
    margin-bottom: 40px;
} */

        .product-info .category {
            display: inline-block;
            padding: 10px 24px;
            background: rgba(212, 175, 55, 0.2);
            color: var(--gold);
            border-radius: 25px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            align-self: flex-start;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .product-info h1 {
            font-size: 52px;
            color: var(--text-white);
            margin-bottom: 32px;
            line-height: 1.15;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .product-info .description {
            color: rgba(255, 255, 255, 0.8);
            font-size: 22px;
            line-height: 1.8;
            margin-bottom: 50px;
            font-weight: 400;
            max-width: 95%;
            letter-spacing: 0.4px;
        }


        .specifications {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 40px;
            border: 1px solid rgba(212, 175, 55, 0.15);
            margin-bottom: 40px;
        }

        .specifications h3 {
            color: var(--text-white);
            font-size: 22px;
            margin-bottom: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .specifications h3::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--gold);
            border-radius: 2px;
        }

        .specifications table {
            width: 100%;
            border-collapse: collapse;
        }

        .specifications table tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .specifications table tr:last-child {
            border-bottom: none;
        }

        .specifications table td {
            padding: 18px 0;
            color: var(--text-white);
            font-size: 16px;
        }

        .specifications table td:first-child {
            font-weight: 600;
            color: var(--text-muted);
            width: 40%;
            font-size: 15px;
        }

        .specifications table td:last-child {
            color: var(--text-white);
            font-weight: 600;
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .product-detail .container {
                gap: 60px;
            }

            .product-info h1 {
                font-size: 40px;
            }
        }

        @media (max-width: 968px) {
            .product-detail .container {
                grid-template-columns: 1fr;
                gap: 50px;
                padding: 0 20px;
            }

            .product-gallery {
                position: relative;
                top: 0;
            }

            .product-main-image {
                height: 500px;
            }

            .product-info h1 {
                font-size: 36px;
            }

            .product-info .description {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .product-detail {
                padding: 40px 0;
            }

            .product-main-image {
                height: 400px;
            }

            .product-info h1 {
                font-size: 28px;
            }

            .specifications {
                padding: 24px;
            }

            .specifications h3 {
                font-size: 20px;
            }

            .specifications table td {
                font-size: 14px;
                padding: 12px 0;
            }

            .specifications table td:first-child {
                width: 45%;
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
                    <!-- <img src="images/logo-text.png" alt="AL TANWEER" style="height: 40px;"> -->
                </a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="products.php" class="active">Products</a></li>
                    <li><a href="powder-coating.php">Powder Coating</a></li>
                    <li><a href="contact.php">Contact</a></li>
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

    <section class="page-header" style="min-height: 40vh;">
        <div class="page-header-content">
            <span
                class="section-tag"><?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $product['category']))); ?></span>
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <a href="products.php">Products</a>
                <span>/</span>
                <span><?php echo htmlspecialchars($product['name']); ?></span>
            </div>
        </div>
    </section>

    <section class="product-detail">
        <div class="container">
            <div class="product-gallery">
                <div class="product-main-image">
                    <?php if ($product['image_path'] && file_exists($product['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($product['image_path']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <i class="fas fa-door-open placeholder-icon"></i>
                    <?php endif; ?>
                </div>
            </div>

            <div class="product-info">
                <span
                    class="category"><?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $product['category']))); ?></span>
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>

                <?php if (!empty($specs)): ?>
                    <div class="specifications">
                        <h3>Specifications</h3>
                        <table>
                            <?php foreach ($specs as $key => $value): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $key))); ?></td>
                                    <td><?php echo htmlspecialchars($value); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>

                <div style="display: flex; gap: 20px; margin-top: 40px; flex-wrap: wrap;">
                    <a href="contact.php?product=<?php echo urlencode($product['name']); ?>"
                        class="btn btn-primary">Request Quote</a>
                    <a href="https://wa.me/0566007896?text=<?php echo urlencode('Hi, I am interested in: ' . $product['name']); ?>"
                        class="btn btn-outline" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($relatedProducts)): ?>
        <section class="products-section" style="padding-top: 0;">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">You May Also Like</span>
                    <h2 class="section-title">Related <span class="gold-text">Products</span></h2>
                </div>
                <div class="products-grid">
                    <?php foreach ($relatedProducts as $related): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <span
                                    class="product-category"><?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $related['category']))); ?></span>
                                <?php if ($related['image_path'] && file_exists($related['image_path'])): ?>
                                    <img src="<?php echo htmlspecialchars($related['image_path']); ?>"
                                        alt="<?php echo htmlspecialchars($related['name']); ?>" loading="lazy">
                                <?php else: ?>
                                    <i class="fas fa-door-open placeholder-icon"></i>
                                <?php endif; ?>
                                <div class="product-overlay">
                                    <a href="product-detail.php?id=<?php echo $related['id']; ?>" class="btn btn-white">View
                                        Details</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><?php echo htmlspecialchars($related['name']); ?></h3>
                                <p><?php echo htmlspecialchars($related['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="cta-section">
        <div class="container">
            <h2>Interested in This Product?</h2>
            <p>Contact us for pricing, customization options, and installation details.</p>
            <a href="contact.php?product=<?php echo urlencode($product['name']); ?>" class="btn btn-primary">Get Quote
                Now</a>
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
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AL TANWEER DOORS & WINDOWS TR. All rights reserved.</p>
                <p>Designed with <i class="fas fa-heart" style="color: var(--gold);"></i> for Excellence</p>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/0566007896" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/script.js"></script>
</body>

</html>