<!DOCTYPE html>
<html>
<head>
    <title>Manage Forums - Apartment Management System</title>
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
        
        
        <h2>Forums</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Access Management Forum</h4>
                <a href="manage_Management_Forum.php" class="btn btn-primary">Access Management Forum</a>
            </div>
            <div class="col-md-6">
                <h4>Access Resident Forum</h4>
                <a href="manage_resident_Forum.php" class="btn btn-primary">Access Resident Forum</a>
            </div>
        </div>
    </div>
</body>
</html>
