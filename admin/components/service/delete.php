<?php
    $q = $_GET['q'];

    include '../../includes/db_connection.php';

    $delequery = "DELETE FROM services WHERE id='$q'";
    
    if(mysqli_query($con,$delequery)){
        echo "<script> alert('Data Deleted !!');window.location.href ='add.php'; </script>";
    }else{
        echo "<script> alert('Data not Deleted !!') window.location.href ='add.php' </script>";
    }   
?>