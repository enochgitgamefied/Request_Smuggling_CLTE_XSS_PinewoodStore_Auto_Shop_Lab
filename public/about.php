<?php
$pageTitle = "About Us";
include_once("_header.php");
?>

<!-- Add this line to include the separate CSS file -->
<link rel="stylesheet" href="css/aboutus.css">

<div class="aboutus-container">
    <h1 class="aboutus-main-title">About PinewoodStore Auto Shop</h1>

    <div class="aboutus-shop-section">
        <div class="aboutus-shop-text">
            <h2 class="aboutus-section-title">Our Story</h2>
            <p>Founded in 1995 by enoch and Sarah Pinewood, our family-owned auto shop has been serving the community for nearly three decades. What started as a small two-bay garage has grown into a full-service automotive center with 8 service bays and state-of-the-art equipment.</p>

            <p>We take pride in our honest approach to auto repair - you'll never get unnecessary services recommended at PinewoodStore. Our team of certified technicians receives ongoing training to stay current with the latest automotive technologies.</p>

            <h2 class="aboutus-section-title">Our Facility</h2>
            <p>Visit our 10,000 sq. ft. facility at 123 Main Street, featuring:</p>
            <ul class="aboutus-features-list">
                <li>Climate-controlled service bays</li>
                <li>Advanced diagnostic equipment</li>
                <li>Comfortable customer lounge</li>
                <li>Free shuttle service</li>
            </ul>
        </div>

        <div class="aboutus-shop-image-container">
            <div class="aboutus-shop-image" style="background-image: url('images/autoshop.png');">
                <div class="aboutus-image-caption">Our Main Location on 123 Main Street</div>
            </div>
        </div>
    </div>

    <div class="aboutus-values">
        <h2 class="aboutus-section-title">Our Values</h2>
        <div class="aboutus-values-grid">
            <div class="aboutus-value-card">
                <h3>Honesty</h3>
                <p>We provide straightforward recommendations you can trust</p>
            </div>
            <div class="aboutus-value-card">
                <h3>Quality</h3>
                <p>Using premium parts and proper repair techniques</p>
            </div>
            <div class="aboutus-value-card">
                <h3>Community</h3>
                <p>Proudly serving our neighbors since 1995</p>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>