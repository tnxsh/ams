<?php
session_start();

// Check if the guard is not logged in
if (!isset($_SESSION['guard_id'])) {
    header("Location: guard_login.php");
    exit;
}

// Check if the visitor ID is provided
if (!isset($_GET['visitor_id'])) {
    header("Location: guard_visitor_details.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Retrieve the visitor ID from the URL parameter
$visitor_id = $_GET['visitor_id'];

// Get the current date and time
$current_time = date("Y-m-d H:i:s");

// Update the visitor's time out in the database
$query = "UPDATE visitors SET v_time_out = '$current_time' WHERE visitor_id = $visitor_id";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    header("Location: guard_visitor_details.php");
    exit;
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close the database connection
mysqli_close($conn);
?>
