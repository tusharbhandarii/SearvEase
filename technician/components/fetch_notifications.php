<?php
session_start();
$technician_id = $_SESSION['technician_id'];
$con = mysqli_connect("localhost", "root", "", "majorproject");
$res = mysqli_query($con, "SELECT * FROM technician_requests WHERE technician_id=$technician_id AND status='pending'");
$requests = [];
while($row = mysqli_fetch_assoc($res)) $requests[] = $row;
echo json_encode($requests);