<?php
include '../../includes/db_connection.php';
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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
  <?php include('../../includes/header.php'); ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

  <!-- Sidebar -->
  <?php include('../../includes/sidebar.php'); ?>

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Technician</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Technician</li>
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
                <h3 class="card-title">Add New Technician</h3>
              </div>
              <!-- /.card-header -->






            <!-- form start -->
            <form id="technicianForm" method='post' enctype="multipart/form-data">
              <div class="card-body">
              <!-- name -->
              <div class="form-group">
                  <label for="exampleInputName">Technician Name</label>
                  <input name="name" type="text" class="form-control" id="name" placeholder="Enter name">
                  <div class="error-message" id="nameError"></div>
              </div>
              <!-- email -->
              <div class="form-group">
                  <label for="exampleInputEmail">Email address</label>
                  <input name="email" type="text" class="form-control" id="email" placeholder="Enter email">
                  <div class="error-message" id="emailError"></div>
              </div>
              <!-- ph no -->
              <div class="form-group">
                  <label for="exampleInputPhno">Mobile Number</label>
                  <input name="phno" type="text" class="form-control" id="phno" placeholder="Enter number">
                  <div class="error-message" id="phnoError"></div>
              </div>
              <!-- address -->
              <div class="form-group">
                  <label for="exampleInputAddress">Address</label>
                  <input name="address" type="text" class="form-control" id="address" placeholder="Enter address">
                  <div class="error-message" id="addressError"></div>
              </div>

              <!-- State -->
              <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                  <option value="">Select State</option>
                  <option value="Andhra Pradesh">Andhra Pradesh</option>
                  <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                  <option value="Assam">Assam</option>
                  <option value="Bihar">Bihar</option>
                  <option value="Chhattisgarh">Chhattisgarh</option>
                  <option value="Goa">Goa</option>
                  <option value="Gujarat">Gujarat</option>
                  <option value="Haryana">Haryana</option>
                  <option value="Himachal Pradesh">Himachal Pradesh</option>
                  <option value="Jharkhand">Jharkhand</option>
                  <option value="Karnataka">Karnataka</option>
                  <option value="Kerala">Kerala</option>
                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                  <option value="Maharashtra">Maharashtra</option>
                  <option value="Manipur">Manipur</option>
                  <option value="Meghalaya">Meghalaya</option>
                  <option value="Mizoram">Mizoram</option>
                  <option value="Nagaland">Nagaland</option>
                  <option value="Odisha">Odisha</option>
                  <option value="Punjab">Punjab</option>
                  <option value="Rajasthan">Rajasthan</option>
                  <option value="Sikkim">Sikkim</option>
                  <option value="Tamil Nadu">Tamil Nadu</option>
                  <option value="Telangana">Telangana</option>
                  <option value="Tripura">Tripura</option>
                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                  <option value="Uttarakhand">Uttarakhand</option>
                  <option value="West Bengal">West Bengal</option>
                  <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                  <option value="Chandigarh">Chandigarh</option>
                  <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                  <option value="Delhi">Delhi</option>
                  <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                  <option value="Ladakh">Ladakh</option>
                  <option value="Lakshadweep">Lakshadweep</option>
                  <option value="Puducherry">Puducherry</option>
                </select>
                <div class="error-message" id="stateError"></div>
              </div>

              <!-- City -->
              <div class="form-group">
                <label for="exampleInputCity">City</label>
                <input name="city" type="text" class="form-control" id="city" placeholder="Enter city">
                <div class="error-message" id="cityError"></div>
              </div>

              <!-- Zipcode -->
              <div class="form-group">
                <label for="exampleInputZipcode">Zipcode</label>
                <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="Enter zipcode">
                <div class="error-message" id="zipcodeError"></div>
              </div>

              <!-- Category -->
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" onchange="fetchSubcategories()">
                      <option value="">Select Category</option>
                      <?php
                      $selectquery = "SELECT * FROM categories";
                      $res = mysqli_query($con, $selectquery);
                      while ($row = mysqli_fetch_assoc($res)) {
                          echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                      }
                      ?>
                    </select>
                    <span class="error-message" id="categoryError"></span>
                  </div>

                  <!-- Subcategory -->
                  <div class="form-group">
                    <label for="subcategory">Subcategory</label>
                    <select class="form-control" id="subcategory" name="subcategory">
                      <option value="">Select Subcategory</option>
                    </select>
                    <span class="error-message" id="subcategoryError"></span>
                  </div>
              
               <!-- latitude -->
               <div class="form-group">
                  <label for="exampleInputSpecialize">Latitude</label>
                  <input name="latitude" type="text" class="form-control"  placeholder="Enter latitude">
                  <div class="error-message" id="specializeError"></div>
              </div>

               <!-- longitude -->
               <div class="form-group">
                  <label for="exampleInputSpecialize">longitude</label>
                  <input name="longitude" type="text" class="form-control placeholder="Enter longitude">
                  <div class="error-message" id="specializeError"></div>
              </div>

              <!-- image -->
              <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                      <div class="custom-file">
                          <input name="image" type="file" class="custom-file-input" id="image">
                          <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                      </div>
                  </div>
                  <div class="error-message" id="imageError"></div>
              </div>

              <!-- submit button -->
              <div class="card-footer">
                  <center><button name="btn" type="submit" class="btn btn-primary">Submit</button></center> 
              </div>
            </form>

            <!-- script file  -->
