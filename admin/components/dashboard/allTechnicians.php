<?php
include '../../includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Subcategory</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Custom CSS -->
  <style>
    .error-message {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Navbar -->
  <?php include('../../includes/header.php'); ?>
  <!-- Sidebar -->
  <?php include('../../includes/sidebar.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>Users Information</h1>
      </div>
    </section>

     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Zipcode</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $selectquery = "
                          SELECT *
                          FROM users
                          WHERE 
                              role = 'technician'
                      ";
                      $res = mysqli_query($con, $selectquery);
                      while ($row = mysqli_fetch_assoc($res)) {
                          // Extract date and time from booking_datetime
                        //   $date = date('Y-m-d', strtotime($row['booking_datetime']));
                        //   $time = date('H:i:s', strtotime($row['booking_datetime']));
                  ?>
                      <tr>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['city']; ?></td>
                          <td><?php echo $row['address']; ?></td>
                          <td><?php echo $row['zipcode']; ?></td>
                      </tr>
                  <?php
                      }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

  
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE JS -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- DataTables Initialization -->
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
