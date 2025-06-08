<?php session_start();
    $_SESSION['un'] = "";
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>Guarder</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- Fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- Responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- Header Section -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/hero-bg2.jpg" alt="">
      </div>
    </div>

    <!-- Navbar -->
    <?php include('includes/header2.php'); ?>
    <!-- End Header Section -->
  </div>

  <!-- Contact Section -->
  <?php include 'includes/db_connection.php'; ?>

  <section class="contact_section layout_padding" style="min-height: calc(100vh - 144px); display: flex; align-items: center; justify-content: center; background-image: url('images/login.jpg'); background-size: cover; background-position: center;">
    <div class="container">
      <div class="heading_container heading_center mb-4">
        <h2>Register</h2>
      </div>
      <div class="row d-flex justify-content-around">

      <form class="d-flex justify-content-around" onsubmit="return validateLoginForm()" method="POST">
                    <!-- Registration Form -->
        <div class="col-md-6">
          <div  class="p-3 border rounded shadow-sm">
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm" placeholder="Full Name" name="name" id="name" required>
            </div>
            <div class="mb-3">
              <select class="form-control form-control-sm" name="state" id="state" required>
              <option value="" disabled selected>Select State</option>
              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
              <option value="Andhra Pradesh">Andhra Pradesh</option>
              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
              <option value="Assam">Assam</option>
              <option value="Bihar">Bihar</option>
              <option value="Chandigarh">Chandigarh</option>
              <option value="Chhattisgarh">Chhattisgarh</option>
              <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
              <option value="Delhi">Delhi</option>
              <option value="Goa">Goa</option>
              <option value="Gujarat">Gujarat</option>
              <option value="Haryana">Haryana</option>
              <option value="Himachal Pradesh">Himachal Pradesh</option>
              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
              <option value="Jharkhand">Jharkhand</option>
              <option value="Karnataka">Karnataka</option>
              <option value="Kerala">Kerala</option>
              <option value="Ladakh">Ladakh</option>
              <option value="Lakshadweep">Lakshadweep</option>
              <option value="Madhya Pradesh">Madhya Pradesh</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Manipur">Manipur</option>
              <option value="Meghalaya">Meghalaya</option>
              <option value="Mizoram">Mizoram</option>
              <option value="Nagaland">Nagaland</option>
              <option value="Odisha">Odisha</option>
              <option value="Puducherry">Puducherry</option>
              <option value="Punjab">Punjab</option>
              <option value="Rajasthan">Rajasthan</option>
              <option value="Sikkim">Sikkim</option>
              <option value="Tamil Nadu">Tamil Nadu</option>
              <option value="Telangana">Telangana</option>
              <option value="Tripura">Tripura</option>
              <option value="Uttar Pradesh">Uttar Pradesh</option>
              <option value="Uttarakhand">Uttarakhand</option>
              <option value="West Bengal">West Bengal</option>
              </select>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm" placeholder="City/District/Town" name="city" id="city" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm" placeholder="Pincode" name="pincode" id="pincode" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm" placeholder="Address (Area and Street)" name="address" id="address" required>
            </div>

          </div>
        </div>
        <!-- Login Form -->
        <div class="col-md-6">
          <div class="p-3 border rounded shadow-sm">
            <div class="mb-3">
              <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm" placeholder="10-digit mobile number" name="phno" id="phno" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control form-control-sm" placeholder="Re-enter Password" id="repassword" required>
            </div>
             <!-- Hidden fields for coordinates -->
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            
              <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-success btn-m" name="reg-btn">Register</button>
              </div>
         

          </div>

        </div>
      </form>
      </div>
    </div>
  </section>

  <script>
  // Get user's location and fill the hidden fields
  navigator.geolocation.getCurrentPosition(function(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
  }, function(error) {
    console.log("Location permission denied or not available.");
  });

    function validateLoginForm() {
      const email = document.querySelector("input[name='email']").value.trim();
      const password = document.querySelector("input[name='password']").value.trim();

      if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        alert("Please enter a valid email.");
        return false;
      }

      if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
      }

      return true;
    }
  </script>

      <?php

          if (isset($_POST['reg-btn'])) {
              $name = $_POST['name'];
              $email = $_POST['email'];
              $phno = $_POST['phno'];
              $address = $_POST['address'];
              $city = $_POST['city'];
              $state = $_POST['state'];
              $pincode = $_POST['pincode'];
              $password = $_POST['password'];
              $latitude = $_POST['latitude'];
              $longitude = $_POST['longitude'];
              

              // Insert query without unnecessary empty values
              $insertQuery = "INSERT INTO users (name, email, password, role, phone, address, city, state, zipcode, latitude, longitude) 
                              VALUES ('$name', '$email', '$password', 'customer', '$phno', '$address', '$city', '$state', '$pincode', '$latitude', '$longitude')";

              if (mysqli_query($con, $insertQuery)) {
                  echo "<script>alert('Register Successful'); window.location.href='login.php';</script>";
              } else {
                  echo "<script>alert('Register Unsuccessful'); window.location.href='test.php';</script>";
              }
          }
      ?>

  <!-- Footer Section -->
  <footer class="container-fluid footer_section">
    <p>&copy; <span id="currentYear"></span> All Rights Reserved.</p>
  </footer>

  <script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
  </script>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>