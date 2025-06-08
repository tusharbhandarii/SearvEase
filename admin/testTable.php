<?php
    include '../../includes/db_connection.php';
    $booking_id = $_GET['q'];
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
        <h1>Technician Allotment</h1>
      </div>
    </section>
    <?php
        // Step 1: Get customer coordinates
        $customer_query = " SELECT latitude,longitude FROM users WHERE email = (SELECT customer_email FROM bookings WHERE id = $booking_id) ";
        $customer_result = mysqli_query($con, $customer_query);
        $customer = mysqli_fetch_assoc($customer_result);

        $customer_lat = $customer['latitude'];
        $customer_lng = $customer['longitude'];

        if (!$customer_lat || !$customer_lng) {
            die("Customer coordinates not found.");
        }


        $query = "SELECT id, name, email, phone, latitude, longitude,
                ROUND((6371 * ACOS(
                    COS(RADIANS($customer_lat)) *
                    COS(RADIANS(latitude)) *
                    COS(RADIANS(longitude) - RADIANS($customer_lng)) +
                    SIN(RADIANS($customer_lat)) *
                    SIN(RADIANS(latitude))
                )), 2) AS distance_km
                FROM users
                WHERE role = 'technician' 
                ORDER BY distance_km
                LIMIT 5
        ";

        // $result = mysqli_query($con, $query);
        // while ($row = mysqli_fetch_assoc($result)) {
        //     echo "Technician:   {$row['name']} - {$row['distance_km']} km<br>";
        // }

?>

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
                    <th>Email</th>
                    <th>Name</th>
                    <th>Distance</th>
                    <th>Request</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                      $result = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                      <tr>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['distance_km']; ?> km</td>
                          <td><center><a class="btn btn-primary" href="#?q=<?php echo $row['id'];?>">Post</a></center></td>

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

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                 
                  </tfoot>
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