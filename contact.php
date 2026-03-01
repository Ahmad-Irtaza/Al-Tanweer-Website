<?php
require_once 'config/database.php';
$db = getDatabase();

$contactStmt = $db->query("SELECT content_json FROM content WHERE page = 'contact'");
$contactRow = $contactStmt->fetch();
$contact = $contactRow ? json_decode($contactRow['content_json'], true) : [];

$categoriesStmt = $db->query("SELECT * FROM categories ORDER BY sort_order LIMIT 5");
$categories = $categoriesStmt->fetchAll();

$productInquiry = isset($_GET['product']) ? $_GET['product'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <title>Contact AL TANWEER Doors & Windows | Get Free Quote Sharjah UAE | Sajaa Industrial</title>
    <meta name="description"
        content="Get free quote for doors, gates, windows & metalwork in Sharjah. Visit our Sajaa Industrial Area showroom or call 0566007896. Professional installation across UAE. Email: tanweerdoor@gmail.com">
    <meta name="keywords"
        content="contact doors company sharjah, get quote gates uae, request metalwork quote, door installation sharjah, gate quote uae, free consultation metalwork, sajaa industrial area, book gate installation, order custom gates, find metalwork contractor sharjah, AL TANWEER contact, gates company phone number">
    <meta name="author" content="AL TANWEER DOORS & WINDOWS TR.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://altanweerdoors.com/contact.php">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Contact AL TANWEER - Get Free Quote for Doors & Gates Sharjah">
    <meta property="og:description"
        content="Get free quote for doors, gates, windows. Visit Sajaa Industrial Area showroom. Call 0566007896">
    <meta property="og:url" content="https://altanweerdoors.com/contact.php">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">


    <style>
        /* ===================================
   CONTACT PAGE - PREMIUM DESIGN
   =================================== */

        :root {
            --gold: #D4AF37;
            --gold-light: #F4E4B0;
            --gold-dark: #B8941E;
            --dark-bg: #0a0a0a;
            --card-bg: rgba(25, 25, 25, 0.98);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.98), rgba(20, 20, 20, 0.98)),
                url('../images/contact-hero.jpg') center/cover;
            padding: 180px 0 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 50%, rgba(212, 175, 55, 0.1) 0%, transparent 60%),
                radial-gradient(circle at 70% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 60%);
        }

        .page-header-content {
            position: relative;
            z-index: 2;
        }

        .section-tag {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: var(--gold);
            padding: 12px 32px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 25px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            backdrop-filter: blur(10px);
        }

        .page-header h1 {
            font-size: 4.5rem;
            color: #ffffff;
            margin: 25px 0;
            font-weight: 800;
            letter-spacing: -2px;
        }

        .gold-text {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header>p {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 35px;
            font-weight: 300;
        }

        .breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .breadcrumb a {
            color: var(--gold);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--gold-light);
        }

        /* Contact Section */
        .contact-section {
            padding: 120px 0 140px;
            background:
                linear-gradient(180deg, #000000 0%, #0a0a0a 50%, #000000 100%);
            position: relative;
        }

        .contact-section::before {
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

        .contact-section .container {
            display: grid;
            grid-template-columns: 520px 1fr;
            gap: 100px;
            max-width: 1450px;
            margin: 0 auto;
            padding: 0 50px;
            align-items: start;
        }

        /* Contact Info */
        .contact-info {
            position: sticky;
            top: 100px;
        }

        .contact-info .section-tag {
            font-size: 0.75rem;
            padding: 10px 26px;
            margin-bottom: 30px;
        }

        .contact-info h2 {
            font-size: 3.5rem;
            color: #ffffff;
            margin-bottom: 30px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .contact-info>p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.15rem;
            line-height: 2;
            margin-bottom: 60px;
            font-weight: 300;
        }

        /* Contact Details */
        .contact-details {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .contact-details li {
            display: flex;
            align-items: flex-start;
            gap: 26px;
            padding: 32px;
            background: var(--card-bg);
            border: 2px solid rgba(212, 175, 55, 0.15);
            border-radius: 18px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .contact-details li::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-dark) 100%);
            transform: scaleY(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-details li:hover {
            background: rgba(212, 175, 55, 0.08);
            border-color: rgba(212, 175, 55, 0.5);
            transform: translateX(10px);
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.2);
        }

        .contact-details li:hover::before {
            transform: scaleY(1);
        }

        .contact-details .icon {
            width: 64px;
            height: 64px;
            min-width: 64px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.25), rgba(212, 175, 55, 0.1));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 1.6rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(212, 175, 55, 0.25);
        }

        .contact-details li:hover .icon {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #000000;
            transform: scale(1.08) rotate(8deg);
            border-color: var(--gold);
        }

        .contact-details .text h4 {
            color: #ffffff;
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .contact-details .text p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.05rem;
            line-height: 1.7;
            margin: 0;
            font-weight: 300;
        }

        /* Contact Form Wrapper */
        .contact-form-wrapper {
            background: var(--card-bg);
            border: 2px solid rgba(212, 175, 55, 0.2);
            border-radius: 28px;
            padding: 70px 65px;
            position: relative;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6);
        }

        .contact-form-wrapper::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 2px;
            background: linear-gradient(90deg,
                    transparent 0%,
                    var(--gold) 50%,
                    transparent 100%);
        }

        .contact-form h3 {
            font-size: 2.8rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 800;
            position: relative;
            padding-bottom: 25px;
            letter-spacing: -0.5px;
        }

        .contact-form h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold-dark));
            border-radius: 2px;
        }

        /* Form Message */
        #formMessage {
            padding: 20px 26px;
            border-radius: 14px;
            margin-bottom: 35px;
            font-size: 1rem;
            display: none;
            font-weight: 500;
        }

        #formMessage.success {
            background: rgba(46, 204, 113, 0.12);
            border: 2px solid rgba(46, 204, 113, 0.4);
            color: #2ecc71;
            display: block;
        }

        #formMessage.error {
            background: rgba(231, 76, 60, 0.12);
            border: 2px solid rgba(231, 76, 60, 0.4);
            color: #e74c3c;
            display: block;
        }

        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 32px;
        }

        .form-group label {
            display: block;
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 20px 24px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            color: #ffffff;
            font-size: 1.05rem;
            font-family: inherit;
            transition: all 0.3s ease;
            font-weight: 300;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--gold);
            box-shadow: 0 0 0 5px rgba(212, 175, 55, 0.15);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
            font-weight: 300;
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
            line-height: 1.8;
        }

        /* Submit Button */
        .contact-form button[type="submit"] {
            width: 100%;
            padding: 24px 50px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: #000000;
            border: none;
            border-radius: 14px;
            font-size: 1.15rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            overflow: hidden;
        }

        .contact-form button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .contact-form button[type="submit"]:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.5);
        }

        .contact-form button[type="submit"]:hover::before {
            width: 400px;
            height: 400px;
        }

        .contact-form button[type="submit"]:active {
            transform: translateY(-2px);
        }

        .contact-form button[type="submit"] i {
            font-size: 1.2rem;
        }

        /* Map Section */
        .map-section {
            height: 550px;
            position: relative;
            overflow: hidden;
            border-top: 2px solid rgba(212, 175, 55, 0.2);
        }

        .map-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg,
                    rgba(0, 0, 0, 0.4) 0%,
                    transparent 15%,
                    transparent 85%,
                    rgba(0, 0, 0, 0.4) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .map-section iframe {
            width: 100%;
            height: 100%;
            border: none;
            filter: grayscale(100%) contrast(1.3) brightness(0.85);
            transition: filter 0.5s ease;
        }

        .map-section:hover iframe {
            filter: grayscale(80%) contrast(1.2) brightness(0.95);
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-info {
            animation: slideInLeft 0.9s ease-out;
        }

        .contact-form-wrapper {
            animation: slideInRight 0.9s ease-out;
        }

        .contact-details li {
            animation: slideInLeft 0.7s ease-out backwards;
        }

        .contact-details li:nth-child(1) {
            animation-delay: 0.2s;
        }

        .contact-details li:nth-child(2) {
            animation-delay: 0.35s;
        }

        .contact-details li:nth-child(3) {
            animation-delay: 0.5s;
        }

        .contact-details li:nth-child(4) {
            animation-delay: 0.65s;
        }

        /* Responsive Design */
        @media (max-width: 1400px) {
            .contact-section .container {
                grid-template-columns: 480px 1fr;
                gap: 80px;
                padding: 0 40px;
            }
        }

        @media (max-width: 1200px) {
            .contact-section .container {
                grid-template-columns: 440px 1fr;
                gap: 60px;
            }

            .contact-info h2 {
                font-size: 3rem;
            }

            .contact-form-wrapper {
                padding: 60px 50px;
            }

            .contact-form h3 {
                font-size: 2.4rem;
            }
        }

        @media (max-width: 992px) {
            .page-header {
                padding: 140px 0 100px;
            }

            .page-header h1 {
                font-size: 3.5rem;
            }

            .contact-section {
                padding: 100px 0 120px;
            }

            .contact-section .container {
                grid-template-columns: 1fr;
                gap: 80px;
                padding: 0 30px;
            }

            .contact-info {
                position: static;
            }

            .contact-info h2 {
                font-size: 2.8rem;
            }

            .contact-form-wrapper {
                padding: 55px 45px;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 120px 0 80px;
            }

            .page-header h1 {
                font-size: 2.8rem;
            }

            .page-header>p {
                font-size: 1.2rem;
            }

            .contact-section {
                padding: 80px 0 100px;
            }

            .contact-section .container {
                padding: 0 25px;
                gap: 60px;
            }

            .contact-info h2 {
                font-size: 2.3rem;
            }

            .contact-info>p {
                font-size: 1.05rem;
            }

            .contact-form-wrapper {
                padding: 45px 35px;
            }

            .contact-form h3 {
                font-size: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .contact-details li {
                padding: 26px;
            }

            .contact-details .icon {
                width: 56px;
                height: 56px;
                min-width: 56px;
                font-size: 1.4rem;
            }

            .map-section {
                height: 450px;
            }
        }

        @media (max-width: 480px) {
            .page-header {
                padding: 100px 0 60px;
            }

            .page-header h1 {
                font-size: 2.2rem;
                letter-spacing: -1px;
            }

            .page-header>p {
                font-size: 1.1rem;
            }

            .contact-section {
                padding: 60px 0 80px;
            }

            .contact-section .container {
                padding: 0 20px;
            }

            .contact-info h2 {
                font-size: 2rem;
            }

            .contact-info>p {
                font-size: 1rem;
            }

            .contact-form-wrapper {
                padding: 35px 25px;
            }

            .contact-form h3 {
                font-size: 1.7rem;
            }

            .form-group input,
            .form-group textarea {
                padding: 16px 20px;
                font-size: 1rem;
            }

            .contact-form button[type="submit"] {
                padding: 20px 40px;
                font-size: 1rem;
            }

            .contact-details li {
                padding: 22px;
            }

            .contact-details .icon {
                width: 52px;
                height: 52px;
                min-width: 52px;
            }

            .map-section {
                height: 350px;
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
                    <li><a href="products.php">Products</a></li>
                    <li><a href="powder-coating.php">Powder Coating</a></li>

                    <li><a href="about.php">About</a></li>
                    <!-- <li><a href="contact.php" class="active">Contact</a></li> -->
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
            <span class="section-tag">Get In Touch</span>
            <h1>Contact <span class="gold-text">Us</span></h1>
            <p>Let's discuss your next project</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Contact</span>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-info">
                <span class="section-tag">Reach Out</span>
                <h2>Let's Start a Conversation</h2>
                <p>Whether you're envisioning a grand entrance gate, elegant staircase, or custom metalwork, our team is
                    ready to bring your dreams to life. Contact us today for a free consultation.</p>

                <ul class="contact-details">
                    <li>
                        <div class="icon"><i class="fas fa-phone"></i></div>
                        <div class="text">
                            <h4>Phone</h4>
                            <p><?php echo implode(' / ', $contact['phones'] ?? ['050 549 7469', '050 201 1482']); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <div class="text">
                            <h4>Email</h4>
                            <p><?php echo htmlspecialchars($contact['email'] ?? 'tanweerdoor@gmail.com'); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="text">
                            <h4>Location</h4>
                            <p><?php echo htmlspecialchars($contact['address'] ?? 'Ind Aera Sajaa Sharjah'); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                        <div class="text">
                            <h4>Working Hours</h4>
                            <p><?php echo htmlspecialchars($contact['hours'] ?? 'Saturday - Thursday: 8:00 AM - 6:00 PM'); ?>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="contact-form-wrapper">
                <form class="contact-form" id="contactForm">
                    <h3>Send Us a Message</h3>

                    <div id="formMessage" class="form-message"></div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message *</label>
                        <textarea id="message" name="message" required
                            placeholder="<?php echo $productInquiry ? 'I am interested in: ' . htmlspecialchars($productInquiry) . '. ' : ''; ?>Tell us about your project..."><?php echo $productInquiry ? 'I am interested in: ' . htmlspecialchars($productInquiry) . '. ' : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115461.49279234961!2d55.37246752891647!3d25.346254927925844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5f5d5f5f5f5f%3A0x5f5f5f5f5f5f5f5f!2sSharjah%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2s!4v1635000000000!5m2!1sen!2s"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
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
            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; <?php echo date('Y'); ?> Developed & Manage By Irtaza Butt. All rights reserved.
                    <a href="https://ahmad-irtaza.github.io/Portfolio/">Visit Portfolio</a>
                </p>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/0566007896" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/script.js"></script>
</body>

</html>