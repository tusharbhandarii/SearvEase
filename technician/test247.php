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

    <!-- End Header Section -->
  </div>

























<?php
        // Database connection
        include 'includes/db_connection.php';

        // Step 1: Get customer coordinates
        $customer_query = " SELECT latitude,longitude FROM users WHERE id = 5 ";
        $customer_result = mysqli_query($con, $customer_query);
        $customer = mysqli_fetch_assoc($customer_result);

        $customer_lat = $customer['latitude'];
        $customer_lng = $customer['longitude'];

        if (!$customer_lat || !$customer_lng) {
            die("Customer coordinates not found.");
        }


        $query = "SELECT id, name, email, phone, latitude, longitude,
                        (6371 * ACOS(
                            COS(RADIANS($customer_lat)) *
                            COS(RADIANS(latitude)) *
                            COS(RADIANS(longitude) - RADIANS($customer_lng)) +
                            SIN(RADIANS($customer_lat)) *
                            SIN(RADIANS(latitude))
                        )) AS distance_km
                    FROM users
                    WHERE role = 'technician'
                    ORDER BY distance_km
                    LIMIT 10
        ";

        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Technician: {$row['name']} - {$row['distance_km']} km<br>";
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