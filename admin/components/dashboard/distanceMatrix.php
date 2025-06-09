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
        $customer_query = "
            SELECT latitude, longitude, service_id 
            FROM users 
            INNER JOIN bookings ON users.email = bookings.customer_email 
            WHERE bookings.id = $booking_id
        ";
        $customer_result = mysqli_query($con, $customer_query);
        $customer = mysqli_fetch_assoc($customer_result);

        $customer_lat = $customer['latitude'];
        $customer_lng = $customer['longitude'];
        $service_id = $customer['service_id'];

        if (!$customer_lat || !$customer_lng) {
            die("Customer coordinates not found.");
        }

        // Step 2: Get the category and subcategory of the service
        $service_query = "SELECT category, subcategory FROM services WHERE id = $service_id";
        $service_result = mysqli_query($con, $service_query);
        $service = mysqli_fetch_assoc($service_result);

        $category = $service['category'];
        $subcategory = $service['subcategory'];

        if (!$category || !$subcategory) {
            die("Service category or subcategory not found.");
        }

        // Step 3: Find matching technicians based on category, subcategory, and distance
        $query = "
            SELECT 
                users.id, 
                users.name, 
                users.email, 
                users.phone, 
                users.latitude, 
                users.longitude,
                ROUND((6371 * ACOS(
                    COS(RADIANS($customer_lat)) *
                    COS(RADIANS(users.latitude)) *
                    COS(RADIANS(users.longitude) - RADIANS($customer_lng)) +
                    SIN(RADIANS($customer_lat)) *
                    SIN(RADIANS(users.latitude))
                )), 2) AS distance_km
            FROM 
                users
            INNER JOIN 
                technicians ON users.id = technicians.id
            WHERE 
                technicians.category = $category AND 
                technicians.subcategory = $subcategory AND 
                technicians.availability = 'available'
            ORDER BY 
                distance_km
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
                          <td>
                            <center>
                              <form method="POST" action="send_request.php" class="send-request-form" data-techname="<?php echo htmlspecialchars($row['name']); ?>" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                                <input type="hidden" name="technician_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary">Post</button>
                              </form>
                            </center>
                          </td>

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

    // Intercept form submission for send-request-form
    $('.send-request-form').on('submit', function(e) {
      e.preventDefault();
      var techName = $(this).data('techname');
      alert('Request sent to technician: ' + techName);
      this.submit(); // Now submit the form
    });
  });
</script>
</body>
</html>
