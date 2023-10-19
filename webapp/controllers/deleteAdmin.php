<?php
    session_start();
    include('konek.php');

    $username = $_SESSION['link'];
    $query = "DELETE FROM msadmin WHERE adminUsername = '$username'";
    $result = mysqli_query($conn, $query);
    echo 'Success';

    header("location:../Manage-Admin.php");
?>