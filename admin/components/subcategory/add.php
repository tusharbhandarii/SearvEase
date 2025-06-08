<?php
include '../../includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Subcategory</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Custom CSS -->
  <style>
    .error-message {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Navbar -->
  <?php include('../../includes/header.php'); ?>
  <!-- Sidebar -->
  <?php include('../../includes/sidebar.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>Add Subcategory</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Subcategory</h3>
              </div>
              <form method="POST" id="subcategoryForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="categorySelect">CATEGORY</label>
                    <select class="form-control" id="categorySelect" name="category">
                      <option value="">Select Category</option>
                      <?php
                      $selectquery = "SELECT * FROM categories";
                      $res = mysqli_query($con, $selectquery);
                      while ($row = mysqli_fetch_assoc($res)) {
                          $categoryName = strtoupper(htmlspecialchars($row['name']));
                          echo "<option value=\"{$row['id']}\">{$categoryName}</option>";
                      }
                      ?>
                    </select>
                    <span class="error-message" id="categoryError"></span>
                  </div>
                  <div class="form-group">
                    <label for="subcategoryInput">SUBCATEGORY</label>
                    <input type="text" class="form-control" id="subcategoryInput" placeholder="Enter Subcategory Name" name="subcategory">
                    <span class="error-message" id="subcategoryError"></span>
                  </div>
                </div>
                <div class="card-footer">
                  <center><input type="submit" value="Submit" name="btn" class="btn btn-primary"></center>
                </div>
              </form>

              <?php
              if (isset($_POST['btn'])) {
                  $category = mysqli_real_escape_string($con, $_POST['category']);
                  $subcategory = trim($_POST['subcategory']);
                  $subcategory_upper = ucfirst(strtolower($subcategory));
                  // strtoupper($subcategory);

                  if ($category !== "" && $subcategory_upper !== "") {
                      $stmt = $con->prepare("INSERT INTO subcategories (category_id, name) VALUES (?, ?)");
                      $stmt->bind_param("is", $category, $subcategory_upper);

                      if ($stmt->execute()) {
                          echo "<script>
                          alert('Data inserted successfully!');
                          window.location.href='add.php';
                          </script>";
                      } else {
                          echo "<script>
                          alert('Data insertion failed!');
                          window.location.href='add.php';
                          </script>";
                      }

                      $stmt->close();
                  } else {
                      echo "<script>
                      alert('Please select a category and enter a subcategory name.');
                      window.location.href='add.php';
                      </script>";
                  }
              }
              ?>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subcategory List</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $selectquery = "SELECT subcategories.id, categories.name AS category_name, subcategories.name AS subcategory_name 
                                    FROM subcategories 
                                    INNER JOIN categories ON subcategories.category_id = categories.id";
                    $res = mysqli_query($con, $selectquery);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $subcategoryId = htmlspecialchars($row['id']);
                        $categoryName = strtoupper(htmlspecialchars($row['category_name']));
                        $subcategoryName = strtoupper(htmlspecialchars($row['subcategory_name']));
                        echo "<tr>
                                <td>{$categoryName}</td>
                                <td>{$subcategoryName}</td>
                                <td><center><a class='btn btn-primary btn-sm' href='edit.php?q={$subcategoryId}'>Edit</a></center></td>
                                <td><center><a class='btn btn-danger btn-sm' href='delete.php?q={$subcategoryId}' onclick='return confirm(\"Are you sure you want to delete this subcategory?\");'>Delete</a></center></td>
                              </tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE JS -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- DataTables Initialization -->
<script>
  $(document).ready(function () {
    $('#example1').DataTable({
      responsive: true,
      autoWidth: false,
    });
  });
</script>
</body>
</html>
