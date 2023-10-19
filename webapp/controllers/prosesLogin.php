<?php
    $email = $_POST['username'];
    $pass = $_POST['password'];

    include('konek.php');
    $query = "SELECT * FROM `mscustomer` WHERE (customerEmail = '$email' || customerUsername = '$email') AND customerPassword = '$pass'";
    $result = mysqli_query($conn, $query);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $username = $row['customerUsername'];
    if(mysqli_num_rows($result) == 1){
        session_start();
        $_SESSION['isCustomer'] = true;
        $_SESSION['isTenant'] = false;
        $_SESSION['isAdmin'] = false;
        $_SESSION['custName'] = $username;
        // setcookie("nim", $nim);
        header("location:../Customer-Home.php");
    }

    $query = "SELECT * FROM `mstenant` WHERE (tenantEmail = '$email' || tenantUsername = '$email') AND tenantPassword = '$pass'";
    $result = mysqli_query($conn, $query);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $username = $row['tenantUsername'];
    if(mysqli_num_rows($result) == 1){
        session_start();
        $_SESSION['isCustomer'] = false;
        $_SESSION['isTenant'] = true;
        $_SESSION['isAdmin'] = false;
        $_SESSION['tenantName'] = $username;
        // setcookie("nim", $nim);
        header("location:../Tenant-Home.php");
    }

    $query = "SELECT * FROM `msadmin` WHERE (adminEmail = '$email' || adminUsername = '$email') AND adminPassword = '$pass'";
    $result = mysqli_query($conn, $query);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $username = $row['adminUsername'];
    if(mysqli_num_rows($result) == 1){
        session_start();
        $_SESSION['isCustomer'] = false;
        $_SESSION['isTenant'] = false;
        $_SESSION['isAdmin'] = true;
        $_SESSION['adminName'] = $username;
        // setcookie("nim", $nim);
        header("location:../Admin-Home.php");
    }


    echo "Failed";

?>