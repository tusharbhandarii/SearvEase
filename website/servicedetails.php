<?php session_start();
include 'includes/db_connection.php';
include 'includes/config.php'; // Include the configuration file


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
  <link rel="shortcut icon" href="images/s_logo.jpg" type="image/x-icon">

  <title>Service Details - ServeEase</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/hero-bg2.jpg" alt="">
      </div>
    </div>

        <!--####################### navbar ######################### -->
        <?php include ('includes/header.php')?>
    <!-- end header section -->
  </div>

  <!-- about section -->
  <?php

        $q = $_GET['q'];
        // $selectquery = "SELECT * FROM services WHERE id = '$q'";
        $selectquery = "
            SELECT 
          services.*, 
          categories.name AS category_name, 
          subcategories.name AS subcategory_name 
            FROM 
          services
            LEFT JOIN 
          categories ON services.category = categories.id
            LEFT JOIN 
          subcategories ON services.subcategory = subcategories.id
            WHERE 
          services.id = '$q'
        ";
        $res = mysqli_query($con, $selectquery);
        $row = mysqli_fetch_assoc($res);              
?>

<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <!-- Service Image Section -->
            <div class="col-md-6">
                <div class="box shadow-sm rounded overflow-hidden">
                    <div class="img-box">
                        <!-- <img src="../admin/uploadimage/servicee/<?php echo $row['image']; ?>" alt="<?php echo $row['servicename']; ?>" class="img-fluid rounded" style="width: 100%; height: auto; max-height: 400px; object-fit: cover;"> -->
                        <img src="<?php echo UPLOAD_IMAGE_PATH . 'servicee/' . $row['image']; ?>" alt="<?php echo $row['servicename']; ?>" class="img-fluid">

                    </div>
                </div>
            </div>
            <!-- Service Details Section -->
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container mb-3">
                        <h2 class="fw-bold">
                            <?php echo $row['servicename']; ?>
                        </h2>
                    </div>
                    <p><strong>Category:</strong> <?php echo $row['category_name']; ?></p>
                    <p><strong>Subcategory:</strong> <?php echo $row['subcategory_name']; ?></p>
                    <p class="mt-3"><?php echo $row['description']; ?></p>
                    <h4 class="text-primary fw-bold mt-4">Rs <?php echo $row['price']; ?></h4>
                    <div class="btn-box mt-3">
                        <a href="confirmbooking.php?q=<?php echo $row['id']; ?>" class="btn btn-primary">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    
  <!-- end about section -->


  <!-- end info_section -->




  <!-- footer section -->
  <footer class="container-fluid footer_section">
    <p>
      &copy; <span id="currentYear"></span> All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </footer>
  <!-- footer section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>