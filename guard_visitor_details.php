<?php
session_start();

// Check if the guard is not logged in
if (!isset($_SESSION['guard_id'])) {
    header("Location: guard_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Retrieve visitor details from the database
$query = "SELECT visitor_id, v_name, v_car_plate_number, v_reason_to_visit, v_address_to_visit, v_time_in FROM visitors";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $visitor_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guard Visitor Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .table {
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
        <h2>Visitor Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Visitor ID</th>
                    <th>Name</th>
                    <th>Car Plate Number</th>
                    <th>Reason to Visit</th>
                    <th>Address to Visit</th>
                    <th>Time In</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($visitor_details)) : ?>
                    <?php foreach ($visitor_details as $visitor) : ?>
                        <tr>
                            <td><?php echo $visitor['visitor_id']; ?></td>
                            <td><?php echo $visitor['v_name']; ?></td>
                            <td><?php echo $visitor['v_car_plate_number']; ?></td>
                            <td><?php echo $visitor['v_reason_to_visit']; ?></td>
                            <td><?php echo $visitor['v_address_to_visit']; ?></td>
                            <td><?php echo $visitor['v_time_in']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No visitor details found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
