<?php
// filepath: c:\xampp\htdocs\project\technician\components\fetch_notification_count.php
session_start();
$technician_id = $_SESSION['technician_id'] ?? 0;
$con = mysqli_connect("localhost", "root", "", "majorproject");

$sql = "SELECT COUNT(*) AS count
        FROM technician_requests
        WHERE technician_id = $technician_id AND status = 'pending'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode(['count' => $row['count'] ?? 0]);