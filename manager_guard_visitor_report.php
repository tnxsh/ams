<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Fetch all visitor records from the database
$query = "SELECT * FROM visitors";
$result = mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        body {
            
            padding-bottom: 20px;
        }

        .container {
            max-width: 800px;
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


        .table {
            margin-top: 20px;
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
        <h2>Visitor Report</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Visitor ID</th>
                    <th>Name</th>
                    <th>Car Plate Number</th>
                    <th>Reason to Visit</th>
                    <th>Address to Visit</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['visitor_id'] . "</td>";
                    echo "<td>" . $row['v_name'] . "</td>";
                    echo "<td>" . $row['v_car_plate_number'] . "</td>";
                    echo "<td>" . $row['v_reason_to_visit'] . "</td>";
                    echo "<td>" . $row['v_address_to_visit'] . "</td>";
                    echo "<td>" . $row['v_time_in'] . "</td>";
                    echo "<td>" . $row['v_time_out'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
