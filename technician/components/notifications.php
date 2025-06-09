<?php
session_start();

if (empty($_SESSION['technician_id'])) {
    echo "<script> alert('Please login!');
    window.location.href ='../../website/TechnicianLogin.php'; 
    </script>";
    exit;
}
include '../includes/db_connection.php';

$technician_id = $_SESSION['technician_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">


  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

  <?php 
  include '../includes/header.php';
  ?>

  <!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->


<div id="notifications" style="margin: 30px auto; max-width: 600px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 24px;">
  <div id="notifications-empty" style="text-align:center; color:#888; font-size:18px;">No notifications available.</div>
</div>
<script>
function fetchNotifications() {
  fetch('fetch_notifications.php')
    .then(res => res.json())
    .then(data => {
      let html = '';
      if (data.length === 0) {
        document.getElementById('notifications-empty').style.display = 'block';
      } else {
        document.getElementById('notifications-empty').style.display = 'none';
        data.forEach(req => {
          html += `<div style="border-bottom:1px solid #eee; padding:16px 0; display:flex; flex-direction:column;">
            <div><strong>Service:</strong> ${req.service_name} (${req.service_category})</div>
            <div><strong>Description:</strong> ${req.service_description}</div>
            <div><strong>Price:</strong> ₹${req.service_price}</div>
            <div><strong>Booking Date & Time:</strong> ${req.booking_datetime}</div>
            <div><strong>User:</strong> ${req.user_name} (${req.user_email}, ${req.user_phone})</div>
            <div><strong>Address:</strong> ${req.user_address}, ${req.user_city}, ${req.user_state} - ${req.user_zipcode}</div>
            <div style="margin-top:8px;">
              <button style="margin-right:8px;" class="btn btn-success btn-sm" onclick="respond(${req.id}, 'accepted')">Accept</button>
              <button class="btn btn-danger btn-sm" onclick="respond(${req.id}, 'rejected')">Reject</button>
            </div>
          </div>`;
        });
      }
      document.getElementById('notifications').querySelectorAll('div:not(#notifications-empty)').forEach(e => e.remove());
      document.getElementById('notifications').insertAdjacentHTML('beforeend', html);
    });
}

function respond(requestId, status) {
  fetch('respond_request.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `id=${requestId}&status=${status}`
  }).then(() => fetchNotifications());
}
setInterval(fetchNotifications, 3000); // Poll every 3 seconds
fetchNotifications();
</script>





    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
