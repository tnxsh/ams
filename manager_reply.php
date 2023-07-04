<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the reply and forum ID from the form
    $reply = $_POST['reply'];
    $forumId = $_POST['forum_id'];

    // Connect to the database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the manager's reply into the forum table
    $sql = "UPDATE forums SET manager_reply = '$reply' WHERE forum_id = '$forumId'";
    if (mysqli_query($conn, $sql)) {
        // Close the database connection
        mysqli_close($conn);
        // Redirect to the manage_Management_Forum.php page
        header("Location: manage_Management_Forum.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
