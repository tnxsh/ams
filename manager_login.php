<?php
session_start();

// Check if the manager is already logged in
if (isset($_SESSION['manager_id'])) {
    header("Location: manager_dashboard.php");
    exit;
}

// Include the database connection file
include 'db_connection.php';

// Define variables for error handling
$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the username
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required";
    } else {
        $username = $_POST['username'];
    }

    // Validate the password
    if (empty($_POST['password'])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST['password'];
    }

    // Proceed if there are no validation errors
    if (empty($usernameErr) && empty($passwordErr)) {
        // Prepare the SQL statement to check the credentials
        $stmt = $conn->prepare("SELECT manager_id FROM managers WHERE manager_username = ? AND manager_password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        // If the manager is found, set session and redirect to dashboard
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($manager_id);
            $stmt->fetch();

            // Set the session variables
            $_SESSION['manager_id'] = $manager_id;

            // Redirect to the manager dashboard
            header("Location: manager_dashboard.php");
            exit;
        } else {
            // Show error message if login fails
            $loginErr = "Invalid username or password";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manager Login</title>
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

<body>
    <div class="container">
        <h2>Manager Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                <span class="error"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <span class="error"><?php echo $loginErr; ?></span>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>
