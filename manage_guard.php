<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Fetch all guards from the database
$query = "SELECT * FROM guards";
$result = mysqli_query($conn, $query);

// Check if there are guards in the database
if (mysqli_num_rows($result) > 0) {
    $guards = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $guards = [];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Guards</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        body {
           
            padding-bottom: 20px;
        }

        .container {
            max-width: 600px;
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

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn {
            font-size: 0.9rem;
        }

        .alert {
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
                    <a class="nav-link" href="create_guard_account.php">Create Resident Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_dashboard.php">Manager Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Manage Guards</h2>
        <?php if (!empty($guards)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guards as $guard) : ?>
                        <tr>
                            <td><?php echo $guard['guard_id']; ?></td>
                            <td><?php echo $guard['g_username']; ?></td>
                            <td><?php echo $guard['g_name']; ?></td>
                            <td>
                                <a href="manager_guard_visitor_report.php?id=<?php echo $guard['guard_id']; ?>" class="btn btn-primary btn-sm">Visitor Report</a>
                                <a href="manager_delete_guard.php?id=<?php echo $guard['guard_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-info">No guards found.</div>
        <?php endif; ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
