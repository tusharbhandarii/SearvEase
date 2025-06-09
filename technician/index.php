<?php
session_start();
include('includes/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Technician Dashboard - ServeEase</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Other CSS (AdminLTE, etc.) -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body>
<div>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Technician Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
        <div class="inner">
          <h3>
            <?php echo isset($_SESSION['technician_email']) ? htmlspecialchars($_SESSION['technician_email']) : 'Technician'; ?>
          </h3>
          <p>Profile</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="./components/edit_profile.php" class="small-box-footer">Edit Profile <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <?php
                  // Fetch technician availability from DB
                  $technician_id = $_SESSION['technician_id'];
                  $availability = 'unavailable';
                  $sql = "SELECT availability FROM technicians WHERE id = $technician_id";
                  $result = mysqli_query($con, $sql);
                  if ($row = mysqli_fetch_assoc($result)) {
                      $availability = $row['availability'];
                  }
                  $is_available = ($availability === 'available');
                  echo $is_available ? 'Available' : 'Unavailable';
                ?>
              </h3>
              <p>Availability Status</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <form method="post" style="margin:0;">
              <input type="hidden" name="toggle_availability" value="1">
              <button type="submit" class="small-box-footer btn btn-link" style="color:#fff;text-decoration:underline;">
                <?php echo $is_available ? 'Set Unavailable' : 'Set Available'; ?> <i class="fas fa-arrow-circle-right"></i>
              </button>
            </form>
            <?php
              if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_availability'])) {
                // Toggle availability in DB
                $new_status = $is_available ? 'unavailable' : 'available';
                $update_sql = "UPDATE technicians SET availability='$new_status' WHERE id=$technician_id";
                mysqli_query($con, $update_sql);
                // Optionally update session
                $_SESSION['technician_available'] = ($new_status === 'available');
                // Refresh to show updated status
                echo "<meta http-equiv='refresh' content='0'>";
              }
            ?>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="notificationCount">
                0
              </h3>
              <p>Notifications</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-bell"></i>
            </div>
            <a href="./components/notifications.php" class="small-box-footer">View Notifications <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>
                  <!-- You can show a count here if you want -->
                  My Bookings
              </h3>
              <p>Available Technician</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="components/view_requests.php" class="small-box-footer">
              View My Bookings <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
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
            <div class="card-body">
              <ul class="todo-list" id="todoList" data-widget="todo-list"></ul>
            </div>
            <div class="card-footer clearfix">
              <div class="input-group">
                <input type="text" id="newTaskInput" class="form-control" placeholder="Add new task">
                <div class="input-group-append">
                  <button type="button" id="addTaskButton" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="col-lg-5 connectedSortable">
          <!-- Calendar -->
          <div class="card bg-gradient-success">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body pt-0">
              <div id="calendar" style="width: 100%"></div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
  <footer class="main-footer" style="position:fixed; left:0; bottom:0; width:100vw; z-index:1030; background:#fff;">
    <strong>&copy; 2014-2021 <a href="#">SearevEase</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">  
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- JS scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script>
function updateNotificationCount() {
  fetch('components/fetch_notification_count.php')
    .then(res => res.json())
    .then(data => {
      document.getElementById('notificationCount').textContent = data.count;
    });
}
updateNotificationCount();
setInterval(updateNotificationCount, 5000); // Update every 5 seconds
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const todoList = document.getElementById('todoList');
    const newTaskInput = document.getElementById('newTaskInput');
    const addTaskButton = document.getElementById('addTaskButton');
    addTaskButton.addEventListener('click', function () {
      const taskText = newTaskInput.value.trim();
      if (taskText === '') {
        alert('Please enter a task!');
        return;
      }
      addTask(taskText);
      newTaskInput.value = '';
    });
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
          <i class="fas fa-trash delete-task"></i>
        </div>
      `;
      li.querySelector('.edit-task').addEventListener('click', function () {
        editTask(li);
      });
      li.querySelector('.delete-task').addEventListener('click', function () {
        deleteTask(li);
      });
      todoList.appendChild(li);
    }
    function editTask(taskElement) {
      const taskTextElement = taskElement.querySelector('.text');
      const newTaskText = prompt('Edit your task:', taskTextElement.textContent);
      if (newTaskText !== null && newTaskText.trim() !== '') {
        taskTextElement.textContent = newTaskText.trim();
      }
    }
    function deleteTask(taskElement) {
      if (confirm('Are you sure you want to delete this task?')) {
        taskElement.remove();
      }
    }
  });
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      editable: false,
      selectable: false,
      events: []
    });
    calendar.render();
  });
</script>
</body>
</html>
