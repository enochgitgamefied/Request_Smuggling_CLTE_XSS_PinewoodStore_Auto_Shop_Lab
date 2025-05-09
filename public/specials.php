<?php
$pageTitle = "Current Specials";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/specials.css">

<div class="specials-page">
    <h1>Current Specials</h1>
    
    <div class="promo-grid">
        <div class="promo-card">
            <div class="promo-badge">HOT DEAL</div>
            <h3>Oil Change Package</h3>
            <p class="price">$29.99 <span class="original">$49.99</span></p>
            <ul>
                <li>Full synthetic oil</li>
                <li>New oil filter</li>
                <li>Fluid check</li>
            </ul>
            <button class="book-btn">Book Now</button>
        </div>
        
        <!-- Add more promo cards as needed -->
    </div>
</div>

<?php include_once("footer.php"); ?>