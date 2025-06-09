<?php
// filepath: c:\xampp\htdocs\project\technician\view_requests.php
session_start();
include '../includes/db_connection.php';

// Check if technician is logged in
if (!isset($_SESSION['technician_id'])) {
    header("Location: ../website/TechnicianLogin.php");
    exit;
}
$technician_id = $_SESSION['technician_id'];

// Fetch all requests for this technician
$query = "SELECT tr.*, b.service_id, b.status AS booking_status, b.id AS booking_id
          FROM technician_requests tr
          JOIN bookings b ON tr.booking_id = b.id
          WHERE tr.technician_id = $technician_id
          ORDER BY tr.created_at DESC";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Requests</title>
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">My Service Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Booking ID</th>
                <th>Service ID</th>
                <th>Status</th>
                <th>Booking Status</th>
                <th>Requested At</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['service_id']; ?></td>
                    <td>
                        <?php
                            if ($row['status'] == 'pending') {
                                echo '<span class="badge badge-warning">Pending</span>';
                            } elseif ($row['status'] == 'accepted') {
                                echo '<span class="badge badge-success">Accepted</span>';
                            } elseif ($row['status'] == 'rejected') {
                                echo '<span class="badge badge-danger">Rejected</span>';
                            } else {
                                echo htmlspecialchars($row['status']);
                            }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['booking_status']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No requests found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
</div>
</body>
</html>