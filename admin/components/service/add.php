<?php
include '../../includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Services</title>

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
    .is-invalid {
      border-color: red;
    }
    .is-valid {
      border-color: green;
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
        <h1>Add Services</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Service</h3>
              </div>
              <form method="POST" enctype="multipart/form-data" id="serviceForm">
                <div class="card-body">
                  <!-- Service Name -->
                  <div class="form-group">
                    <label for="service">Service Name</label>
                    <input type="text" class="form-control" id="service" placeholder="Enter name" name="service">
                    <span class="error-message" id="serviceError"></span>
                  </div>

                  <!-- Category -->
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" onchange="fetchSubcategories()">
                      <option value="">Select Category</option>
                      <?php
                      $selectquery = "SELECT * FROM categories";
                      $res = mysqli_query($con, $selectquery);
                      while ($row = mysqli_fetch_assoc($res)) {
                          echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                      }
                      ?>
                    </select>
                    <span class="error-message" id="categoryError"></span>
                  </div>

                  <!-- Subcategory -->
                  <div class="form-group">
                    <label for="subcategory">Subcategory</label>
                    <select class="form-control" id="subcategory" name="subcategory">
                      <option value="">Select Subcategory</option>
                    </select>
                    <span class="error-message" id="subcategoryError"></span>
                  </div>

                  <!-- Description -->
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Enter description" name="description"></textarea>
                    <span class="error-message" id="descriptionError"></span>
                  </div>

                  <!-- Price -->
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" name="price">
                    <span class="error-message" id="priceError"></span>
                  </div>

                  <!-- Duration -->
                  <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" class="form-control" id="duration" placeholder="Enter duration" name="duration">
                    <span class="error-message" id="durationError"></span>
                  </div>

                  <!-- Image -->
                  <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <span class="error-message" id="imageError"></span>
                  </div>
                </div>
                <div class="card-footer">
                  <center><input type="submit" value="Submit" name="btn" class="btn btn-primary"></center>
                </div>
              </form>

              <?php
              if (isset($_POST['btn'])) {
                  $service = ucwords(strtolower($_POST['service']));
                  $category = mysqli_real_escape_string($con, $_POST['category']);
                  $subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
                  $description = mysqli_real_escape_string($con, $_POST['description']);
                  $price = mysqli_real_escape_string($con, $_POST['price']);
                  $duration = mysqli_real_escape_string($con, $_POST['duration']);

                  // Handle image upload
                  $image = $_FILES['image']['name'];
                  $image_name = "";
                  if ($image) {
                      $image_name = time() . '_' . $image;
                      $target = "../../uploadimage/service/" . $image_name;
                      if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                          echo "<script>alert('Image upload failed!');</script>";
                          $image_name = "";
                      }
                  }

                  $insertQuery = "INSERT INTO services (servicename, category, subcategory, description, price, duration, image) 
                                  VALUES ('$service', '$category', '$subcategory', '$description', '$price', '$duration', '$image_name')";
                  if (mysqli_query($con, $insertQuery)) {
                      echo "<script>alert('Data inserted successfully!');window.location.href='add.php';</script>";
                  } else {
                      echo "<script>alert('Data insertion failed!');window.location.href='add.php';</script>";
                  }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Service List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Service</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Duration</th>
                      <th>Image</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Join query to fetch category and subcategory names
                    $selectquery = "
                      SELECT 
                        services.id AS service_id,
                        services.servicename,
                        categories.name AS category_name,
                        subcategories.name AS subcategory_name,
                        services.description,
                        services.price,
                        services.duration,
                        services.image
                      FROM services
                      INNER JOIN categories ON services.category = categories.id
                      INNER JOIN subcategories ON services.subcategory = subcategories.id
                    ";
                    $res = mysqli_query($con, $selectquery);
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($row['servicename']); ?></td>
                        <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['subcategory_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td>
                          <?php if (!empty($row['image'])) { ?>
                            <img src="../../uploadimage/servicee/<?php echo htmlspecialchars($row['image']); ?>" alt="Service Image" style="width: 100px; height: auto;">
                          <?php } else { ?>
                            No Image
                          <?php } ?>
                        </td>
                        <td>
                          <center>
                            <a class="btn btn-primary btn-sm" href="edit.php?q=<?php echo $row['service_id']; ?>">Edit</a>
                          </center>
                        </td>
                        <td>
                          <center>
                            <a class="btn btn-danger btn-sm" href="delete.php?q=<?php echo $row['service_id']; ?>" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                          </center>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- Fetch Subcategories -->
<script>
  function fetchSubcategories() {
    var category = document.getElementById('category').value;

    // Make AJAX call to fetch subcategories
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_subcategories.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // Populate the subcategory dropdown with the response
        document.getElementById('subcategory').innerHTML = this.responseText;
      }
    };
    xhr.send('category=' + category);
  }

  // JavaScript Validation
  document.getElementById('serviceForm').addEventListener('submit', function (e) {
    let valid = true;

    // Validate Service Name
    const serviceInput = document.getElementById('service');
    if (serviceInput.value.trim() === '') {
      valid = false;
      serviceInput.classList.add('is-invalid');
      document.getElementById('serviceError').innerText = 'Service name is required.';
    } else {
      serviceInput.classList.remove('is-invalid');
      serviceInput.classList.add('is-valid');
      document.getElementById('serviceError').innerText = '';
    }

    // Validate Category
    const categoryInput = document.getElementById('category');
    if (categoryInput.value === '') {
      valid = false;
      categoryInput.classList.add('is-invalid');
      document.getElementById('categoryError').innerText = 'Category is required.';
    } else {
      categoryInput.classList.remove('is-invalid');
      categoryInput.classList.add('is-valid');
      document.getElementById('categoryError').innerText = '';
    }

    // Validate Subcategory
    const subcategoryInput = document.getElementById('subcategory');
    if (subcategoryInput.value === '') {
      valid = false;
      subcategoryInput.classList.add('is-invalid');
      document.getElementById('subcategoryError').innerText = 'Subcategory is required.';
    } else {
      subcategoryInput.classList.remove('is-invalid');
      subcategoryInput.classList.add('is-valid');
      document.getElementById('subcategoryError').innerText = '';
    }

    // Validate Description
    const descriptionInput = document.getElementById('description');
    if (descriptionInput.value.trim() === '') {
      valid = false;
      descriptionInput.classList.add('is-invalid');
      document.getElementById('descriptionError').innerText = 'Description is required.';
    } else {
      descriptionInput.classList.remove('is-invalid');
      descriptionInput.classList.add('is-valid');
      document.getElementById('descriptionError').innerText = '';
    }

    // Validate Price
    const priceInput = document.getElementById('price');
    if (priceInput.value.trim() === '' || isNaN(priceInput.value)) {
      valid = false;
      priceInput.classList.add('is-invalid');
      document.getElementById('priceError').innerText = 'Valid price is required.';
    } else {
      priceInput.classList.remove('is-invalid');
      priceInput.classList.add('is-valid');
      document.getElementById('priceError').innerText = '';
    }

    // Validate Duration
    const durationInput = document.getElementById('duration');
    if (durationInput.value.trim() === '') {
      valid = false;
      durationInput.classList.add('is-invalid');
      document.getElementById('durationError').innerText = 'Duration is required.';
    } else {
      durationInput.classList.remove('is-invalid');
      durationInput.classList.add('is-valid');
      document.getElementById('durationError').innerText = '';
    }

    // Validate Image
    const imageInput = document.getElementById('image');
    if (imageInput.files.length === 0) {
      valid = false;
      imageInput.classList.add('is-invalid');
      document.getElementById('imageError').innerText = 'Image is required.';
    } else {
      imageInput.classList.remove('is-invalid');
      imageInput.classList.add('is-valid');
      document.getElementById('imageError').innerText = '';
    }

    // Prevent form submission if validation fails
    if (!valid) {
      e.preventDefault();
    }
  });
</script>
</body>
</html>