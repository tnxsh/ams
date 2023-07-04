<?php
session_start();

// Unset and destroy the resident session
unset($_SESSION['resident_id']);
unset($_SESSION['r_username']);
session_destroy();

// Redirect to the resident login page
header("Location: resident_login.php");
exit;
?>
