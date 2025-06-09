<?php
session_start();
$technician_id = $_SESSION['technician_id'];
?>
<div id="notifications"></div>
<script>
function fetchNotifications() {
  fetch('fetch_notifications.php')
    .then(res => res.json())
    .then(data => {
      let html = '';
      data.forEach(req => {
        html += `<div>
          New service request for booking #${req.booking_id}
          <button onclick="respond(${req.id}, 'accepted')">Accept</button>
          <button onclick="respond(${req.id}, 'rejected')">Reject</button>
        </div>`;
      });
      document.getElementById('notifications').innerHTML = html;
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