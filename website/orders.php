<?php
session_start();
if (empty($_SESSION['un'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Database connection
include 'includes/db_connection.php';

// Get user-specific orders
$user = $_SESSION['un'];
$query = "
    SELECT 
        bookings.id AS order_id,
        services.servicename AS service_name,
        services.price AS service_price,
        bookings.booking_datetime,
        bookings.status
    FROM 
        bookings
    INNER JOIN 
        services ON bookings.service_id = services.id
    WHERE 
        bookings.customer_email = '$user'
";
$result = mysqli_query($con, $query);
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

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

  <!-- contact section -->

  <!-- <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="images/contact-img2.jpg" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Get In touch
        </h2>
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
  </section> -->





  <main class="container mt-5">
        <h2 class="mb-4">My Orders</h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Service Name</th>
                        <th>Order Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>

                            <td><?php echo $row['service_name']; ?></td>
                            <td><?php echo $row['booking_datetime']; ?></td>

                            <td>Rs <?php echo $row['service_price']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">No orders found.</div>
        <?php } ?>
    </main>

  <!-- end contact section -->



  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>