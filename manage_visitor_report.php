<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Get the visitors from the database
$query = "SELECT * FROM visitors";
$result = mysqli_query($conn, $query);

// Check if there are any visitors
if (mysqli_num_rows($result) > 0) {
    $visitors = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $visitors = [];
}

// Function to filter visitors by date
function filterVisitorsByDate($visitors, $date) {
    $filteredVisitors = [];
    
    foreach ($visitors as $visitor) {
        $timeIn = strtotime($visitor['v_time_in']);
        $visitorDate = date('Y-m-d', $timeIn);
        
        if ($visitorDate == $date) {
            $filteredVisitors[] = $visitor;
        }
    }
    
    return $filteredVisitors;
}

// Check if filter date is provided
if (isset($_GET['filter_date'])) {
    $filterDate = $_GET['filter_date'];
    $visitors = filterVisitorsByDate($visitors, $filterDate);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Visitor Report - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
           
                        

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
                    <a class="nav-link" href="manager_dashboard.php">Manager Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
        <div class="container">
        <h2>Visitor Report</h2>
        <div class="form-group mt-4">
            <form method="GET" action="manage_visitor_report.php">
                <label for="filter_date">Filter by Date:</label>
                <input type="date" id="filter_date" name="filter_date" class="form-control" value="<?php echo isset($filterDate) ? $filterDate : ''; ?>">
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
        </div>
        <table class="table table-bordered mt-4">
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
                <?php foreach ($visitors as $visitor): ?>
                <tr>
                    <td><?php echo $visitor['visitor_id']; ?></td>
                    <td><?php echo $visitor['v_name']; ?></td>
                    <td><?php echo $visitor['v_car_plate_number']; ?></td>
                    <td><?php echo $visitor['v_reason_to_visit']; ?></td>
                    <td><?php echo $visitor['v_address_to_visit']; ?></td>
                    <td><?php echo $visitor['v_time_in']; ?></td>
                    <td><?php echo $visitor['v_time_out']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
