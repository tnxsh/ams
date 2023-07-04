<?php
session_start();

// Check if the resident is not logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: resident_login.php");
    exit;
}

// Replace these variables with your actual database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "ams";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch payment information for the resident from the database
$resident_id = $_SESSION['resident_id'];
$sql = "SELECT * FROM payments WHERE resident_id = $resident_id";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) == 0) {
    // Insert a new record in the payments table if no record exists for the resident
    $insertSql = "INSERT INTO payments (resident_id) VALUES ($resident_id)";
    mysqli_query($conn, $insertSql);
}

// Process receipt image upload
if (isset($_POST['submit'])) {
    // Set the upload directory for monthly maintenance fees receipt image
    $mmfUploadDir = "C:/xampp/htdocs/ams/receipt/monthly_maintenance_fees_receipt_image/";

    // Set the upload directory for sinking fund receipt image
    $sfUploadDir = "C:/xampp/htdocs/ams/receipt/sinking_fund_receipt_image/";

    // Get the uploaded file name and temporary file path
    $mmfFileName = $_FILES['mmf_receipt']['name'];
    $mmfTmpFilePath = $_FILES['mmf_receipt']['tmp_name'];

    $sfFileName = $_FILES['sf_receipt']['name'];
    $sfTmpFilePath = $_FILES['sf_receipt']['tmp_name'];

    // Generate a unique file name for the monthly maintenance fees receipt image
    $mmfFileExtension = pathinfo($mmfFileName, PATHINFO_EXTENSION);
    $mmfUniqueFileName = uniqid() . '.' . $mmfFileExtension;

    // Generate a unique file name for the sinking fund receipt image
    $sfFileExtension = pathinfo($sfFileName, PATHINFO_EXTENSION);
    $sfUniqueFileName = uniqid() . '.' . $sfFileExtension;

    // Set the file paths for saving the uploaded receipt images
    $mmfUploadFilePath = $mmfUploadDir . $mmfUniqueFileName;
    $sfUploadFilePath = $sfUploadDir . $sfUniqueFileName;

    // Move the uploaded receipt images to the specified directories
    if (move_uploaded_file($mmfTmpFilePath, $mmfUploadFilePath) && move_uploaded_file($sfTmpFilePath, $sfUploadFilePath)) {
        // Update the payment information in the database with the file paths
        $updateSql = "UPDATE payments SET monthly_maintenance_fees_receipt_image = '$mmfUploadFilePath', sinking_fund_receipt_image = '$sfUploadFilePath' WHERE resident_id = $resident_id";
        mysqli_query($conn, $updateSql);

        $message = "Receipt images uploaded successfully.";
    } else {
        $message = "Failed to upload receipt images.";
    }
}



mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resident Pay Bill - Apartment Management System</title>
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
                    <a class="nav-link" href="resident_paybill.php">Pay Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resident_dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Pay Bill</h2>
        <?php if (isset($message)) { ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data">
            <h3>Monthly Maintenance Fees</h3>
            <div class="form-group">
                <label for="mmf_receipt">Upload Receipt Image:</label>
                <input type="file" class="form-control-file" id="mmf_receipt" name="mmf_receipt" accept="image/*" required>
            </div>
            <h3>Sinking Fund</h3>
            <div class="form-group">
                <label for="sf_receipt">Upload Receipt Image:</label>
                <input type="file" class="form-control-file" id="sf_receipt" name="sf_receipt" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
