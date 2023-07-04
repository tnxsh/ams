<?php
session_start();

// Check if the manager is not logged in
if (!isset($_SESSION['manager_id'])) {
    header("Location: manager_login.php");
    exit;
}

// Check if the resident ID is provided in the URL
if (!isset($_GET['resident_id'])) {
    header("Location: manage_payment_record.php");
    exit;
}

$resident_id = $_GET['resident_id'];

// Include the database connection file
require_once "db_connection.php";

// Retrieve resident details and payment information
$query = "SELECT * FROM residents LEFT JOIN payments ON residents.resident_id = payments.resident_id WHERE residents.resident_id = $resident_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: manage_payment_record.php");
    exit;
}

// Update payment status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['settle_payment'])) {
        $payment_type = $_POST['payment_type'];

        if ($payment_type == 'monthly_maintenance_fees_payment') {
            $payment_status = 'payment_done';
            $query = "UPDATE payments SET monthly_maintenance_fees_payment_status = '$payment_status' WHERE resident_id = $resident_id";
        } elseif ($payment_type == 'sinking_fund_payment') {
            $payment_status = 'payment_done';
            $query = "UPDATE payments SET sinking_fund_payment_status = '$payment_status' WHERE resident_id = $resident_id";
        }

        mysqli_query($conn, $query);
        header("Location: manage_payment.php?resident_id=$resident_id");
        exit;
    } elseif (isset($_POST['unsettle_payment'])) {
        $payment_type = $_POST['payment_type'];

        if ($payment_type == 'monthly_maintenance_fees_payment') {
            $payment_status = 'payment_not_done';
            $query = "UPDATE payments SET monthly_maintenance_fees_payment_status = '$payment_status' WHERE resident_id = $resident_id";
        } elseif ($payment_type == 'sinking_fund_payment') {
            $payment_status = 'payment_not_done';
            $query = "UPDATE payments SET sinking_fund_payment_status = '$payment_status' WHERE resident_id = $resident_id";
        }

        mysqli_query($conn, $query);
        header("Location: manage_payment.php?resident_id=$resident_id");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Payment - Apartment Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        
        .btn-group {
            margin-bottom: 20px;
        }
        .receipt-image {
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
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
        
        <h2>Manage Payment</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Resident Details</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Resident ID</th>
                        <td><?php echo $row['resident_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row['r_name']; ?></td>
                    </tr>
                    <tr>
                        <th>House Number</th>
                        <td><?php echo $row['r_house_number']; ?></td>
                    </tr>
                </table>
            </div>
                            

            
             <div class="row">
            <div class="col-md-6">
                <h4>Monthly Maintenance Fees Receipt Image</h4>
                <?php if ($row['monthly_maintenance_fees_receipt_image']): ?>
<img class="receipt-image" src="receipt/monthly_maintenance_fees_receipt_image/<?php echo $row['monthly_maintenance_fees_receipt_image']; ?>" alt="Receipt Image">
                <?php else: ?>
                    <p>No receipt image uploaded for monthly maintenance fees payment.</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h4>Sinking Fund Receipt Image</h4>
                <?php if ($row['sinking_fund_receipt_image']): ?>
                    <img class="receipt-image" src="receipt/sinking_fund_receipt_image/<?php echo $row['sinking_fund_receipt_image']; ?>" alt="Receipt Image">
                <?php else: ?>
                    <p>No receipt image uploaded for sinking fund payment.</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h4>Payment Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Monthly Maintenance Fees Payment Status</th>
                        <td><?php echo $row['monthly_maintenance_fees_payment_status']; ?></td>
                    </tr>
                    <tr>
                        <th>Sinking Fund Payment Status</th>
                        <td><?php echo $row['sinking_fund_payment_status']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Monthly Maintenance Fees Payment</h4>
                <form method="POST">
                    <input type="hidden" name="payment_type" value="monthly_maintenance_fees_payment">
                    <?php if ($row['monthly_maintenance_fees_payment_status'] == 'payment_done'): ?>
                        <button type="submit" name="unsettle_payment" class="btn btn-danger">Payment Haven't Settled</button>
                    <?php else: ?>
                        <button type="submit" name="settle_payment" class="btn btn-success">Payment Settled</button>
                    <?php endif; ?>
                                                <button type="submit" name="unsettle_payment" class="btn btn-danger">Payment Haven't Settled</button>

                        
                </form>
                
            </div>
            <div class="col-md-6">
                <h4>Sinking Fund Payment</h4>
                <form method="POST">
                    <input type="hidden" name="payment_type" value="sinking_fund_payment">
                    <?php if ($row['sinking_fund_payment_status'] == 'payment_done'): ?>
                        <button type="submit" name="unsettle_payment" class="btn btn-danger">Payment Haven't Settled</button>
                    <?php else: ?>
                        <button type="submit" name="settle_payment" class="btn btn-success">Payment Settled</button>
                    <?php endif; ?>
                        <button type="submit" name="unsettle_payment" class="btn btn-danger">Payment Haven't Settled</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
