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
        ?>
        <a href="Customer-Home.php">Back</a><br>
        <?php
        $query = "SELECT * FROM cartList WHERE customerUsername = '$username'";
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
        ?>
        <form action="" method="POST">
        <input type="text" name="location" id="location" required>
        <br><br><span>Order Summary</span>
        <?php
            echo '<a href="Order-Page.php?a='.$tempName.'" name="adminName" name="adminName">Add Items</a><br><br>';
            $allTotal = 0;
            $query = "SELECT * FROM cartList WHERE customerUsername = '$username'";
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
            <input type="submit" value="Order">
        </form>
        <?php

    }    
    

    ?>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $destination = $_POST['location'];  

            $query = "INSERT INTO transactionList VALUES('', '$tempName', '$username', '$destination', '$allTotal')";
            $result = mysqli_query($conn, $query);
            echo "Success";
            

            $query = "SELECT * FROM transactionlist WHERE tenantUsername = '$tempName' AND customerUsername = '$username'";
            $result = mysqli_query($conn, $query);
            $row = $result -> fetch_array(MYSQLI_ASSOC);
            $orderId = $row['orderID'];

            $query2 = "SELECT * FROM cartlist WHERE tenantUsername = '$tempName' AND customerUsername = '$username'";
            $result2 = mysqli_query($conn, $query2);
            while($row2 = $result2 -> fetch_array(MYSQLI_ASSOC)){
                $item_name_per = $row2['itemName'];
                $item_qty_per = $row2['itemQuantity'];

                $insert_que = "INSERT INTO transactionItemList VALUES('$orderId', '$tempName', '$username', '$item_name_per', '$item_qty_per')";
                $insert_res = mysqli_query($conn, $insert_que);

                $delete_que = "DELETE FROM cartList WHERE customerUsername = '$username' AND tenantUsername = '$tempName' AND itemName = '$item_name_per' AND itemQuantity = '$item_qty_per'";
                $delete_res = mysqli_query($conn, $delete_que);
            }

            header("location:Customer-Home.php");
        }
    ?>

    

    
    
    
</body>
</html>