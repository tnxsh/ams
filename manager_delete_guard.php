<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Check if guard_id is provided
if (!isset($_GET['guard_id'])) {
    header("Location: manage_guard.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Get the guard_id from the query string
$guard_id = $_GET['guard_id'];

// Delete the guard from the database
$query = "DELETE FROM guards WHERE guard_id = $guard_id";
$result = mysqli_query($conn, $query);

// Check if the delete operation was successful
if ($result) {
    header("Location: manage_guard.php");
    exit;
} else {
    echo "Error deleting guard. Please try again.";
}

// Close the database connection
mysqli_close($conn);
?>
