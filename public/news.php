<?php
$pageTitle = "Auto Shop News";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/news.css">

<div class="news-page">
    <h1>Auto Shop News</h1>
    
    <div class="news-container">
        <section class="news-section">
            <h2>Latest Updates</h2>
            <div class="news-item">
                <div class="news-date">May 2, 2025</div>
                <h3>New Winter Tire Specials Now Available!</h3>
                <p>Get ready for winter with our exclusive tire packages. Special pricing on all-season and winter tire sets with free installation.</p>
            </div>
            
            <div class="news-item">
                <div class="news-date">April 28, 2025</div>
                <h3>Extended Hours During Holiday Season</h3>
                <p>We're open later to serve you better! From December 15-31, our hours will be 7:30 AM to 8:00 PM daily.</p>
            </div>
            
            <div class="news-item">
                <div class="news-date">April 15, 2025</div>
                <h3>Premium Synthetic Oil Change Package</h3>
                <p>Ask about our new premium package including full synthetic oil, filter replacement, and 21-point inspection.</p>
            </div>
        </section>
        
        <aside class="specials-sidebar">
            <h2>Service Specials</h2>
            <ul class="specials-list">
                <li>
                    <span class="special-title">Winter Tire Changeover</span>
                    <span class="special-discount">15% Off</span>
                </li>
                <li>
                    <span class="special-title">Brake Inspection Special</span>
                    <span class="special-discount">$29.95</span>
                </li>
                <li>
                    <span class="special-title">Full Synthetic Oil Change</span>
                    <span class="special-discount">$69.99</span>
                </li>
                <li>
                    <span class="special-title">A/C System Check</span>
                    <span class="special-discount">Free</span>
                </li>
                <li>
                    <span class="special-title">Student & Senior Discounts</span>
                    <span class="special-discount">10% Off</span>
                </li>
            </ul>
            
            <div class="footer-note">
                <p>© <?= date('Y') ?> PinewoodStore Auto Shop</p>
                <p>Family owned since 1995</p>
            </div>
        </aside>
    </div>
</div>

