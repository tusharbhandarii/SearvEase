<?php
include '../../includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('../../includes/header.php'); ?>
  <!-- Sidebar -->
  <?php include('../../includes/sidebar.php'); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              

            <?php
                        $q = $_GET['q'];
                        $selectquery = "select * from services where id='$q' ";
                        $res = mysqli_query($con,$selectquery);
                        $row = mysqli_fetch_assoc($res); 
            ?>

                        <!-- form start -->

            <form method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                <!-- service  -->
              <div class="form-group">
                <label for="exampleInputname">SERVICE NAME</label>
                <input type="text" class="form-control" id="exampleInputname" name="service" value="<?php echo htmlspecialchars($row['servicename']); ?>" placeholder="Service Name">
              </div>                  

               <!-- description  -->
              <div class="form-group">
                <label for="exampleInputname">DESCRIPTION</label>
                <input type="text" class="form-control" id="exampleInputname" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" placeholder="Description">
              </div>   
               <!-- price  -->
              <div class="form-group">
                <label for="exampleInputname">PRICE</label>
                <input type="text" class="form-control" id="exampleInputname" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" placeholder="Price">
              </div>   
               <!-- duration  -->
              <div class="form-group">
                <label for="exampleInputname">DURATION</label>
                <input type="text" class="form-control" id="exampleInputname" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>" placeholder="Duration">
              </div>
              <!-- image  -->
              <div class="form-group">
                  <label for="exampleInputFile">IMAGE</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
              </div>
                </div>                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="submit" value="edit" onclick="return check()" name="btn" class="btn btn-primary">
              </div>
              
            </form>

            <?php
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
                              $newname="uploadimage/service/".$image_name;        
                              $copied = copy($_FILES['image']['tmp_name'], $newname);
                              if (!$copied) 
                              {
                                  echo '<h1>Copy unsuccessfull!</h1>';
                                  $errors=1;
                              }
                          }
                      }


                        $service=$_POST['service'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $duration=$_POST['duration'];

                        // updating the database

                        $editquery = "UPDATE services SET servicename='$service', description='$description',   price='$price', duration='$duration', image='$image_name' WHERE id='$q' ";
                        if(mysqli_query($con, $editquery))
                        {
                            echo "<script>
                            alert('Data updated !! ');window.location.href='add.php';</script>";
                        }
                        else
                        {
                        echo "<script>
                        alert('Data is not updated !! ');window.location.href='add.php';</script>";
                        }
                    }
              ?>
  
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->
            
            <!-- /.card -->

            
            <!-- /.card -->

            <!-- general form elements disabled -->
            
            <!-- /.card -->
            <!-- general form elements disabled -->
            
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>