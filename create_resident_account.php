<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Define variables to hold form input values
$houseNumber = $address = $username = $password = "";
$errorMsg = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $houseNumber = $_POST["house_number"];
    $address = $_POST["address"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the form data
    if (empty($houseNumber) || empty($address) || empty($username) || empty($password)) {
        $errorMsg = "Please fill in all the fields.";
    } else {
        // Insert the resident into the database
        $query = "INSERT INTO residents (r_house_number, r_address, r_username, r_password) VALUES ('$houseNumber', '$address', '$username', '$password')";
        if (mysqli_query($conn, $query)) {
            header("Location: manage_resident.php");
            exit;
        } else {
            $errorMsg = "Failed to create resident account. Please try again.";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Resident Account</title>
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

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 5px;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .error-msg {
            color: #dc3545;
            margin-top: 0.5rem;
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

    <div class="container">
        <div class="form-container">
            <h2>Create Resident Account</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="house_number">House Number:</label>
                    <input type="text" class="form-control" id="house_number" name="house_number"
                        value="<?php echo $houseNumber; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo $address; ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
                <div class="error-msg"><?php echo $errorMsg; ?></div>
            </form>
        </div>
    </div>

    <script src="bootstrap.min.js"></script>
</body>

</html>
