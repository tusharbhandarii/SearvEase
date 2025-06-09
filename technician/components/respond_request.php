<?php
$con = mysqli_connect("localhost", "root", "", "majorproject");
$id = intval($_POST['id']);
$status = $_POST['status'];
mysqli_query($con, "UPDATE technician_requests SET status='$status' WHERE id=$id");
if ($status == 'accepted') {
    // Also update the bookings table to assign this technician
    $res = mysqli_query($con, "SELECT booking_id, technician_id FROM technician_requests WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    mysqli_query($con, "UPDATE bookings SET technician_id={$row['technician_id']}, status='Confirmed' WHERE id={$row['booking_id']}");
}