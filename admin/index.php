<?php
session_start();
include('includes/db_connection.php');
if (empty($_SESSION['admin_email'])) {
    header("Location: ../website/AdminLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - ServeEase Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="Admin" height="60" width="60">
  </div>

    <!--####################### navbar ######################### -->
        <?php include ('includes/header.php')?>

    <!--####################### sidebar ########## -->
        <?php include ('includes/sidebar2.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   







    
          <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>
                     <?php
                          $querybok="select id from bookings where status='pending'";
                            $resexist=mysqli_query($con,$querybok);
                            $rowcount=mysqli_num_rows($resexist);
                            echo $rowcount;              
                  ?>
                </h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./components/dashboard/pendingBookings.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                          $querycusss = "SELECT COUNT(*) AS total FROM bookings WHERE status='complete'";
                          $resexist = mysqli_query($con, $querycusss);
                          $row = mysqli_fetch_assoc($resexist);
                          echo $row['total'];
                  ?>
                </h3>        <p>Total Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./components/dashboard/allSales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3>
                    <?php
                          $querycusss = "SELECT COUNT(*) AS total FROM users WHERE role='customer'";
                          $resexist = mysqli_query($con, $querycusss);
                          $row = mysqli_fetch_assoc($resexist);
                          echo $row['total'];
                    ?>
                </h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./components/dashboard/allUsers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                    <?php
                          $querycusss = "SELECT COUNT(*) AS total FROM users WHERE role='technician'";
                          $resexist = mysqli_query($con, $querycusss);
                          $row = mysqli_fetch_assoc($resexist);
                          echo $row['total'];
                    ?>
                </h3>

                <p>All Technicians </p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="./components/dashboard/allTechnicians.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
                    <!-- --------------------------------------------------------------------  -->
        </div>
        <!-- /.row -->

            <!-- --------------------------------------------------------- 2nd / -->

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Orders</span>
                <span class="info-box-number">
                 
                  <?php
                          $querybok="select id from bookings";
                            $resexist=mysqli_query($con,$querybok);
                            $rowcount=mysqli_num_rows($resexist);
                            echo $rowcount;              
                    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sales Money</span>
                  <span class="info-box-number">
                    <?php
                    $totalSales = 0;
                    $querySales = "
                                      SELECT SUM(services.price) AS total 
                                      FROM services 
                                      INNER JOIN bookings ON services.id = bookings.service_id
                                      WHERE status='complete'
                                  ";
                    $resultSales = mysqli_query($con, $querySales);
                    if (!$resultSales) {
                        error_log("Query failed: " . mysqli_error($con)); // Log the error
                    } else {
                        $rowSales = mysqli_fetch_assoc($resultSales);
                        $totalSales = $rowSales['total'] ?? 0; // Use null coalescing operator to ensure $totalSales is 0 if no result
                    }
                    echo $totalSales;
                  ?>
                  <small>Rs</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Average Rating</span>
                <span class="info-box-number">
                  <?php
                    $avg_q = mysqli_query($con, "SELECT AVG(rating) AS avg_rating FROM reviews");
                    $avg_row = mysqli_fetch_assoc($avg_q);
                    echo $avg_row['avg_rating'] ? number_format($avg_row['avg_rating'], 1) . " / 5" : "No reviews";
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Available Technicians</span>
                <span class="info-box-number">
                   <?php
                          $querycusss = "SELECT COUNT(*) AS total FROM technicians WHERE availability='available'";
                          $resexist = mysqli_query($con, $querycusss);
                          $row = mysqli_fetch_assoc($resexist);
                          echo $row['total'];
                    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


            <!-- ----------------------------------------------------------  /  2nd    --------  -->





        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" id="todoList" data-widget="todo-list">
                  <!-- Existing tasks will be dynamically added here -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="input-group">
                  <input type="text" id="newTaskInput" class="form-control" placeholder="Add new task">
                  <div class="input-group-append">
                    <button type="button" id="addTaskButton" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                  </div>
                </div>
              </div>
            </div>
        <!-- /.card -->



    </section>
      <!-- /.Left col -->
      <!-- right col -->
      <section class="col-lg-5 connectedSortable">
      <!-- Simple Calendar -->
      <div class="card bg-gradient-success">
      <div class="card-header border-0">
      <h3 class="card-title">
      <i class="far fa-calendar-alt"></i>
      Simple Calendar
      </h3>
      <!-- tools card -->
      <div class="card-tools">
      <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
      <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
      <i class="fas fa-times"></i>
      </button>
      </div>
      <!-- /. tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body pt-0" style="background-color: green; height: 250px;">
      <!-- Display current month and dates -->
      <div class="text-center text-white">
      <h4 id="currentMonth"></h4>
      <div id="calendarDates" class="d-flex flex-wrap justify-content-center" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; align-items: center; justify-items: center;"></div>
      </div>
      </div>
      <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </section>
      <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
      const currentMonthElement = document.getElementById('currentMonth');
      const calendarDatesElement = document.getElementById('calendarDates');

      const today = new Date();
      const monthNames = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
      ];

      const currentMonth = monthNames[today.getMonth()];
      const currentYear = today.getFullYear();

      currentMonthElement.textContent = `${currentMonth} ${currentYear}`;

      const firstDay = new Date(today.getFullYear(), today.getMonth(), 1).getDay();
      const daysInMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();

      // Fill in the blank days before the first day of the month
      for (let i = 0; i < firstDay; i++) {
      const blankDay = document.createElement('div');
      blankDay.style.width = '40px';
      blankDay.style.height = '40px';
      blankDay.style.lineHeight = '40px';
      blankDay.style.textAlign = 'center';
      calendarDatesElement.appendChild(blankDay);
      }

      // Fill in the days of the month
      for (let day = 1; day <= daysInMonth; day++) {
      const dateElement = document.createElement('div');
      dateElement.textContent = day;
      dateElement.style.width = '40px';
      dateElement.style.height = '40px';
      dateElement.style.lineHeight = '40px';
      dateElement.style.margin = '3px';
      dateElement.style.textAlign = 'center';
      dateElement.style.border = '1px solid white';
      dateElement.style.borderRadius = '5px';
      dateElement.style.color = 'white';
      calendarDatesElement.appendChild(dateElement);
      }
      });
    </script>
    <!-- /.content -->









  </div>
  <!-- /.content-wrapper -->



  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">SearevEase</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const todoList = document.getElementById('todoList');
        const newTaskInput = document.getElementById('newTaskInput');
        const addTaskButton = document.getElementById('addTaskButton');

        // Add a new task
        addTaskButton.addEventListener('click', function () {
          const taskText = newTaskInput.value.trim();
          if (taskText === '') {
            alert('Please enter a task!');
            return;
          }

          addTask(taskText);
          newTaskInput.value = ''; // Clear the input field
        });

        // Add a task to the list
        function addTask(taskText) {
          const li = document.createElement('li');

          li.innerHTML = `
            <span class="handle">
              <i class="fas fa-ellipsis-v"></i>
              <i class="fas fa-ellipsis-v"></i>
            </span>
            <div class="icheck-primary d-inline ml-2">
              <input type="checkbox" value="" id="todoCheck${Date.now()}">
              <label for="todoCheck${Date.now()}"></label>
            </div>
            <span class="text">${taskText}</span>
            <small class="badge badge-info"><i class="far fa-clock"></i> Just now</small>
            <div class="tools">
              <i class="fas fa-edit edit-task"></i>
              <i class="fas fa-trash delete-task"></i> <!-- Delete button -->
            </div>
          `;

          // Add event listeners for edit and delete
          li.querySelector('.edit-task').addEventListener('click', function () {
            editTask(li);
          });

          li.querySelector('.delete-task').addEventListener('click', function () {
            deleteTask(li);
          });

          // Append the task to the list
          todoList.appendChild(li);
        }

        // Edit a task
        function editTask(taskElement) {
          const taskTextElement = taskElement.querySelector('.text');
          const newTaskText = prompt('Edit your task:', taskTextElement.textContent);
          if (newTaskText !== null && newTaskText.trim() !== '') {
            taskTextElement.textContent = newTaskText.trim();
          }
        }

        // Delete a task
        function deleteTask(taskElement) {
          if (confirm('Are you sure you want to delete this task?')) {
            taskElement.remove();
          }
        }
      });

      document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  // Initialize the calendar
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGrscripth', // Default view
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    editable: false, // Disable drag-and-drop
    selectable: false, // Disable selecting dates
    events: [] // No initial events
  });

  // Render the calendar
  calendar.render();
});
    </script>
</body>
</html>
