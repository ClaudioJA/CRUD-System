<?php
    session_start();
    $note = $_POST['note'];
    $quan = $_POST['qty'];
    $tenantName = $_POST['shop-name'];
    $custName = $_SESSION['custName'];
    $itemName = $_POST['iname'];
    // echo $custName;
    // echo '<br>';
    // echo $tenantName;
    // echo '<br>';
    // echo $itemName;
    include('konek.php');
    $query = "SELECT * FROM cartList WHERE tenantUsername != '$tenantName' AND customerUsername = '$custName'";
    $result = mysqli_query($conn, $query); 
    // $row = $result -> fetch_array(MYSQLI_ASSOC);

    if(mysqli_num_rows($result) > 0){
        $query = "DELETE FROM cartList WHERE tenantUsername != '$tenantName' AND customerUsername = '$custName'";
        $result = mysqli_query($conn, $query);
        $query = "INSERT INTO cartList VALUES('$custName', '$tenantName', '$itemName', '$quan')";
        $result = mysqli_query($conn, $query);
    }
    else{
        $query = "SELECT * FROM cartList WHERE tenantUsername = '$tenantName' AND customerUsername = '$custName' AND itemName = '$itemName'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
            $query = "UPDATE cartList SET itemQuantity = '$quan' WHERE tenantUsername = '$tenantName' AND customerUsername = '$custName' AND itemName = '$itemName'";
            $result = mysqli_query($conn, $query);
            echo "Success";
        }
        else{
            $query = "INSERT INTO cartList VALUES('$custName', '$tenantName', '$itemName', '$quan')";
            $result = mysqli_query($conn, $query);
            echo "Success";
        }
    }
    header("location:../Order-Page.php?a=$tenantName");

    // 
    // $query = "INSERT INTO  WHERE (customerEmail = '$email' || customerUsername = '$email') AND customerPassword = '$pass'";
    // $result = mysqli_query($conn, $query);
    // $row = $result -> fetch_array(MYSQLI_ASSOC);
    // $username = $row['customerUsername'];
    // if(mysqli_num_rows($result) == 1){
    //     session_start();
    //     $_SESSION['isCustomer'] = true;
    //     $_SESSION['isTenant'] = false;
    //     $_SESSION['isAdmin'] = false;
    //     $_SESSION['custName'] = $username;
    //     // setcookie("nim", $nim);
    //     header("location:../Customer-Home.php");
    // }

?>