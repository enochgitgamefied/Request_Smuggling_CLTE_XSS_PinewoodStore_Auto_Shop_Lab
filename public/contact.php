<?php
$title = "Contact";
$page = $_SERVER['PHP_SELF'];

include_once("_header.php");

// Process both GET and POST requests (vulnerable code preserved)
$name = $_REQUEST['name'] ?? '';
$content = $_REQUEST['content'] ?? '';

// Reflect unsanitized input (XSS vulnerability)
if ($name || $content) {
    echo "<div class='vulnerable-preview'>";
    echo "<h2>Message Sent Preview</h2>";
    echo "<p><strong>Name:</strong> $name</p>"; // Vulnerable output
    echo "<p><strong>Message:</strong> $content</p>"; // Vulnerable output
    echo "</div>";
}
?>

<link rel="stylesheet" href="css/contact.css">

<div class="contact-page">
    <div class="contact-hero">
        <h1>Contact PinewoodStore</h1>
        <p>Get in touch with our auto service experts</p>
    </div>

    <div class="contact-container">
        <div class="contact-info">
            <div class="info-card">
                <h3><i class="icon">📍</i> Our Location</h3>
                <p>123 Auto Service Road<br>Pinewood, CA 90210</p>
            </div>

            <div class="info-card">
                <h3><i class="icon">🕒</i> Business Hours</h3>
                <p>Mon-Fri: 7:30AM - 6:00PM<br>
                    Sat: 8:00AM - 4:00PM<br>
                    Sun: Closed</p>
            </div>

            <div class="info-card">
                <h3><i class="icon">📞</i> Contact Info</h3>
                <p>Phone: (555) 123-4567<br>
                    Email: service@pinewoodstore.com</p>
            </div>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>

            <form action="<?= $page ?>" method="get">
                <div class="form-group">
                    <label>Your Name:</label>
                    <input type="text" name="name" value="<?= $name ?: 'Your Name' ?>"> <!-- XSS vulnerable -->
                </div>

                <div class="form-group">
                    <label>Your Message:</label>
                    <textarea name="content" rows="5"><?= $content ?: 'Your message here...' ?></textarea> <!-- XSS vulnerable -->
                </div>

                <div class="form-actions">
                    <input type="submit" value="Submit" class="btn-submit">
                </div>
            </form>
        </div>
    </div>

    <div class="map-section">
        <h2>Find Us</h2>
        <div class="map-container">
            <!-- Vulnerable if image source comes from user input -->
            <img src="images/autoshop.png" alt="Our location">
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>