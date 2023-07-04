<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Fetch the resident details from the database
if (isset($_GET['resident_id'])) {
    $residentId = $_GET['resident_id'];

    $query = "SELECT * FROM residents WHERE resident_id = " . mysqli_real_escape_string($conn, $residentId);
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $resident = mysqli_fetch_assoc($result);
    } else {
        header("Location: manage_resident.php");
        exit;
    }
} else {
    header("Location: manage_resident.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
          body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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

        .container {
            margin-top: 2rem;
        }

        .resident-details {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 5px;
        }

        .resident-details h2 {
            margin-bottom: 1.5rem;
        }

        .resident-details .form-group {
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Apartment Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manager_dashboard.php">Manager Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Resident Details -->
    <div class="container details">
        <h2>Resident Details</h2>
        <div class="row">
            <div class="col-md-4">ID:</div>
            <div class="col-md-8"><?php echo $resident['resident_id']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">House Number:</div>
            <div class="col-md-8"><?php echo $resident['r_house_number']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Address:</div>
            <div class="col-md-8"><?php echo $resident['r_address']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Username:</div>
            <div class="col-md-8"><?php echo $resident['r_username']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Name:</div>
            <div class="col-md-8"><?php echo $resident['r_name']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Vehicle Number:</div>
            <div class="col-md-8"><?php echo $resident['r_vehicle_number']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Email:</div>
            <div class="col-md-8"><?php echo $resident['r_email']; ?></div>
        </div>
        <div class="row">
            <div class="col-md-4">Phone Number:</div>
            <div class="col-md-8"><?php echo $resident['r_phone_number']; ?></div>
        </div>
        <a href="manager_edit_resident_detail.php?id=<?php echo $resident['resident_id']; ?>" class="btn btn-primary">Edit Details</a>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
