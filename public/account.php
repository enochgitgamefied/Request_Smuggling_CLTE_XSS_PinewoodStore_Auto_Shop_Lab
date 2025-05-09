<?php
// Start session with non-HttpOnly cookie for XSS demo
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => false,
    'samesite' => 'Lax'
]);
session_start();

// Initialize variables
$authenticated = false;
$user_id = null;
$user = null;
$pdo = null;

// Database configuration
$dbHost = 'mysql';
$dbName = 'pinewood_autoshop';
$dbUser = 'root';
$dbPass = 'secret';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check session authentication
    if (isset($_SESSION['user_id'])) {
        $authenticated = true;
        $user_id = $_SESSION['user_id'];
    }
    // Check cookie authentication if session doesn't exist
    elseif (isset($_COOKIE['auth_token'])) {
        $stmt = $pdo->prepare("SELECT user_id FROM auth_sessions WHERE token = ?");
        $stmt->execute([$_COOKIE['auth_token']]);
        $result = $stmt->fetch();

        if ($result) {
            $authenticated = true;
            $user_id = $result['user_id'];
            // Renew session
            $_SESSION['user_id'] = $user_id;
        }
    }

    // Redirect if not authenticated
    if (!$authenticated) {
        header("Location: /login.php");
        exit;
    }

    // Get user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        // User not found in database - force logout
        session_destroy();
        setcookie('auth_token', '', time() - 3600, '/');
        header("Location: /login.php");
        exit;
    }
} catch (PDOException $e) {
    error_log("Database error in account.php: " . $e->getMessage());
    // You might want to show a user-friendly error message
    die("A database error occurred. Please try again later.");
}

$title = "My Account | PinewoodStore Auto Shop";
include_once("_header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        /* Your existing CSS styles */
        :root {
            --primary: #036DA7;
            --secondary: #e74c3c;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --gray: #7f8c8d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .account-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .account-header {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            padding: 40px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .account-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 30px;
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary);
        }

        .account-info h1 {
            margin: 0;
            font-size: 2rem;
        }

        .account-info p {
            margin: 5px 0 0;
            opacity: 0.9;
        }

        .account-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .account-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .account-card h2 {
            color: var(--primary);
            margin-top: 0;
            border-bottom: 2px solid var(--light);
            padding-bottom: 10px;
        }

        .vehicle-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .vehicle-icon {
            font-size: 2rem;
            margin-right: 15px;
            color: var(--secondary);
        }

        .service-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .service-item:last-child {
            border-bottom: none;
        }

        .service-date {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .cta-button {
            display: inline-block;
            background: var(--secondary);
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        .cta-button:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .account-grid {
                grid-template-columns: 1fr;
            }

            .account-header {
                flex-direction: column;
                text-align: center;
            }

            .account-avatar {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="account-container">
        <?php if (isset($_SESSION['just_registered'])): ?>
            <div class="welcome-message">
                <h2>Welcome to PinewoodStore, <?= htmlspecialchars($user['name']) ?>!</h2>
                <p>Thank you for registering with us.</p>
            </div>
            <?php unset($_SESSION['just_registered']); ?>
        <?php endif; ?>

        <div class="account-header">
            <div class="account-avatar">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>
            <div class="account-info">
                <h1>Welcome, <?= htmlspecialchars($user['name']) ?></h1>
                <p>Member since <?= date('F Y', strtotime($user['created_at'])) ?></p>
            </div>
        </div>

        <div class="account-grid">
            <div>
                <div class="account-card">
                    <h2>Account Details</h2>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

                    <div class="vehicle-info">
                        <div class="vehicle-icon">
                            🚗
                        </div>
                        <div>
                            <h3>Primary Vehicle</h3>
                            <p><?= !empty($user['vehicle_info']) ? htmlspecialchars($user['vehicle_info']) : 'Not specified' ?></p>
                        </div>
                    </div>

                    <a href="/update-account.php" class="cta-button">Update Info</a>
                </div>

                <div class="account-card" style="margin-top: 30px;">
                    <h2>Quick Actions</h2>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 10px;"><a href="/appointment.php" style="color: var(--primary); text-decoration: none;">📅 Schedule Service</a></li>
                        <li style="margin-bottom: 10px;"><a href="/services.php" style="color: var(--primary); text-decoration: none;">🔧 View Services</a></li>
                        <li style="margin-bottom: 10px;"><a href="/testimonials.php" style="color: var(--primary); text-decoration: none;">⭐ Leave Review</a></li>
                        <li><a href="/logout.php" style="color: var(--secondary); text-decoration: none;">🚪 Logout</a></li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="account-card">
                    <h2>Recent Services</h2>

                    <?php if (!empty($services)): ?>
                        <?php foreach ($services as $service): ?>
                            <div class="service-item">
                                <h3><?= htmlspecialchars($service['service_type']) ?></h3>
                                <p><?= htmlspecialchars($service['comments']) ?></p>
                                <p class="service-date"><?= date('F j, Y', strtotime($service['service_date'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                        <a href="/service-history.php" class="cta-button">View Full History</a>
                    <?php else: ?>
                        <p>No recent services found.</p>
                        <a href="/appointment.php" class="cta-button">Schedule Your First Service</a>
                    <?php endif; ?>
                </div>

                <div class="account-card" style="margin-top: 30px; background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                    <h2>Special Offer</h2>
                    <p>As a valued customer, enjoy 10% off your next oil change!</p>
                    <p><strong>Use code:</strong> PINE10</p>
                    <a href="/appointment.php?service=oil_change" class="cta-button">Redeem Now</a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("footer.php"); ?>
</body>

</html>