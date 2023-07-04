<!DOCTYPE html>
<html>
<head>
    <title>Manage Resident Forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
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
        <h2>Resident Forum</h2>

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

        // Retrieve the resident forum discussions from the database
        $sql = "SELECT * FROM forums";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $topic = $row['Resident_Forum_topic'];
                $message = $row['Resident_Forum_message'];
                $residentId = $row['resident_id'];
                $postedOn = $row['posted_on'];

                // Display the forum discussion details
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Topic: $topic</h5>";
                echo "<p class='card-text'>Message: $message</p>";
                echo "<p class='card-text'>Resident ID: $residentId</p>";
                echo "<p class='card-text'>Posted On: $postedOn</p>";
                echo "</div>";
                echo "</div>";
                echo "<br>";
            }
        } else {
            echo "No forum discussions found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
