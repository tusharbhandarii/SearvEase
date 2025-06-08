           
              <!-- fetching image  -->
              <!-- <?php
                  function getExtension($str) 
                  {
                      $i = strrpos($str,".");
                      if (!$i) { return ""; }
                      $l = strlen($str) - $i;
                      $ext = substr($str,$i+1,$l);
                      return $ext;
                  }
                  $errors=0;
                  if(isset($_POST['btn'])) 
                  {
                     $image=$_FILES['image']['name'];
                     if ($image) 
                     {
                       $filename = stripslashes($_FILES['image']['name']);
                        $extension = getExtension($filename);
                       $extension = strtolower($extension);
                          if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "bmp")) 
                       {
                         echo '<h1>Unknown extension!</h1>';
                         $errors=1;
                       }
                       else
                       {
                              $image_name=time().'.'.$extension;
                              $newname="uploadimage/technicians/".$image_name;        
                              $copied = copy($_FILES['image']['tmp_name'], $newname);
                              if (!$copied) 
                              {
                                  echo '<h1>Copy unsuccessfull!</h1>';
                                  $errors=1;
                              }
                          }
                      }

                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = ucwords(strtolower($_POST["name"]));
                        // Save the formatted to the database or perform other operations
                      }
                      $phno = $_POST['phno'];
                      $address = $_POST['address'];
                      $email = $_POST['email'];
                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $specialize = ucwords(strtolower($_POST["specialize"]));
                      }
                      $pass = $_POST['pass'];                      

                      $insertQuery = "INSERT INTO users (name, email, password, role, phone, address, city, state, zipcode, latitude, longitude) 
                      VALUES ('$name', '$email', '$pass', 'technician', '$phno', '$address', '$city', '$state', '$pincode', '$latitude', '$longitude')";

                      if(mysqli_query($con,$insertQuery))
                      {
                        echo "<script>alert('Data inserted ');window.location.href='add.php';</script>";
                      }else{
                        echo "<script>alert('Data is not inserted ');window.location.href='add.php';</script>";
                      }
                    }
              ?> -->