<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- stylesheet for validation  -->
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
  <?php include('navbar.php');
        include 'db_connection2.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('sidebar.php')?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              

            <?php
                        $q = $_GET['q'];
                        $selectquery = "select * from technician where slno='$q' ";
                        $res = mysqli_query($con,$selectquery);
                        $row = mysqli_fetch_assoc($res); 
            ?>

                        <!-- form start -->

            <form id="technicianForm" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <!-- Technician Name -->
                  <div class="form-group">
                    <label for="exampleInputname">Edit Technician Name</label>
                    <input type="text" class="form-control" id="name" placeholder="<?php echo $row['name'];?>" name="name">  
                    <div class="error-message" id="nameError"></div>
                  </div>
                  <!-- Mobile Number -->
                  <div class="form-group">
                    <label for="exampleInputname">Edit Mobile Number</label>
                    <input type="text" class="form-control" id="phno" placeholder="<?php echo $row['phno'];?>" name="phno">
                    <div class="error-message" id="phnoError"></div>
                  </div>
                  <!-- Address -->
                  <div class="form-group">
                    <label for="exampleInputname">Edit Address</label>
                    <input type="text" class="form-control" id="address" placeholder="<?php echo $row['address'];?>" name="address">
                  </div> 
                  <!-- Email address -->
                  <div class="form-group">
                    <label for="exampleInputname">Edit Email address</label>
                    <input type="text" class="form-control" id="email" placeholder="<?php echo $row['email'];?>" name="email">
                    <div class="error-message" id="emailError"></div>
                  </div>
                  <!-- Specialization -->
                  <div class="form-group">
                    <label for="exampleInputname">Edit Specialization</label>
                    <input type="text" class="form-control" id="specialize" placeholder="<?php echo $row['specialize'];?>" name="specialize">
                    <div class="error-message" id="specializeError"></div>
                  </div>  
                  <!-- image -->
                  <div class="form-group">
                      <label for="exampleInputFile">Edit File input</label>
                      <div class="input-group">
                          <div class="custom-file">
                              <input name="image" type="file" class="custom-file-input" id="image">
                              <label class="custom-file-label" for="image"><?php echo $row['image'];?></label>
                          </div>
                          <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                          </div>
                      </div>
                      <div class="error-message" id="imageError"></div>
                  </div>               
                </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <center><input type="submit" value="edit" name="btn" class="btn btn-primary"></center>
                </div>
                
              </form>
              
              <!-- script file  -->
<!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
          const form = document.getElementById('technicianForm');

          form.addEventListener('submit', function (e) {
              let valid = true;

              // Get form elements
              const nameInput = document.getElementById('name');
              const phnoInput = document.getElementById('phno');
              const addressInput = document.getElementById('address');
              const emailInput = document.getElementById('email');
              const specializeInput = document.getElementById('specialize');
              const imageInput = document.getElementById('image');

              // Clear previous error messages
              clearErrors();

              // Validate Name
              const namePattern = /^[a-zA-Z\s]+$/;
              if (!namePattern.test(nameInput.value.trim())) {
                  showError(nameInput, 'Name must contain only letters and spaces', 'nameError');
                  valid = false;
              } else {
                  markValid(nameInput);
              }

              // Validate Mobile Number (10 digits)
              const phonePattern = /^[0-9]{10}$/;
              if (!phonePattern.test(phnoInput.value.trim())) {
                  showError(phnoInput, 'Invalid phone number (must be 10 digits)', 'phnoError');
                  valid = false;
              } else {
                  markValid(phnoInput);
              }

              // Validate Email
              const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
              if (!emailPattern.test(emailInput.value.trim())) {
                  showError(emailInput, 'Invalid email address', 'emailError');
                  valid = false;
              } else {
                  markValid(emailInput);
              }

              // Validate Specialization
              const specializePattern = /^[a-zA-Z\s]+$/;
              if (!specializePattern.test(specializeInput.value.trim())) {
                  showError(specializeInput, 'Specialization must contain only letters and spaces', 'specializeError');
                  valid = false;
              } else {
                  markValid(specializeInput);
              }

              // Validate Image Upload
                  const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif'];
                  const fileType = imageInput.files[0].type;
                  if (!allowedExtensions.includes(fileType)) {
                      showError(imageInput, 'Only JPEG, PNG, or GIF files are allowed', 'imageError');
                      valid = false;
                  } else {
                      markValid(imageInput);
                  }

              // Prevent form submission if invalid
              if (!valid) {
                  e.preventDefault();
              }
          });

          // Helper functions for showing and clearing errors
          function showError(input, message, errorElementId) {
              input.classList.add('is-invalid');
              document.getElementById(errorElementId).innerText = message;
          }

          function markValid(input) {
              input.classList.remove('is-invalid');
              input.classList.add('is-valid');
          }

          function markInvalid(input) {
              input.classList.remove('is-valid');
              input.classList.add('is-invalid');
          }

          function clearErrors() {
              const errorElements = document.querySelectorAll('.error-message');
              errorElements.forEach(el => el.innerText = '');

              const inputs = document.querySelectorAll('input');
              inputs.forEach(input => {
                  input.classList.remove('is-invalid', 'is-valid');
              });
          }
      });
