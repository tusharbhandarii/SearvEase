<?php
session_start();
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
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>Guarder</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <style>
    /* Create a square container for the image */
    .square-image-container {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
    }
    .square-image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    <!-- Include the header -->
    <?php include('includes/header.php'); ?>
    <!-- end header section -->
  </div>

  <!-- service section -->
  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Our services</h2>
      </div>

      <div class="row">
        <?php
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
        ";
        $res = mysqli_query($con, $selectquery);

        while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            <div class="card-img-top">
              <div class="square-image-container">
                <img src="<?php echo UPLOAD_IMAGE_PATH . 'servicee/' . $row['image']; ?>" alt="<?php echo $row['servicename']; ?>" class="img-fluid">
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title"><strong><?php echo $row['servicename']; ?></strong> </h5>
              <p class="card-text">
                <?php echo $row['category_name']; ?><br>
                <?php echo $row['subcategory_name']; ?>
              </p>
              <p class="text-muted"><?php echo substr($row['description'], 0, 100); ?>...</p>
              <p class="text-primary fw-bold">Rs <?php echo $row['price']; ?></p>
              <a href="servicedetails.php?q=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">View Details</a>
            </div>
            <div class="card-footer">
              <small class="text-muted">Duration: <?php echo $row['duration']; ?></small>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>
  <!-- end service section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>