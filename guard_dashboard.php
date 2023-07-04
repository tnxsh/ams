<?php
session_start();

// Check if the guard is not logged in
if (!isset($_SESSION['guard_id'])) {
    header("Location: guard_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Check if the exit button is clicked
if (isset($_POST['exit'])) {
    $visitor_id = $_POST['visitor_id'];

    // Update the v_time_out column with the current date and time
    $query = "UPDATE visitors SET v_time_out = NOW() WHERE visitor_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $visitor_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guard Dashboard - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 100px;
        }
        .form-group {
            margin-bottom: 20px;
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
                    <a class="nav-link" href="register_visitor.php">Register Visitor</a>
                </li>
                <li class="nav-item">
                                <a class="navbar-brand" href="guard_logout.php">Log Out</a>

                </li>
                
            </ul>
        </div>
    </nav>
    <div class="container">
        
        <h2>Guard Dashboard</h2>
        <h4>Visitor Details</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Visitor ID</th>
                    <th>Name</th>
                    <th>Car Plate Number</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT visitor_id, v_name, v_car_plate_number, v_time_in, v_time_out FROM visitors";
                $result = mysqli_query($conn, $query);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $visitor_id = $row['visitor_id'];
                    $v_name = $row['v_name'];
                    $v_car_plate_number = $row['v_car_plate_number'];
                    $v_time_in = $row['v_time_in'];
                    $v_time_out = $row['v_time_out'];
                    
                    echo "<tr>";
                    echo "<td>$visitor_id</td>";
                    echo "<td>$v_name</td>";
                    echo "<td>$v_car_plate_number</td>";
                    echo "<td>$v_time_in</td>";
                    echo "<td>$v_time_out</td>";
                    
                    // Check if the visitor has already exited
                    if ($v_time_out == null) {
                        echo "<td>
                                <form method='POST' action='guard_dashboard.php'>
                                    <input type='hidden' name='visitor_id' value='$visitor_id'>
                                    <button type='submit' name='exit' class='btn btn-danger'>Exit</button>
                                </form>
                              </td>";
                    } else {
                        echo "<td>Exited</td>";
                    }
                    
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
