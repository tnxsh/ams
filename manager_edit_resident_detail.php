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
if (isset($_GET['id'])) {
    $residentId = $_GET['id'];

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

// Update resident details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $vehicleNumber = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone_number']);

    $updateQuery = "UPDATE residents SET r_name = '$name', r_vehicle_number = '$vehicleNumber', r_email = '$email', r_phone_number = '$phoneNumber' WHERE resident_id = " . mysqli_real_escape_string($conn, $residentId);
    mysqli_query($conn, $updateQuery);

    // Redirect to the resident details page after updating
    header("Location: manager_view_resident_details.php?id=$residentId");
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
    <title>Edit Resident Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

    <!-- Edit Resident Details Form -->
    <div class="container">
        <h2>Edit Resident Details</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $resident['r_name']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number:</label>
                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"
                    value="<?php echo $resident['r_vehicle_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $resident['r_email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="<?php echo $resident['r_phone_number']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
