
<?php
include '../../includes/db_connection.php';

if (isset($_POST['booking_id']) && isset($_POST['technician_id'])) {
    $booking_id = intval($_POST['booking_id']);
    $technician_id = intval($_POST['technician_id']);

    // Check if a pending request already exists for this booking and technician
    $check = mysqli_query($con, "SELECT id FROM technician_requests WHERE booking_id=$booking_id AND technician_id=$technician_id AND status='pending'");
    if (mysqli_num_rows($check) == 0) {
        $sql = "INSERT INTO technician_requests (booking_id, technician_id, status) VALUES ($booking_id, $technician_id, 'pending')";
        mysqli_query($con, $sql);
    }

    // Redirect back to the distance matrix page
    header("Location: distanceMatrix.php?q=$booking_id");
    exit;
} else {
    echo "Invalid request.";
}
?>