<?php
session_start();

// Check if the guard is not logged in
if (!isset($_SESSION['guard_id'])) {
    header("Location: guard_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Define variables to store form data
$v_name = $v_car_plate_number = $v_reason_to_visit = $v_address_to_visit = "";
$v_time_in = date('Y-m-d H:i:s'); // Get current date and time

// Define variables to store validation errors
$v_name_err = $v_car_plate_number_err = $v_reason_to_visit_err = $v_address_to_visit_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate visitor name
    if (empty(trim($_POST["v_name"]))) {
        $v_name_err = "Please enter the visitor's name.";
    } else {
        $v_name = trim($_POST["v_name"]);
    }

    // Validate car plate number
    if (empty(trim($_POST["v_car_plate_number"]))) {
        $v_car_plate_number_err = "Please enter the visitor's car plate number.";
    } else {
        $v_car_plate_number = trim($_POST["v_car_plate_number"]);
    }

    // Validate reason to visit
    if (empty(trim($_POST["v_reason_to_visit"]))) {
        $v_reason_to_visit_err = "Please enter the reason for the visit.";
    } else {
        $v_reason_to_visit = trim($_POST["v_reason_to_visit"]);
    }

    // Validate address to visit
    if (empty(trim($_POST["v_address_to_visit"]))) {
        $v_address_to_visit_err = "Please enter the address to visit.";
    } else {
        $v_address_to_visit = trim($_POST["v_address_to_visit"]);
    }

    // Check for input errors before inserting into database
    if (empty($v_name_err) && empty($v_car_plate_number_err) && empty($v_reason_to_visit_err) && empty($v_address_to_visit_err)) {
        // Prepare an insert statement
        $query = "INSERT INTO visitors (v_name, v_car_plate_number, v_reason_to_visit, v_address_to_visit, v_time_in) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssss", $v_name, $v_car_plate_number, $v_reason_to_visit, $v_address_to_visit, $v_time_in);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the guard dashboard
                header("Location: guard_dashboard.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Visitor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
            width: 400px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-submit {
            margin-top: 20px;
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
                    <a class="nav-link" href="guard_dashboard.php">Guard Dashboard</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <div class="container">
       
        <h2>Register Visitor</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="v_name">Visitor's Name:</label>
                <input type="text" class="form-control" id="v_name" name="v_name" value="<?php echo $v_name; ?>">
                <span><?php echo $v_name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="v_car_plate_number">Car Plate Number:</label>
                <input type="text" class="form-control" id="v_car_plate_number" name="v_car_plate_number" value="<?php echo $v_car_plate_number; ?>">
                <span><?php echo $v_car_plate_number_err; ?></span>
            </div>
            <div class="form-group">
                <label for="v_reason_to_visit">Reason to Visit:</label>
                <input type="text" class="form-control" id="v_reason_to_visit" name="v_reason_to_visit" value="<?php echo $v_reason_to_visit; ?>">
                <span><?php echo $v_reason_to_visit_err; ?></span>
            </div>
            <div class="form-group">
                <label for="v_address_to_visit">Address to Visit:</label>
                <input type="text" class="form-control" id="v_address_to_visit" name="v_address_to_visit" value="<?php echo $v_address_to_visit; ?>">
                <span><?php echo $v_address_to_visit_err; ?></span>
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Register</button>
        </form>
    </div>
</body>
</html>
