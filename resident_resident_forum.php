<?php
session_start();

// Check if the resident is not logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: resident_login.php");
    exit;
}

// Include the database connection file
require_once "db_connection.php";

// Retrieve forum messages and replies
$query = "SELECT * FROM forums LEFT JOIN managers ON forums.resident_id = managers.manager_id";
$result = mysqli_query($conn, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle forum submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forumType = $_POST['forum_type'];
    $topic = $_POST['topic'];
    $message = $_POST['message'];
    $resident_id = $_SESSION['resident_id'];

    // Insert the new message into the database
    $query = "INSERT INTO forums (forum_type, Management_Forum_topic, Management_Forum_message, Resident_Forum_topic, Resident_Forum_message, manager_reply, resident_id) VALUES ('$forumType', '', '', '$topic', '$message', '', '$resident_id')";
    mysqli_query($conn, $query);

    // Refresh the page to display the new message
    header("Location: resident_resident_forum.php");
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
                <h5 class="card-title"><?php echo $message['forum_type']; ?> - <?php echo $message['Resident_Forum_topic']; ?></h5>
                <p class="card-text"><?php echo $message['Resident_Forum_message']; ?></p>
                <?php if (!empty($message['manager_reply'])): ?>
                    <div class="card">
                        <div class="card-header">Manager Reply</div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $message['manager_reply']; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Create a new forum message -->
    <h3>Create New Forum Message</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="forumType">Forum Type:</label>
            <select class="form-control" id="forumType" name="forum_type">
                <option value="Management Forum">Management Forum</option>
                <option value="Resident Forum">Resident Forum</option>
            </select>
        </div>
        <div class="form-group">
            <label for="topic">Topic:</label>
            <input type="text" class="form-control" id="topic" name="topic" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
