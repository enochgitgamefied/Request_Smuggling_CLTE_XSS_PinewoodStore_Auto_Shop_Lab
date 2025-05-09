<?php
require_once 'config.php';

// Delete auth token from database if exists
if (isset($_COOKIE['auth_token'])) {
    try {
        $pdo = new PDO("mysql:host=mysql;dbname=pinewood_autoshop", "root", "secret");
        $stmt = $pdo->prepare("DELETE FROM auth_sessions WHERE token = ?");
        $stmt->execute([$_COOKIE['auth_token']]);
    } catch (PDOException $e) {
        error_log("Logout error: " . $e->getMessage());
    }

    // Delete auth_token cookie
    setcookie('auth_token', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => false,
        'samesite' => 'Lax'
    ]);
}

// Destroy session
$_SESSION = [];
session_destroy();

// Delete session cookie
setcookie(session_name(), '', [
    'expires' => time() - 3600,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => false,
    'samesite' => 'Lax'
]);

header("Location: /login.php");
exit;
