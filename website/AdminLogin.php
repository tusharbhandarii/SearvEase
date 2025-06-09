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

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Ensure the footer sticks to the bottom */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .sub_page {
      flex: 1;
    }

    .footer_section {
      background-color: #444;
      color: white;
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section starts -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/hero-bg2.jpg" alt="">
      </div>
    </div>

    <!-- Navbar -->
    <?php include('includes/header2.php'); ?>
    <!-- end header section -->
  </div>

  <!-- Contact Section -->
  <?php include 'includes/db_connection.php'; ?>

  <section class="contact_section layout_padding" style="min-height: calc(100vh - 124px); display: flex; align-items: center; justify-content: center; background-image: url('images/login.jpg'); background-size: cover; background-position: center;">
    <div class="container">
      <div class="heading_container heading_center mb-4">
        <h2>Admin Login</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <form method="POST" class="p-3 border rounded shadow-sm" onsubmit="return validateForm()">
            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email</label>
              <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Password</label>
              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-success btn-sm" name="btn">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script>
    function validateForm() {
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
  if (isset($_POST['btn'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $logincheck = "SELECT * FROM admin WHERE email='$email' ";
      $rescheck = mysqli_query($con, $logincheck);

      if ($rescheck && mysqli_num_rows($rescheck) > 0) {
          $row = mysqli_fetch_assoc($rescheck);
          if ($row['password'] === $password) { // Use password_verify() if passwords are hashed
              $_SESSION['un'] = $email;
              echo "<script>
                  alert('Successful login');
                  window.location.href='../admin/index.php';
              </script>";
          } else {
              echo "<script>
                  alert('Incorrect password');
                  window.location.href='AdminLogin.php';
              </script>";
          }
      } else {
          echo "<script>
              alert('Email not found');
              window.location.href='AdminLogin.php';
          </script>";
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