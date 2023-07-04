<?php
session_start();

// Check if the resident is already logged in
if (isset($_SESSION['resident_id'])) {
    header("Location: resident_dashboard.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Define an empty error message
$error = "";

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to retrieve the resident details
    $query = "SELECT * FROM residents WHERE r_username = ? AND r_password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the resident exists and the login credentials are correct
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Set the resident's session variables
        $_SESSION['resident_id'] = $row['resident_id'];
        $_SESSION['r_username'] = $row['r_username'];

        // Redirect to the resident dashboard
        header("Location: resident_dashboard.php");
        exit;
    } else {
        // Display an error message
        $error = "Invalid username or password";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resident Login - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 100px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resident Login</h2>
        <form method="POST" action="resident_login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
            <?php if ($error != "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>
