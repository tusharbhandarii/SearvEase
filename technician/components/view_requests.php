<?php
session_start();
include '../includes/db_connection.php';

// Get the logged-in technician's id
$technician_id = $_SESSION['technician_id'] ?? 0;

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_booking_id'])) {
    $booking_id = intval($_POST['complete_booking_id']);
    mysqli_query($con, "UPDATE bookings SET status='Complete' WHERE id=$booking_id AND technician_id='$technician_id'");
}

// Fetch all bookings allotted to this technician
$query = "
    SELECT 
        b.id AS booking_id,
        b.customer_email,
        b.booking_datetime,
        b.status,
        b.created_at,
        s.servicename,
        s.description,
        s.price,
        s.category,
        u.name AS customer_name,
        u.phone AS customer_phone,
        u.address AS customer_address,
        u.city AS customer_city,
        u.state AS customer_state,
        u.zipcode AS customer_zipcode
    FROM bookings b
    INNER JOIN services s ON b.service_id = s.id
    INNER JOIN users u ON b.customer_email = u.email
    WHERE b.technician_id = '$technician_id'
    ORDER BY b.booking_datetime DESC
";
$res = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Allotted Bookings</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    .error-message { color: red; font-size: 0.9em; }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Navbar -->
  <?php include('../includes/header.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>My Allotted Bookings</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Allotted Bookings</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                      <td><?php echo $row['booking_id']; ?></td>
                      <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                      <td>
                        <?php
                          echo htmlspecialchars($row['customer_address']) . ', ' .
                               htmlspecialchars($row['customer_city']) . ', ' .
                               htmlspecialchars($row['customer_state']) . ' - ' .
                               htmlspecialchars($row['customer_zipcode']);
                        ?>
                      </td>
                      <td><?php echo htmlspecialchars($row['servicename']); ?></td>
                      <td><?php echo htmlspecialchars($row['description']); ?></td>
                      <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
                      <td><?php echo date('Y-m-d H:i', strtotime($row['booking_datetime'])); ?></td>
                      <td>
                        <?php
                          if ($row['status'] == 'Pending') {
                            echo '<span class="badge badge-warning">Pending</span>';
                          } elseif ($row['status'] == 'Confirmed') {
                            echo '<span class="badge badge-info">Confirmed</span>';
                          } elseif ($row['status'] == 'Complete') {
                            echo '<span class="badge badge-success">Complete</span>';
                          } elseif ($row['status'] == 'Cancelled') {
                            echo '<span class="badge badge-danger">Cancelled</span>';
                          } else {
                            echo htmlspecialchars($row['status']);
                          }
                        ?>
                      </td>
                      <td>
                        <?php if ($row['status'] != 'Complete'): ?>
                          <form method="post" style="display:inline;">
                            <input type="hidden" name="complete_booking_id" value="<?php echo $row['booking_id']; ?>">
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Mark this booking as Complete?');">Mark Complete</button>
                          </form>
                        <?php else: ?>
                          <span class="text-success">Completed</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  $(document).ready(function () {
    $('#example1').DataTable({
      responsive: true,
      autoWidth: false,
    });
  });
</script>
</body>
</html>
