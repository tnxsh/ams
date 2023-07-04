<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Fetch all residents from the database
$query = "SELECT * FROM residents";
$result = mysqli_query($conn, $query);

// Check if any residents are found
$residents = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $residents[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Residents</title>
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

        .resident-table {
            margin-top: 2rem;
        }

        .resident-table th,
        .resident-table td {
            padding: 0.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
                    <a class="nav-link" href="create_resident_account.php">Create Resident Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_dashboard.php">Manager Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center">Manage Residents</h2>

        <table class="table table-striped resident-table">
            <thead>
                <tr>
                    <th>Resident ID</th>
                    <th>House Number</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($residents) > 0) : ?>
                    <?php foreach ($residents as $resident) : ?>
                        <tr>
                            <td><?php echo $resident['resident_id']; ?></td>
                            <td><?php echo $resident['r_house_number']; ?></td>
                            <td><?php echo $resident['r_name']; ?></td>
                            <td>
                                <a href="manager_view_resident_details.php?resident_id=<?php echo $resident['resident_id']; ?>"
                                    class="btn btn-primary">View Details</a>
                                <a href="manager_delete_resident.php?resident_id=<?php echo $resident['resident_id']; ?>"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">No residents found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

   
</body>

</html>
