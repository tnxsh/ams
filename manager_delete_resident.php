<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Check if resident_id is provided
if (isset($_GET['resident_id'])) {
    $residentId = $_GET['resident_id'];

    // Include the database connection file
    require_once "db_connection.php";

    // Delete the resident from the database
    $query = "DELETE FROM residents WHERE resident_id = " . mysqli_real_escape_string($conn, $residentId);
    $result = mysqli_query($conn, $query);

    // Check if the deletion was successful
    if ($result) {
        // Redirect back to the manage_resident page
        header("Location: manage_resident.php");
        exit;
    } else {
        // Handle the error if the deletion failed
        $error = "Failed to delete resident. Please try again.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect back to the manage_resident page if resident_id is not provided
    header("Location: manage_resident.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Resident</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Delete Resident</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php else : ?>
            <div class="alert alert-success">Resident has been deleted successfully.</div>
        <?php endif; ?>
        <a href="manage_resident.php" class="btn btn-primary">Back to Manage Residents</a>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
