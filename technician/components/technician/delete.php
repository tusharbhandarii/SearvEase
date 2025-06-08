<?php
    include '../../includes/db_connection.php';

    $q = $_GET['q']; // Get the user ID to delete

    // Delete the user from the `users` table
    $deleteUserQuery = "DELETE FROM users WHERE id='$q'";

    if (mysqli_query($con, $deleteUserQuery)) {
        // If the user is deleted, the corresponding entry in the `technician` table will also be deleted due to ON DELETE CASCADE
        echo "<script> alert('Technician Deleted Successfully!'); window.location.href ='add.php'; </script>";
    } else {
        echo "<script> alert('Failed to Delete Technician!'); window.location.href ='add.php'; </script>";
    }
?>