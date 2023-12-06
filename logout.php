<?php
// Check if the logout request is sent
// Set the expiration date to one hour ago
if (isset($_COOKIE['auth_token'])) {
  setcookie('auth_token', '', time() - 3600, '/');
}

// Redirect to the login page or home page after logout
header('Location: /login.php');
