<?php
require_once 'config.php'; // Contains the session config above

$title = "PinewoodStore Auto Shop - Login";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=mysql;dbname=pinewood_autoshop", "root", "secret");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Set auth_token cookie (non-HttpOnly)
            $token = bin2hex(random_bytes(32));
            setcookie('auth_token', $token, [
                'expires' => time() + 86400 * 30,
                'path' => '/',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => false, // Disabled for XSS demo
                'samesite' => 'Lax'
            ]);

            // Store token in database
            $stmt = $pdo->prepare("INSERT INTO auth_sessions (user_id, token) VALUES (?, ?)");
            $stmt->execute([$user['id'], $token]);

            header('Location: /account.php');
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } catch (PDOException $e) {
        $error = "Database error";
    }
}

include_once("_header.php");
?>
<!-- Rest of your HTML form -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="/images/autoshop.png" alt="PinewoodStore Auto Shop">
                <h2>Customer Login</h2>
                <p>Access your service history and appointments</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required
                        placeholder="your@email.com"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        placeholder="••••••••">
                </div>

                <div class="auth-actions">
                    <button type="submit" class="cta-button">Sign In</button>
                </div>
            </form>

            <div class="auth-footer">
                <p>New customer? <a href="/register.php">Create an account</a></p>
                <p><a href="/forgot-password.php">Forgot your password?</a></p>
            </div>
        </div>
    </div>

    <?php include_once("footer.php"); ?>
</body>

</html>