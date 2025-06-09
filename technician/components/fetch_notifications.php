<?php
// filepath: c:\xampp\htdocs\project\technician\components\fetch_notifications.php
session_start();
$technician_id = $_SESSION['technician_id'];
$con = mysqli_connect("localhost", "root", "", "majorproject");

// Join bookings, services, and users for full info
$sql = "SELECT 
            tr.id,
            b.id AS booking_id,
            b.booking_datetime,
            b.status AS booking_status,
            s.servicename AS service_name,
            s.description AS service_description,
            s.price AS service_price,
            s.category AS service_category,
            u.name AS user_name,
            u.email AS user_email,
            u.phone AS user_phone,
            u.address AS user_address,
            u.city AS user_city,
            u.state AS user_state,
            u.zipcode AS user_zipcode
        FROM technician_requests tr
        JOIN bookings b ON tr.booking_id = b.id
        JOIN services s ON b.service_id = s.id
        JOIN users u ON b.customer_email = u.email
        WHERE tr.technician_id = $technician_id AND tr.status = 'pending'
        ORDER BY tr.created_at DESC";

$res = mysqli_query($con, $sql);
$requests = [];
if ($res) {
    while($row = mysqli_fetch_assoc($res)) $requests[] = $row;
}
header('Content-Type: application/json');
echo json_encode($requests);