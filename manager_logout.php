<?php
session_start();

// Check if the manager is logged in
if (!isset($_SESSION['manager_id'])) {
    // Redirect to the manager login page
    header("Location: manager_login.php");
    exit;
}

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the manager login page after logging out
header("Location: manager_login.php");
exit;
?>
