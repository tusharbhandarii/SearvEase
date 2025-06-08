<?php session_start();

if(empty($_SESSION['un']))
{
  echo "<script> alert('please Login !!');
  window.location.href ='login.php'; 
  </script>";
}
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

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- Additional Custom CSS for Form Styling -->
  <style>
    /* General Form Styling */
    .contact_form-container {
      background-color: #f7f7f7;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .contact_form-container input[type="text"],
    .contact_form-container input[type="datetime-local"],
    .contact_form-container button {
      width: 100%;
      padding: 10px;
      margin-top: 15px;
      border-radius: 5px;
      border: 1px solid #ddd;
      font-size: 16px;
    }

    /* Input Field Styling */
    .contact_form-container input[type="text"],
    .contact_form-container input[type="datetime-local"] {
      background-color: #fff;
      color: #333;
      transition: border-color 0.3s;
    }

    .contact_form-container input[type="text"]:focus,
    .contact_form-container input[type="datetime-local"]:focus {
      border-color: #3498db;
      outline: none;
    }

    /* Button Styling */
    .btn-box button {
      background-color: #3498db;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-box button:hover {
      background-color: #2980b9;
    }
  </style>
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
                $selectquery = "select * from services where id='$q' ";
                $res = mysqli_query($con,$selectquery);
                $row = mysqli_fetch_assoc($res); 
                
                $custemail=$_SESSION['un'];
                $selectquery1 = "select * from users where email='$custemail' ";
                $res1 = mysqli_query($con,$selectquery1);
                $row1 = mysqli_fetch_assoc($res1); 
                    
        ?>

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 px-0">
            <div class="box "> 

              <div class="img-box"> 
                <!-- <img src="../uploadimage/servicee/<?php echo $row['image'];?>" width="400px" height="300px">   -->
                <img src="<?php echo UPLOAD_IMAGE_PATH . 'servicee/' . $row['image']; ?>" width="500px" height="400px" >

              </div>
            </div>
          </div>
        <div class="col-md-6 px-0">
          <div class="detail-box">
          <form method="POST">
              <div class="contact_form-container">
                <div>
                 
                  <div class="">
                  <input type="text" value="<?php echo $row1['name'];?>" class="message_input" name="name" placeholder="full name"/>
                   </div>
                  <div>
                    <input type="text" value="<?php echo $row1['phone'];?>" name="phno" placeholder="phone number"/>
                  </div>
                  <div>
                      <input type="text" value="<?php echo $row1['city'];?>" name="city" placeholder="city"/>
                    </div>
                    <div>
                        <input type="text" value="<?php echo $row1['zipcode'];?>" name="pincode" placeholder="pincode"/>
                    </div>
                    <div>
                      <input type="text" value="<?php echo $row1['address'];?>" name="address" placeholder="address"/>
                    </div>
                     <div>
                        <input type="datetime-local" placeholder="Booking Date" name="datetime"/>
                    </div>

                  <div class="btn-box ">
                    <button type="submit" name="btn">
                       confirm 
                    </button>
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </section>
            <?php
                        if(isset($_POST['btn'])){
                            $name=$_POST['name'];
                            $phno=$_POST['phno'];
                            $city=$_POST['city'];
                            $pincode=$_POST['pincode'];
                            $address=$_POST['address'];
                            $datetime=$_POST['datetime'];

                            
                            $editquery = "UPDATE users SET name='$name', phone='$phno',city='$city',zipcode='$pincode',address='$address' WHERE email='$custemail'";
                            mysqli_query($con, $editquery);

                            $insertQuery = "INSERT INTO bookings VALUES('', '$custemail', '$q','Null','$datetime', 'Pending', NOW())";

                            if(mysqli_query($con, $insertQuery))
                            {
                                echo "<script>
                                 alert('Booking Confirmed !! ');window.location.href='index.php';</script>";
                            }
                            else
                            {
                            echo "<script>
                            alert('Somthing wrong !! ');window.location.href='confirmbooking.php';</script>";
                            }

                        }
                    
                        
            ?>

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