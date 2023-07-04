<?php
session_start();

// Check if the resident is not logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: resident_login.php");
    exit;
}
require_once "db_connection.php";
?>



<!DOCTYPE html>
<html>
<head>
    <title>Resident Dashboard - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .navbar {
            background-color: #343a40 !important;
            padding: 0.75rem 1rem;
        }

        .navbar-brand {
            color: #fff;
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Apartment Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="resident_edit_details.php">Edit Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resident_logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Welcome, Resident!</h2>
        <div>
            <a class="btn btn-primary" href="resident_payment.php">Payment</a>
            <a class="btn btn-primary" href="resident_forum.php">Forums</a>
            <a class="btn btn-primary" href="resident_notification.php">Notification</a>
        </div>
    </div>
</body>
</html>
