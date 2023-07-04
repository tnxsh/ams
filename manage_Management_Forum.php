<!DOCTYPE html>
<html>
<head>
    <title>Manage Management Forum - Apartment Management System</title>
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
       
        <h2>Management Forum</h2>
        <?php
        // Connect to the database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "ams";
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch and display forum discussions
        $sql = "SELECT * FROM forums";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Topic: " . $row['Management_Forum_topic'] . "</h5>";
                echo "<p class='card-text'>Message: " . $row['Management_Forum_message'] . "</p>";
                echo "<p class='card-text'>Posted by Resident ID: " . $row['resident_id'] . "</p>";
                echo "<p class='card-text'>Posted on: " . $row['posted_on'] . "</p>";
                echo "<form action='manager_reply.php' method='post'>";
                echo "<div class='form-group'>";
                echo "<label for='reply'>Reply:</label>";
                echo "<textarea class='form-control' name='reply' id='reply' rows='3'></textarea>";
                echo "</div>";
                echo "<input type='hidden' name='forum_id' value='" . $row['forum_id'] . "'>";
                echo "<button type='submit' class='btn btn-primary'>Reply</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No discussions found.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
