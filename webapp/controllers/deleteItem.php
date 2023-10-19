<?php
    session_start();
    include('konek.php');

    $username = $_GET['a'];
    $query = "DELETE FROM itemList WHERE itemName = '$username'";
    $result = mysqli_query($conn, $query);
    echo 'Success';

    header("location:../Manage-item.php");
?>