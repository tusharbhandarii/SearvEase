<?php session_start();
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

  <title>ServeEase</title>

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

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/hero-bg3.jpg" alt="">
      </div>
    </div>


    
    <!--####################### navbar ######################### -->
    <?php include ('includes/header.php')?>
    <!-- end header section -->

    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">


          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      Home Service <br>
                      <span>
                      Solutions
                      </span>
                    </h1>
                    <p>
                      A  a a p &nbsp; K a &nbsp; K a a m &nbsp; H a a m &nbsp; K a r e n g e  ,&nbsp;  A a a p &nbsp;  B a s s &nbsp; A r h a m &nbsp; K a r o
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1"> Read more </a>
                      <a href="service.php" class="btn-2">Services</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      Home Service <br>
                      <span>
                      Solutions
                      </span>
                    </h1>
                    <p>
                      T u m a r a &nbsp; K a m &nbsp; H a m &nbsp; K a r e n g e  ,  T u m &nbsp;  B a s s &nbsp; A r a m &nbsp; K a r o
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1"> Read more </a>
                      <a href="service.php" class="btn-2">Services</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      Home Service <br>
                      <span>
                      Solutions
                      </span>
                    </h1>
                    <p>
                      T u m a r a &nbsp; K a m &nbsp; H a m &nbsp; K a r e n g e  ,  T u m &nbsp;  B a s s &nbsp; A r a m &nbsp; K a r o
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1"> Read more </a>
                      <a href="service.php" class="btn-2">Services</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



        </div>
        <div class="container idicator_container">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img_container">
            <div class="img-box">
              <img src="images/about-img2.jpg" alt="" />
            </div>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="detail-box">
            <div class="heading_container ">
              <h2>
                Who Are We?
              </h2>
            </div>
            <p>
              "We are a dedicated team focused on simplifying home services for you. Our mission is to connect you with skilled professionals who deliver high-quality, reliable, and timely services right at your doorstep. From cleaning and maintenance to repairs and installations, we offer a wide range of services to cater to your every household need. We prioritize customer satisfaction, safety, and transparency in every service we provide, ensuring a seamless and hassle-free experience for you. Trust us to make home management easy, so you can focus on what matters most."
            </p>
            <div class="btn-box">
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our services
        </h2>
      </div>

        <div class="row">
            <?php
                include 'includes/db_connection.php';
                include 'includes/config.php'; // Include the configuration file

                $selectquery = "SELECT * FROM services LIMIT 3";
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
                        <h5 class="card-title"><?php echo $row['servicename']; ?></h5>
                        <p class="text-muted"><?php echo substr($row['description'], 0, 100); ?>...</p>
                        <a href="servicedetails.php?q=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Duration: <?php echo $row['duration']; ?> hours</small>
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




  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container ">
      <div class="heading_container heading_center">
        <h2>
          What is says our clients
        </h2>
      </div>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="img-box">
                <img src="images/client1.jpg" alt="">
              </div>
              <div class="detail-box">
                <h4>
                Priyanka S.
                </h4>
                <p>
                "Very convenient and efficient service! The customer support team was helpful, and the professional was courteous and skilled. I’m glad I found this app – it’s my go-to for any household needs now!"
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="box">
              <div class="img-box">
                <img src="images/client2.jpg" alt="">
              </div>
              <div class="detail-box">
                <h4>
                Ramesh K.
                </h4>
                <p>
                "Great experience! From start to finish, everything was smooth and transparent. The app has a variety of services, and the quality of work is excellent. It's a relief to have a platform I can trust for my home maintenance needs."

                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="box">
              <div class="img-box">
                <img src="images/client3.jpg" alt="">
              </div>
              <div class="detail-box">
                <h4>
                Sara D.
                </h4>
                <p>
                "I’ve tried multiple home service apps, but this one stands out. The booking process was quick and easy, and the service professional arrived on time and did a fantastic job! Highly recommended for anyone looking for reliable home services."

                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="images/contact-img2.jpg" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Are you a technician?
        </h2>
        <h6>
          JOIN US WITH OUR JOURNEY
        </h6>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <form action="#">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Full Name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Email " />
                  </div>
                  <div>
                    <input type="text" placeholder="Phone Number" />
                  </div>
                  <div class="">
                    <input type="text" placeholder="Message" class="message_input" />
                  </div>
                  <div class="btn-box ">
                    <button type="submit">
                      Send
                    </button>                    
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->


     <!--############### adding footer#############  -->
     <?php include ('includes/footer.php')?>


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>