</script> -->
<script>
     document.addEventListener('DOMContentLoaded', function () {
     const form = document.getElementById('technicianForm');

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Get form elements
        const nameInput = document.getElementById('technicianName');
        const phnoInput = document.getElementById('technicianPhno');
        const addressInput = document.getElementById('technicianAddress');
        const emailInput = document.getElementById('technicianEmail');
        const specializeInput = document.getElementById('technicianSpecialize');
        const imageInput = document.getElementById('technicianImage');

        // Clear previous error messages
        clearErrors();

        // Validate fields only if they have been changed
        if (nameInput.value !== nameInput.getAttribute('data-original-value')) {
            const namePattern = /^[a-zA-Z\s]+$/;
            if (!namePattern.test(nameInput.value.trim())) {
                showError(nameInput, 'Name must contain only letters and spaces', 'nameError');
                valid = false;
            } else {
                markValid(nameInput);
            }
        }

        if (phnoInput.value !== phnoInput.getAttribute('data-original-value')) {
            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phnoInput.value.trim())) {
                showError(phnoInput, 'Invalid phone number (must be 10 digits)', 'phnoError');
                valid = false;
            } else {
                markValid(phnoInput);
            }
        }

        if (emailInput.value !== emailInput.getAttribute('data-original-value')) {
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!emailPattern.test(emailInput.value.trim())) {
                showError(emailInput, 'Invalid email address', 'emailError');
                valid = false;
            } else {
                markValid(emailInput);
            }
        }

        if (specializeInput.value !== specializeInput.getAttribute('data-original-value')) {
            const specializePattern = /^[a-zA-Z\s]+$/;
            if (!specializePattern.test(specializeInput.value.trim())) {
                showError(specializeInput, 'Specialization must contain only letters and spaces', 'specializeError');
                valid = false;
            } else {
                markValid(specializeInput);
            }
        }

        if (imageInput.files.length > 0) {
            const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif'];
            const fileType = imageInput.files[0].type;
            if (!allowedExtensions.includes(fileType)) {
                showError(imageInput, 'Only JPEG, PNG, or GIF files are allowed', 'imageError');
                valid = false;
            } else {
                markValid(imageInput);
            }
        }

        // Prevent form submission if invalid
        if (!valid) {
            e.preventDefault();
        }
    });

    // Helper functions for showing and clearing errors
    function showError(input, message, errorElementId) {
        input.classList.add('is-invalid');
        document.getElementById(errorElementId).innerText = message;
    }

    function markValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(el => el.innerText = '');

        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
    }
});

</script>


            <!-- fetching image  -->
            <?php
                  function getExtension($str) 
                  {
                      $i = strrpos($str,".");
                      if (!$i) { return ""; }
                      $l = strlen($str) - $i;
                      $ext = substr($str,$i+1,$l);
                      return $ext;
                  }
                  $errors=0;
                  if(isset($_POST['btn'])) 
                  {
                     $image=$_FILES['image']['name'];
                     if ($image) 
                     {
                       $filename = stripslashes($_FILES['image']['name']);
                        $extension = getExtension($filename);
                       $extension = strtolower($extension);
                          if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "bmp")) 
                       {
                         echo '<h1>Unknown extension!</h1>';
                         $errors=1;
                       }
                       else
                       {
                              $image_name=time().'.'.$extension;
                              $newname="uploadimage/technician/".$image_name;        
                              $copied = copy($_FILES['image']['tmp_name'], $newname);
                              if (!$copied) 
                              {
                                  echo '<h1>Copy unsuccessfull!</h1>';
                                  $errors=1;
                              }
                          }
                      }

                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = ucwords(strtolower($_POST["name"]));
                        // Save the formatted to the database or perform other operations
                      }
                      $phno = $_POST['phno'];
                      $address = $_POST['address'];
                      $email = $_POST['email'];
                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $specialize = ucwords(strtolower($_POST["specialize"]));
                      }

                      // updating the data into the database
                      $editquery = "UPDATE technician SET name='$name',phno='$phno',address='$address',email='$email',image='$image_name', specialize='$specialize' WHERE slno='$q' ";
                      if(mysqli_query($con,$editquery))
                      {
                        echo "<script>alert('data inserted ');window.location.href='AddTechnician.php';</script>";
                      }else{
                        echo "<script>alert('data is not inserted ');window.location.href='AddTechnician.php';</script>";
                      }
                    }
              ?>
  
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->
            
            <!-- /.card -->

            
            <!-- /.card -->

            <!-- general form elements disabled -->
            
            <!-- /.card -->
            <!-- general form elements disabled -->
            
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  <!-- /.content-wrapper -->
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>