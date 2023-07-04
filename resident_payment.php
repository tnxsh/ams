<?php
session_start();

// Check if the resident is not logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: resident_login.php");
    exit;
}

// Replace these variables with your actual database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "ams";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch payment status for the resident from the database
$resident_id = $_SESSION['resident_id'];
$sql = "SELECT monthly_maintenance_fees_payment_status, sinking_fund_payment_status FROM payments WHERE resident_id = $resident_id";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $monthly_maintenance_fees_payment_status = $row['monthly_maintenance_fees_payment_status'];
    $sinking_fund_payment_status = $row['sinking_fund_payment_status'];
} else {
    // Set default payment status if not found in the database
    $monthly_maintenance_fees_payment_status = "Payment Haven't Settled";
    $sinking_fund_payment_status = "Payment Haven't Settled";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resident Payment - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
            padding-top: 60px;
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
                    <a class="nav-link" href="resident_paybill.php">Pay Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resident_dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Payment Status</h2>
        <h3>Monthly Maintenance Fees:</h3>
        <p><?php echo $monthly_maintenance_fees_payment_status; ?></p>
        <h3>Sinking Fund:</h3>
        <p><?php echo $sinking_fund_payment_status; ?></p>
    </div>
</body>
</html>
