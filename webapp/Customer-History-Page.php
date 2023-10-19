<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <?php
        session_start();
        if($_SESSION['isCustomer'] == false){
            header("location:LandingPage.php");
        }
        $username = $_SESSION['custName'];

        include('controllers/konek.php');
        $query = "SELECT * FROM transactionlist WHERE customerUsername = '$username'";
        $result = mysqli_query($conn, $query);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        if($row != NULL){
            $tempName = $row['tenantUsername'];
            echo "Shop : ";
            echo $row['tenantUsername'];
            echo "<br>";
            echo "Delivered to : ";
            echo $row['customerUsername'];
            echo ' (';
            $query = "SELECT * FROM mscustomer WHERE customerUsername = '$username'";
            $result = mysqli_query($conn, $query);
            $row = $result -> fetch_array(MYSQLI_ASSOC);
            echo $row['customerPNumber'];
            echo ')<br>';
            echo 'Place : ';
        }
        else{
            echo "Cart is Empty";
        }
        
    if($row != NULL){
        
        $place_que = "SELECT * FROM transactionList WHERE tenantUsername = '$tempName' AND customerUsername = '$username'";
        $place_res = mysqli_query($conn, $place_que);
        $place_row = $place_res -> fetch_array(MYSQLI_ASSOC);
        echo $place_row['place'];
        
        echo '<br><br><a href="Add-Review-Page.php?a='.$tempName.'" name="adminName" name="adminName">Rate and Review</a>';
        
        ?>
        <br><br><span>Order Summary<br><br></span>
        <?php
            $allTotal = 0;
            $query = "SELECT * FROM transactionitemlist WHERE customerUsername = '$username'";
            $result = mysqli_query($conn, $query);
            while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
                $tempItemName = $row['itemName'];
                echo $row['itemName'];
                echo ' x ';
                echo $row['itemQuantity'];
                echo ' = ';
                $query2 = "SELECT * FROM itemlist WHERE tenantUsername = '$tempName' AND itemName = '$tempItemName'";
                $result2 = mysqli_query($conn, $query2);
                $row2 = $result2 -> fetch_array(MYSQLI_ASSOC);
                $singleTotal = $row['itemQuantity'] * $row2['itemPrice'];
                echo $singleTotal;
                echo '<br>';
                echo $row2['itemDesc'];
                echo '<br><br>';
                $allTotal = $allTotal + $singleTotal;
            }
            echo 'Total : ';
            echo $allTotal;
            ?>
            <br><br>
        
        <?php

    }    
    

    ?>

    
</body>
</html>