<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/css/header.css">
    <!-- Other CSS files will be included by individual pages -->
</head>

<body>
    <header class="site-header">
        <div class="header-container">
            <div class="branding">
                <h1 class="site-title">
                    <a href="/">PinewoodStore Auto Shop</a>
                </h1>
                <p class="tagline">Complete Automotive Care Center</p>
            </div>

            <nav class="main-navigation">
                <button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">
                    <span class="hamburger"></span>
                    <span class="sr-only">Menu</span>
                </button>

                <ul id="primary-menu">
                    <li><a href="/index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="/services.php" class="<?= basename($_SERVER['PHP_SELF']) === 'services.php' ? 'active' : '' ?>">Services</a></li>
                    <li><a href="/specials.php" class="<?= basename($_SERVER['PHP_SELF']) === 'specials.php' ? 'active' : '' ?>">Specials</a></li>
                    <li><a href="/about.php" class="<?= basename($_SERVER['PHP_SELF']) === 'about.php' ? 'active' : '' ?>">About</a></li>
                    <li><a href="/testimonials.php" class="<?= basename($_SERVER['PHP_SELF']) === 'testimonials.php' ? 'active' : '' ?>">Testimonials</a></li>
                    <li><a href="/contact.php" class="<?= basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : '' ?>">Contact</a></li>
                    <li class="highlight"><a href="/appointment.php">Schedule Now</a></li>

                    <!-- Add these new user action items -->
                    <?php if (isset($_COOKIE['auth_token'])): ?>
                        <li class="user-menu"><a href="/account.php" class="user-link"><i class="icon-user"></i> My Account</a></li>
                        <li class="user-menu"><a href="/logout.php" class="logout-link">Logout</a></li>
                    <?php else: ?>
                        <li class="user-menu"><a href="/login.php" class="login-link">Login</a></li>
                        <li class="user-menu highlight"><a href="/register.php" class="register-link">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main id="content" class="site-content">