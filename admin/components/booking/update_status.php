<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Booking Status - ServeEase Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <!-- Stylesheet for Validation -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include('navbar.php');
        include 'db_connection2.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('sidebar.php')?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add Subcategory</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Subcategory</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left column -->
          <div class="col-md-12">
            <!-- General form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Subcategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- Form Start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <!-- Category Selection -->
                  <div class="form-group">
                    <label for="categorySelect">Status</label>
                    <select class="form-control" id="categorySelect" name="status1" required>
                      <option value="">Select Status</option>
                      <option value="Order Booked">Order Booked</option>
                      <option value="Order Complete">Order Complete</option>
                    </select>
                    <span class="error-message" id="categoryError"></span>
                  </div>


                <!-- /.card-body -->

                <div class="card-footer">
                  <center><input type="submit" value="Submit" name="btn" class="btn btn-primary"></center>
                </div>
              </form>
              <?php
                            $q=$_GET['q'];
                            if(isset($_POST['btn'])){
                            $status1=$_POST['status1'];
                            $editquery = "UPDATE booking SET status='$status1' WHERE bookingid='$q' ";
                            if(mysqli_query($con, $editquery))
                            {
                                echo "<script>
                                alert('status updated !! ');window.location.href='AllBooking.php';</script>";
                            }
                            else
                            {
                            echo "<script>
                            alert('status is not updated !! ');window.location.href='AllBooking.php';</script>";
                            }
                        }
                        
            ?> 

          
    </section>

    <!-- Additional Content Sections (if any) -->
    <section class="content">
      <div class="container-fluid">
        <!-- Add more content here if needed -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- JavaScript for Form Validation -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('subcategoryForm');

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Get form elements
        const categorySelect = document.getElementById('categorySelect');
        const subcategoryInput = document.getElementById('subcategoryInput');

        // Clear previous error messages
        clearErrors();

        // Validate Category Selection
        if (categorySelect.value === "") {
            showError(categorySelect, 'Please select a category.', 'categoryError');
            valid = false;
        } else {
            markValid(categorySelect);
        }

        // Validate Subcategory Name
        const subcategoryValue = subcategoryInput.value.trim();
        const namePattern = /^[A-Za-z\s]+$/; // Only letters and spaces

        if (subcategoryValue === "") {
            showError(subcategoryInput, 'Subcategory name is required.', 'subcategoryError');
            valid = false;
        } else if (!namePattern.test(subcategoryValue)) {
            showError(subcategoryInput, 'Subcategory name must contain only letters and spaces.', 'subcategoryError');
            valid = false;
        } else {
            markValid(subcategoryInput);
        }

        // If the form is invalid, prevent submission
        if (!valid) {
            e.preventDefault();
        }
    });

    // Helper functions for showing and clearing errors
    function showError(input, message, errorElementId) {
        input.classList.add('is-invalid');
        const errorElement = document.getElementById(errorElementId);
        if (errorElement) {
            errorElement.innerText = message;
        }
    }

    function markValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(el => el.innerText = '');

        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
    }
  });
</script>
</body>
</html>
