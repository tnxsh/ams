<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manager Dashboard</title>
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

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .card-text {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
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
                    <a class="nav-link" href="manager_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mb-4">Manager Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Residents</h5>
                        <p class="card-text">Manage the apartment residents.</p>
                        <a href="manage_resident.php" class="btn btn-primary btn-block">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Guards</h5>
                        <p class="card-text">Manage the apartment guards.</p>
                        <a href="manage_guard.php" class="btn btn-primary btn-block">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Visitor Report</h5>
                        <p class="card-text">View and manage visitor reports.</p>
                        <a href="manage_visitor_report.php" class="btn btn-primary btn-block">View Report</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Record</h5>
                        <p class="card-text">Manage payment records.</p>
                        <a href="manage_payment_record.php" class="btn btn-primary btn-block">Manage Payments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Forums</h5>
                        <p class="card-text">Manage the management and resident forums.</p>
                        <a href="manage_forums.php" class="btn btn-primary btn-block">Manage Forums</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
