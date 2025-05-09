<?php
// Configure session cookie to be accessible to JavaScript
session_set_cookie_params([
    'lifetime' => 0, // Browser session
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => false, // Disabled for XSS demo
    'samesite' => 'Lax'
]);
session_start();
?>