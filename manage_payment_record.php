<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Get residents with payment status from the database
$query = "SELECT residents.resident_id, residents.r_name, residents.r_house_number, payments.monthly_maintenance_fees_payment_status, payments.sinking_fund_payment_status
          FROM residents
          LEFT JOIN payments ON residents.resident_id = payments.resident_id";
$result = mysqli_query($conn, $query);

// Check if there are any residents
if (mysqli_num_rows($result) > 0) {
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $residents = [];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Payment Record - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
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
        
        <h2>Manage Payment Record</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Resident ID</th>
                    <th>Name</th>
                    <th>House Number</th>
                    <th>Monthly Maintenance Payment Status</th>
                    <th>Sinking Fund Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($residents as $resident): ?>
                <tr>
                    <td><?php echo $resident['resident_id']; ?></td>
                    <td><?php echo $resident['r_name']; ?></td>
                    <td><?php echo $resident['r_house_number']; ?></td>
                    <td><?php echo $resident['monthly_maintenance_fees_payment_status']; ?></td>
                    <td><?php echo $resident['sinking_fund_payment_status']; ?></td>
                    <td>
                        <a href="manage_payment.php?resident_id=<?php echo $resident['resident_id']; ?>" class="btn btn-primary">View Details</a>
                    </td>
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
