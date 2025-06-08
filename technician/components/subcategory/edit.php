<?php
include '../../includes/db_connection.php';
$q = $_GET['q']; // Get the subcategory ID from the URL

// Fetch the subcategory details
$selectquery = "SELECT * FROM subcategories WHERE id='$q'";
$res = mysqli_query($con, $selectquery);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Subcategory</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
        <h1>Edit Subcategory</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Subcategory</h3>
              </div>
              <form method="POST" id="subcategoryForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="categorySelect">CATEGORY</label>
                    <select class="form-control" id="categorySelect" name="category">
                      <option value="">Select Category</option>
                      <?php
                      $categoriesQuery = "SELECT * FROM categories";
                      $categoriesRes = mysqli_query($con, $categoriesQuery);
                      while ($categoryRow = mysqli_fetch_assoc($categoriesRes)) {
                          $selected = ($categoryRow['id'] == $row['category_id']) ? 'selected' : '';
                          $categoryName = strtoupper(htmlspecialchars($categoryRow['name']));
                          echo "<option value=\"{$categoryRow['id']}\" $selected>{$categoryName}</option>";
                      }
                      ?>
                    </select>
                    <span class="error-message" id="categoryError"></span>
                  </div>
                  <div class="form-group">
                    <label for="subcategoryInput">SUBCATEGORY</label>
                    <input type="text" class="form-control" id="subcategoryInput" placeholder="Enter Subcategory Name" name="subcategory" value="<?php echo htmlspecialchars($row['name']); ?>">
                    <span class="error-message" id="subcategoryError"></span>
                  </div>
                </div>
                <div class="card-footer">
                  <center><input type="submit" value="Update" name="btn" class="btn btn-primary"></center>
                </div>
              </form>

              <?php
              if (isset($_POST['btn'])) {
                  $category = mysqli_real_escape_string($con, $_POST['category']);
                  $subcategory = trim($_POST['subcategory']);
                  $subcategory_upper = ucfirst(strtolower($subcategory));

                  if ($category !== "" && $subcategory_upper !== "") {
                      $updateQuery = "UPDATE subcategories SET category_id=?, name=? WHERE id=?";
                      $stmt = $con->prepare($updateQuery);
                      $stmt->bind_param("isi", $category, $subcategory_upper, $q);

                      if ($stmt->execute()) {
                          echo "<script>
                          alert('Data updated successfully!');
                          window.location.href='add.php';
                          </script>";
                      } else {
                          echo "<script>
                          alert('Data update failed!');
                          window.location.href='edit.php?q=$q';
                          </script>";
                      }

                      $stmt->close();
                  } else {
                      echo "<script>
                      alert('Please select a category and enter a subcategory name.');
                      window.location.href='edit.php?q=$q';
                      </script>";
                  }
              }
              ?>
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

<!-- AdminLTE JS -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>