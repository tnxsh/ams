<?php
session_start();

// Check if the resident is not logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: resident_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Retrieve forum messages
$query = "SELECT * FROM forums";
$result = mysqli_query($conn, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle message submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forumType = $_POST['forum_type'];
    $topic = $_POST['topic'];
    $message = $_POST['message'];
    $resident_id = $_SESSION['resident_id'];

   
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resident Forum - Apartment Management System</title>
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
                <a class="nav-link" href="resident_dashboard.php">Resident Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resident_management_forum.php">Management Forum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resident_resident_forum.php">Resident Forum</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Resident Forum</h2>
    <!-- Display forum messages -->
    <?php foreach ($messages as $message): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $message['forum_type']; ?> - <?php echo $message['Management_Forum_topic']; ?></h5>
                <p class="card-text"><?php echo $message['Management_Forum_message']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
