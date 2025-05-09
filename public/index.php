<?php
$title = "PinewoodStore Auto Shop - Home";
$page = $_SERVER['PHP_SELF'];

// Handle login state - vulnerable implementation (httpOnly false)
$loggedIn = isset($_COOKIE['auth_token']);

include_once("_header.php");
?>
<link rel="stylesheet" href="css/home.css">

<!-- Welcome message for logged in users -->
<?php if ($loggedIn): ?>
    <div class="user-welcome">
        Welcome back! <a href="/account.php">View your account</a> or <a href="/appointment.php">schedule service</a>.
        <span class="user-debug">(Session Token: <?php echo isset($_COOKIE['auth_token']) ? substr($_COOKIE['auth_token'], 0, 10) . '...' : 'None' ?>)</span>
    </div>
<?php endif; ?>

<!-- Gradient Hero Banner -->
<div class="hero-banner">
    <div class="banner-content">
        <h2>Premium Auto Services Since 1995</h2>
        <p>Family-owned shop with factory-trained technicians</p>
        <div class="hero-actions">
            <a href="/appointment.php" class="cta-button">Schedule Service Today</a>
            <?php if (!$loggedIn): ?>
                <a href="/register.php" class="cta-button cta-secondary">New Customer? Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Featured Services Bar -->
<div class="featured-services">
    <div class="service-highlight">
        <div class="service-image" style="background-image: url('images/oilchange.png');"></div>
        <h3>Express Oil Changes</h3>
        <p>15-minute guarantee</p>
        <a href="/services.php#oil" class="service-link">Details</a>
    </div>
    <div class="service-highlight">
        <div class="service-image" style="background-image: url('images/BrakeRotor.png');"></div>
        <h3>Brake Specialists</h3>
        <p>Free inspections</p>
        <a href="/services.php#brakes" class="service-link">Details</a>
    </div>
    <div class="service-highlight">
        <div class="service-image" style="background-image: url('images/tires.jpg');"></div>
        <h3>Tire Services</h3>
        <p>All makes & models</p>
        <a href="/services.php#tires" class="service-link">Details</a>
    </div>
</div>

<!-- Services Gallery Section -->
<div class="services-section">
    <h2 class="section-title">Our Auto Services</h2>
    <div class="service-grid">
        <div class="service-card">
            <div class="service-image" style="background-image: url('images/oilchange.png');"></div>
            <h3>Oil Changes</h3>
            <p>From $29.99 - Keep your engine running smoothly with our premium synthetic blends</p>
            <a href="/services.php#oil" class="learn-more">Learn more →</a>
        </div>
        <div class="service-card">
            <div class="service-image" style="background-image: url('images/BrakeRotor.png');"></div>
            <h3>Brake Service</h3>
            <p>Complete inspection and repair using OEM-quality parts</p>
            <a href="/services.php#brakes" class="learn-more">Learn more →</a>
        </div>
        <div class="service-card">
            <div class="service-image" style="background-image: url('images/tires.jpg');"></div>
            <h3>Tire Services</h3>
            <p>Rotation, balancing, and replacements from top brands</p>
            <a href="/services.php#tires" class="learn-more">Learn more →</a>
        </div>
    </div>
</div>

<!-- About Us Preview -->
<div class="about-preview">
    <div class="about-content">
        <h2>About PinewoodStore Auto Shop</h2>
        <p>Founded in 1995 by John and Sarah Pinewood, our family-owned shop has been serving the community with honest, reliable auto care for over 25 years.</p>
        <div class="shop-image" style="background-image: url('images/autoshop.png');"></div>
        <a href="/about.php" class="cta-button cta-outline">Our Story</a>
    </div>
</div>

<!-- Testimonials -->
<div class="testimonials">
    <h2 class="section-title">What Our Customers Say</h2>
    <div class="testimonial-grid">
        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <p>"Honest pricing and quality work. They've been maintaining my cars for 10 years!"</p>
            <div class="customer">- Michael R.</div>
        </div>
        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <p>"Fixed my brake issue when the dealer couldn't figure it out. Highly recommend!"</p>
            <div class="customer">- Sarah K.</div>
        </div>
    </div>
</div>

<style>
    /* User Welcome Styles */
    .user-welcome {
        background: #036DA7;
        color: white;
        padding: 12px 0;
        text-align: center;
        font-size: 0.95em;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-welcome a {
        color: #BBD9EE;
        text-decoration: none;
        font-weight: 500;
        margin: 0 5px;
    }

    .user-welcome a:hover {
        text-decoration: underline;
    }

    .user-debug {
        display: inline-block;
        margin-left: 15px;
        font-size: 0.8em;
        color: #BBD9EE;
        opacity: 0.7;
    }

    /* Hero Actions Update */
    .hero-actions {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .cta-secondary {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid white;
    }

    .cta-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Responsive Adjustments */
    @media (max-width: 600px) {
        .hero-actions {
            flex-direction: column;
            gap: 12px;
        }

        .hero-actions a {
            width: 100%;
            text-align: center;
        }

        .user-welcome {
            padding: 12px 15px;
            font-size: 0.9em;
        }

        .user-debug {
            display: block;
            margin: 8px 0 0 0;
        }
    }
</style>

<?php include_once("news.php"); ?>
<?php include_once("footer.php"); ?>