<script>
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
        if (nameInput.value.trim() === "") {
            showError(nameInput, 'Name is required', 'nameError');
            valid = false;
        } else if (!namePattern.test(nameInput.value.trim())) {
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

        // Validate Address
        if (addressInput.value.trim() === "") {
            showError(addressInput, 'Address is required', 'addressError');
            valid = false;
        } else {
            markValid(addressInput);
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
        if (specializeInput.value.trim() === "") {
            showError(specializeInput, 'Specialization is required', 'specializeError');
            valid = false;
        } else if (!specializePattern.test(specializeInput.value.trim())) {
            showError(specializeInput, 'Specialization must contain only letters and spaces', 'specializeError');
            valid = false;
        } else {
            markValid(specializeInput);
        }

        // Validate Image Upload
        const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif'];
        if (imageInput.files.length === 0) {
            showError(imageInput, 'Image file is required', 'imageError');
            valid = false;
        } else {
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

</script>


                <?php
                if (isset($_POST['btn'])) {
                    // Step 1: Insert into the `users` table
                    $name = ucwords(strtolower($_POST["name"]));
                    $email = $_POST['email'];
                    $phno = $_POST['phno'];
                    $address = $_POST['address'];
                    $state = $_POST['state'];
                    $city = $_POST['city'];
                    $zipcode = $_POST['zipcode'];
                    $latitude = $_POST['latitude'];
                    $longitude = $_POST['longitude'];

                    // Generate a random 6-character password
                    function generateRandomPassword($length = 6) {
                        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Letters
                        $numbers = '0123456789'; // Numbers
                        $characters = $letters . $numbers; // Combine letters and numbers

                        // Ensure at least one letter and one number
                        $password = $letters[rand(0, strlen($letters) - 1)] . $numbers[rand(0, strlen($numbers) - 1)];

                        // Fill the remaining length with random characters
                        for ($i = 2; $i < $length; $i++) {
                            $password .= $characters[rand(0, strlen($characters) - 1)];
                        }

                        // Shuffle the password to randomize the order
                        return str_shuffle($password);
                    }
                    $randomPassword = generateRandomPassword();

                    // Handle image upload
                    $image = $_FILES['image']['name'];
                    $image_name = "";
                    if ($image) {
                        $image_name = time() . '_' . $image;
                        $target = "../../uploadimage/technicians/" . $image_name;
                        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                            echo "<script>alert('Image upload failed!');</script>";
                            $image_name = "";
                        }
                    }

                    $insertUserQuery = "INSERT INTO users (name, email, password, role, phone, address, city, state, zipcode, latitude, longitude) 
                                        VALUES ('$name', '$email', '$randomPassword', 'technician', '$phno', '$address','$city', '$state',  '$zipcode', '$latitude', '$longitude')";

                    if (mysqli_query($con, $insertUserQuery)) {
                        // Get the last inserted user ID
                        $user_id = mysqli_insert_id($con);

                        // Step 2: Insert into the `technician` table
                        $category = $_POST['category'];
                        $subcategory = $_POST['subcategory'];
                        $availability = 'unavailable'; // Default availability

                        $insertTechnicianQuery = "INSERT INTO technicians (id, category, subcategory, availability) 
                                                  VALUES ('$user_id', '$category', '$subcategory', '$availability')";

                        if (mysqli_query($con, $insertTechnicianQuery)) {
                            echo "<script>alert('Technician added successfully! Password: $randomPassword');window.location.href='add.php';</script>";
                        } else {
                            echo "<script>alert('Failed to add technician details!');window.location.href='add.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Failed to add user!');window.location.href='add.php';</script>";
                    }
                }
                ?>





            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->


          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Technician List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Specialize</th>
                  </tr>
                  </thead>
                  <tbody>


     
            <?php
                $selectquery="select * from users where role='technician'";
                $res=mysqli_query($con,$selectquery);
                while($row=mysqli_fetch_assoc($res))
                {
            ?>
                    <tr> 
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><center><a class="btn btn-danger" href="delete.php?q=<?php echo $row['id'];?>">Delete</a></center></td>

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

    <!-- /.content -->
  </div>
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  function fetchSubcategories() {
    const categoryId = document.getElementById('category').value;

    // Clear the subcategory dropdown
    const subcategorySelect = document.getElementById('subcategory');
    subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

    if (categoryId) {
      // Make an AJAX request to fetch subcategories
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'fetch_subcategories.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Populate the subcategory dropdown with the response
          subcategorySelect.innerHTML = xhr.responseText;
        }
      };
      xhr.send('category=' + categoryId);
    }
  }
</script>
</body>
</html>
