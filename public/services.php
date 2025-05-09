<?php
$pageTitle = "Our Services";
include_once("_header.php");
?>
<link rel="stylesheet" href="css/services.css">

<div class="services-page">
    <div class="services-hero" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/autoshop.png');">
        <div class="hero-content">
            <h1>Professional Auto Services</h1>
            <p>Quality repairs and maintenance for all vehicle makes and models</p>
        </div>
    </div>

    <div class="services-container">
        <div class="service-category">
            <h2>Preventive Maintenance</h2>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-image" style="background-image: url('images/oilchange.png');"></div>
                    <div class="service-content">
                        <h3>Oil Change Service</h3>
                        <p>Keep your engine running smoothly with our premium oil change packages using quality filters and lubricants.</p>
                        <ul>
                            <li>Conventional, synthetic blend, and full synthetic options</li>
                            <li>Includes fluid level checks</li>
                            <li>Complimentary multi-point inspection</li>
                        </ul>
                        <div class="price">From $39.99</div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('images/tires.jpg');"></div>
                    <div class="service-content">
                        <h3>Tire Services</h3>
                        <p>Complete tire care to ensure safety and maximize tread life.</p>
                        <ul>
                            <li>Rotation and balancing</li>
                            <li>Alignment checks</li>
                            <li>Pressure monitoring system service</li>
                        </ul>
                        <div class="price">Rotation: $24.99</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-category">
            <h2>Brake Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-image" style="background-image: url('images/BrakeRotor.png');"></div>
                    <div class="service-content">
                        <h3>Brake Inspection & Repair</h3>
                        <p>Complete brake system service using premium components.</p>
                        <ul>
                            <li>Pad/rotor replacement</li>
                            <li>Caliper service</li>
                            <li>Brake fluid flush</li>
                        </ul>
                        <div class="price">Inspection: Free</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-category">
            <h2>Electrical Systems</h2>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-image" style="background-image: url('images/battery.jpg');"></div>
                    <div class="service-content">
                        <h3>Battery Service</h3>
                        <p>Complete electrical system diagnostics and battery services.</p>
                        <ul>
                            <li>Testing and replacement</li>
                            <li>Terminal cleaning</li>
                            <li>Charging system check</li>
                        </ul>
                        <div class="price">Test: Free</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-category">
            <h2>Engine Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-image" style="background-image: url('images/Engine.png');"></div>
                    <div class="service-content">
                        <h3>Engine Diagnostics</h3>
                        <p>Advanced diagnostics for all engine performance issues.</p>
                        <ul>
                            <li>Computer code scanning</li>
                            <li>Performance troubleshooting</li>
                            <li>Emissions testing</li>
                        </ul>
                        <div class="price">Diagnostic: $89.99</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service-cta">
        <h2>Ready for Professional Auto Service?</h2>
        <a href="/appointment.php" class="cta-button">Schedule an Appointment</a>
    </div>
</div>

<?php include_once("footer.php"); ?>