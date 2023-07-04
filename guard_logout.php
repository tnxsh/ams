<?php
session_start();

// Check if the guard is logged in
if (!isset($_SESSION['guard_id'])) {
    // Redirect to the guard login page
    header("Location: guard_login.php");
    exit;
}

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the guard login page after logging out
header("Location: guard_login.php");
exit;
?>
