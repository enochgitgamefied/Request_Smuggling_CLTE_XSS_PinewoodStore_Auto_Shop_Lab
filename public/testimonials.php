<?php
$pageTitle = "Customer Testimonials | PinewoodStore Auto Shop";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/testimonials.css">

<div class="testimonials-hero">
    <div class="hero-content">
        <h1>Hear From Our Satisfied Customers</h1>
        <p>For over 25 years, we've been earning trust one vehicle at a time</p>
    </div>
</div>

<div class="testimonials-container">
    <section class="testimonials-intro">
        <h2>Real Stories From Real Customers</h2>
        <p>At PinewoodStore Auto Shop, customer satisfaction is our top priority. Don't just take our word for it -
            read what our valued customers have to say about their experiences with our team.</p>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">4.9</div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">Vehicles Serviced</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">95%</div>
                <div class="stat-label">Repeat Customers</div>
            </div>
        </div>
    </section>

    <div class="testimonial-grid">
        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <h3>Exceptional Brake Service</h3>
            <p>"I brought my car in for a brake issue that two other shops couldn't fix. The team at PinewoodStore
                diagnosed the problem immediately and had me back on the road the same day. Their knowledge and
                professionalism are unmatched!"</p>
            <div class="customer-info">
                <div class="customer-name">Michael R.</div>
                <div class="customer-vehicle">2018 Toyota Camry</div>
                <div class="service-date">Service Date: 05/15/2023</div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <h3>Trustworthy Oil Changes</h3>
            <p>"As a single mom, I appreciate how PinewoodStore never tries to upsell me on services I don't need.
                Their express oil change is fast, affordable, and they always explain everything clearly. I've been taking
                all our family vehicles here for years."</p>
            <div class="customer-info">
                <div class="customer-name">Sarah K.</div>
                <div class="customer-vehicle">2015 Honda Odyssey</div>
                <div class="service-date">Service Date: 06/22/2023</div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <h3>Saved Me From Costly Repairs</h3>
            <p>"When my check engine light came on, the dealer quoted me $1200 for repairs. PinewoodStore found it was
                just a loose gas cap and didn't charge me a dime for the diagnosis. Their honesty keeps me coming back."</p>
            <div class="customer-info">
                <div class="customer-name">James T.</div>
                <div class="customer-vehicle">2017 Ford F-150</div>
                <div class="service-date">Service Date: 04/10/2023</div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="rating">★★★★★</div>
            <h3>Emergency Repair Heroes</h3>
            <p>"When my alternator died right before a road trip, PinewoodStore stayed late to get it replaced. They
                could have charged me double for the after-hours service, but they didn't. That's the kind of integrity
                you rarely find these days."</p>
            <div class="customer-info">
                <div class="customer-name">Lisa M.</div>
                <div class="customer-vehicle">2019 Subaru Outback</div>
                <div class="service-date">Service Date: 08/05/2023</div>
            </div>
        </div>
    </div>


    <section class="leave-review">
        <h2>Share Your Experience</h2>
        <p>Had a great experience with our service? We'd love to hear about it!</p>
        <a href="/review.php" class="cta-button">Leave a Review</a>
    </section>
</div>

<?php include_once("footer.php"); ?>