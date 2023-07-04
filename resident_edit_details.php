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

// Fetch resident information from the database
$resident_id = $_SESSION['resident_id'];
$sql = "SELECT r_name, r_vehicle_number, r_email, r_phone_number FROM residents WHERE resident_id = $resident_id";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $r_name = $row['r_name'];
    $r_vehicle_number = $row['r_vehicle_number'];
    $r_email = $row['r_email'];
    $r_phone_number = $row['r_phone_number'];
} else {
    // Handle error if resident information not found
    $r_name = "N/A";
    $r_vehicle_number = "N/A";
    $r_email = "N/A";
    $r_phone_number = "N/A";
}

// Handle form submission for updating resident details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated details from the form
    $updatedName = $_POST['name'];
    $updatedVehicleNumber = $_POST['vehicle_number'];
    $updatedEmail = $_POST['email'];
    $updatedPhoneNumber = $_POST['phone_number'];

    // Update the resident details in the database
    $updateSql = "UPDATE residents SET r_name = '$updatedName', r_vehicle_number = '$updatedVehicleNumber', r_email = '$updatedEmail', r_phone_number = '$updatedPhoneNumber' WHERE resident_id = $resident_id";
    if (mysqli_query($conn, $updateSql)) {
        // Redirect to the resident dashboard after successful update
        header("Location: resident_dashboard.php");
        exit;
    } else {
        // Handle error if update query fails
        $errorMessage = "Failed to update resident details. Please try again.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Resident Details - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .navbar {
            justify-content: flex-end;
        }
        .navbar-nav .nav-link {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="resident_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resident_logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h2>Edit Resident Details</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $r_name; ?>">
            </div>
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number:</label>
                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?php echo $r_vehicle_number; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $r_email; ?>">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $r_phone_number; ?>">
            </div>
            <?php if (isset($errorMessage)) { ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
