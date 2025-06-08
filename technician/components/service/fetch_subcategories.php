<?php
include '../../includes/db_connection.php';

if (isset($_POST['category'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category']);

    // Fetch subcategories based on the selected category ID
    $query = "SELECT * FROM subcategories WHERE category_id = '$category_id'";
    $result = mysqli_query($con, $query);

    // Output the options for the subcategory dropdown
    echo '<option value="">Select Subcategory</option>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
        }
    } else {
        echo '<option value="">No subcategories available</option>';
    }
}
?>
