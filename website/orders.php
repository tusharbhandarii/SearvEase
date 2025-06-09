<?php
session_start();
if (empty($_SESSION['un'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Database connection
include 'includes/db_connection.php';

$user = $_SESSION['un'];

// Handle review submission
if (isset($_POST['submit_review'])) {
    $booking_id = intval($_POST['review_booking_id']);
    $rating = intval($_POST['rating']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    // Prevent duplicate reviews
    $exists = mysqli_query($con, "SELECT * FROM reviews WHERE booking_id=$booking_id AND customer_email='$user'");
    if (mysqli_num_rows($exists) == 0) {
        mysqli_query($con, "INSERT INTO reviews (booking_id, customer_email, rating, comment) VALUES ($booking_id, '$user', $rating, '$comment')");
    }
}

// Get user-specific orders
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
    ORDER BY bookings.booking_datetime DESC
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
  <link rel="shortcut icon" href="images/s_logo.jpg" type="image/x-icon">

  <title>My Orders - ServeEase</title>

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
                        <th>Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                            <td><?php echo $row['booking_datetime']; ?></td>
                            <td>Rs <?php echo $row['service_price']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 'Complete') {
                                    $order_id = $row['order_id'];
                                    $review_q = mysqli_query($con, "SELECT * FROM reviews WHERE booking_id=$order_id AND customer_email='$user'");
                                    if (mysqli_num_rows($review_q) == 0) {
                                ?>
                                    <form method="post" action="">
                                        <input type="hidden" name="review_booking_id" value="<?php echo $order_id; ?>">
                                        <label>
                                            <select name="rating" required class="form-control form-control-sm d-inline-block" style="width:auto;">
                                                <option value="">Rate</option>
                                                <?php for ($i=1; $i<=5; $i++) echo "<option value='$i'>$i ★</option>"; ?>
                                            </select>
                                        </label>
                                        <input type="text" name="comment" placeholder="Write a review..." class="form-control form-control-sm d-inline-block" style="width:150px;">
                                        <button type="submit" name="submit_review" class="btn btn-sm btn-primary">Submit</button>
                                    </form>
                                <?php
                                    } else {
                                        $review = mysqli_fetch_assoc($review_q);
                                        echo "<b>Your Review:</b> ";
                                        echo str_repeat("★", $review['rating']) . " - " . htmlspecialchars($review['comment']);
                                    }
                                } else {
                                    echo "<span class='text-muted'>Available after completion</span>";
                                }
                                ?>
                            </td>
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