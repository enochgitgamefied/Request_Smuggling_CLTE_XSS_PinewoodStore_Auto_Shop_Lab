<?php
$pageTitle = "Leave a Review | PinewoodStore Auto Shop";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/review.css">

<div class="review-hero">
    <div class="hero-content">
        <h1>Share Your Experience</h1>
        <p>Your feedback helps us improve and lets others know about our service</p>
    </div>
</div>

<div class="review-container">
    <form class="review-form" method="POST" action="/submit-review.php">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required placeholder="John Smith">
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="your@email.com">
        </div>
        
        <div class="form-group">
            <label for="vehicle">Vehicle Details</label>
            <input type="text" id="vehicle" name="vehicle" placeholder="Year, Make, Model">
        </div>
        
        <div class="form-group">
            <label for="service">Service Received</label>
            <select id="service" name="service">
                <option value="">Select a service</option>
                <option value="oil_change">Oil Change</option>
                <option value="brakes">Brake Service</option>
                <option value="tires">Tire Service</option>
                <option value="diagnostics">Diagnostics</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Your Rating</label>
            <div class="rating-input">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">★</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="review">Your Review</label>
            <textarea id="review" name="review" rows="5" required placeholder="Tell us about your experience..."></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="cta-button">Submit Review</button>
        </div>
    </form>
    
    <div class="review-guidelines">
        <h3>Review Guidelines</h3>
        <ul>
            <li>Be honest and objective about your experience</li>
            <li>Mention specific services you received</li>
            <li>Avoid personal information or inappropriate language</li>
            <li>Reviews will be posted within 24-48 hours</li>
        </ul>
    </div>
</div>

<?php include_once("footer.php"); ?>