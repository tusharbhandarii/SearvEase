<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Category - ServeEase Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <!-- Stylesheet for Validation -->
  <style>
      /* Input valid and invalid states */
      input.is-invalid {
          border-color: red;
      }

      input.is-valid {
          border-color: green;
      }

      /* Error message styling */
      .error-message {
          color: red;
          font-size: 0.9em;
          margin-top: 5px;
      }
   </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php

    if (file_exists('../../includes/header.php')) {
        include('../../includes/header.php');
    } else {
        die("Header file not found.");
    }

  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php
      if (file_exists('../../includes/sidebar.php')) {
        include('../../includes/sidebar.php');
      } else {
          die("Sidebar file not found.");
      }
  ?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add Category</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Category</li>
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
                <h3 class="card-title">Add New Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- Form Start -->
              <form method="POST" id="categoryForm">
                <div class="card-body">
                  <!-- Category Name -->
                  <div class="form-group">
                    <label for="categoryName">CATEGORY NAME</label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Enter Category Name" name="name">
                    <span class="error-message" id="categoryNameError"></span>
                  </div>                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <center><input type="submit" value="Submit" name="btn" class="btn btn-primary"></center>
                </div>
              </form>

              <!-- PHP Script for Inserting Category -->
              <?php
              // Corrected the include path for the database connection file
              if (file_exists('../../includes/db_connection.php')) {
                  include('../../includes/db_connection.php');
              } else {
                  die("Database connection file not found.");
              }

              if (isset($_POST['btn'])) {
                  // Retrieve and sanitize user input
                  $name = trim($_POST['name']);

                    // Convert the category name to have only the first letter uppercase
                    $name_upper = ucfirst(strtolower($name));

                  // Use prepared statements to prevent SQL injection
                  $stmt = $con->prepare("INSERT INTO categories (name) VALUES (?)");
                  $stmt->bind_param("s", $name_upper);

                  if ($stmt->execute()) {
                      echo "<script>
                      alert('Data inserted successfully!');
                      window.location.href='add.php';
                      </script>";
                  } else {
                      echo "<script>
                      alert('Data insertion failed!');
                      window.location.href='add.php';
                      </script>";
                  }

                  $stmt->close();
              }
              ?> 
            <!-- /.card -->
          </div>
          <!--/.col (left) -->

          <!-- Right column -->
          <div class="col-md-12">
            <!-- DataTable for Categories -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
            // Ensure the database connection is established
            if (!isset($con)) {
                die("Database connection not established.");
            }

            // Fetch categories from the database
            $selectquery = "SELECT * FROM categories";
            $res = mysqli_query($con, $selectquery);
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><center><a class="btn btn-primary" href="edit.php?q=<?php echo $row['id']; ?>">Edit</a></center></td>
                    <td><center><a class="btn btn-danger" href="delete.php?q=<?php echo $row['id']; ?>">Delete</a></center></td>
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
      </div><!-- /.container-fluid -->
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTables & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page Specific Scripts -->
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
    const form = document.getElementById('categoryForm');

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Get form elements
        const categoryNameInput = document.getElementById('categoryName');

        // Clear previous error messages
        clearErrors();

        // Validate Category Name
        const namePattern = /^[A-Za-z\s]+$/;
        const nameValue = categoryNameInput.value.trim();

        if (nameValue === "") {
            showError(categoryNameInput, 'Category Name is required', 'categoryNameError');
            valid = false;
        } else if (!namePattern.test(nameValue)) {
            showError(categoryNameInput, 'Category Name must contain only letters and spaces', 'categoryNameError');
            valid = false;
        } else {
            markValid(categoryNameInput);
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
