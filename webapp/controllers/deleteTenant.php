<?php
    session_start();
    include('konek.php');

    $username = $_SESSION['link'];
    $query = "DELETE FROM mstenant WHERE tenantUsername = '$username'";
    $result = mysqli_query($conn, $query);
    echo 'Success';

    header("location:../Manage-Tenant.php");
?>