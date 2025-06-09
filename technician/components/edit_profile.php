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

// Fetch technician details from users table
$selectquery1 = "SELECT * FROM users WHERE id='$technician_id' AND role='technician'";
$res1 = mysqli_query($con, $selectquery1);
$row1 = mysqli_fetch_assoc($res1);

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

      <section class="about_section layout_padding" style="height: 80.5vh; display: flex; align-items: center; justify-content: center; background-image: url('../../images/login.jpg'); background-size: cover; background-position: center;">
    <div class="container d-flex justify-content-center align-items-center">
      <div class="col-md-8">
        <form method="POST">
          <div class="contact_form-container">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" value="<?php echo htmlspecialchars($row1['name']); ?>" class="form-control" name="name" placeholder="Full Name" required />
              </div>
              <div class="form-group col-md-6">
                <input type="email" value="<?php echo htmlspecialchars($row1['email']); ?>" class="form-control" name="email" placeholder="Email" readonly />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" value="<?php echo htmlspecialchars($row1['phone']); ?>" class="form-control" name="phno" placeholder="Phone Number" />
              </div>
              <div class="form-group col-md-6">
                <input type="text" value="<?php echo htmlspecialchars($row1['city']); ?>" class="form-control" name="city" placeholder="City" />
              </div>
            </div>
            <div class="form-group">
              <input type="text" value="<?php echo htmlspecialchars($row1['zipcode']); ?>" class="form-control" name="pincode" placeholder="Pincode" />
            </div>
            <div class="form-group">
              <input type="text" value="<?php echo htmlspecialchars($row1['address']); ?>" class="form-control" name="address" placeholder="Address" />
            </div>
            <div class="form-group">
              <input type="text" value="<?php echo htmlspecialchars($row1['state']); ?>" class="form-control" name="state" placeholder="State" />
            </div>
            <div class="btn-box text-center">
              <button type="submit" name="btn" class="btn btn-primary">
                Update
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <?php
        if (isset($_POST['btn'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $phno = mysqli_real_escape_string($con, $_POST['phno']);
            $city = mysqli_real_escape_string($con, $_POST['city']);
            $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $state = mysqli_real_escape_string($con, $_POST['state']);

            $editQuery = "UPDATE users SET name='$name', phone='$phno', city='$city', zipcode='$pincode', address='$address', state='$state' WHERE id='$technician_id' AND role='technician'";

            if (mysqli_query($con, $editQuery)) {
                echo "<script>
                    alert('Profile updated successfully!');
                    window.location.href='../index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Something went wrong!');
                </script>";
            }
        }
    ?>

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
