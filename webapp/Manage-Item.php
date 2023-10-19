<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <?php
        session_start();
        if($_SESSION['isTenant'] == false){
            header("location:LandingPage.php");
        }
        include('controllers/konek.php');
        $username = $_SESSION['tenantName'];

        ?>
        <a href="Tenant-Home.php">Back</a><br>
        <?php

        $query = "SELECT * FROM mstenant 
        WHERE tenantUsername = '$username'";
        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br><?php
        }
        echo $username;
        echo '<br><br><a href="Add-Item.php?a='.$username.'" name="adminName" name="adminName">New Items</a><br><br><br>';

        $query = "SELECT * FROM itemList WHERE tenantUsername = '$username'";
        $result = mysqli_query($conn, $query);
        echo "<br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['itemName'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            </a><?php
            $tname = $row['tenantUsername'];
            echo $tempName;
            echo '<br>';
            echo $row['itemDesc'];
            echo '<br>';
            echo $row['itemPrice'];
            echo'<br>';
            echo '<a href="Update-Item.php?a='.$tempName.'" name="adminName" name="adminName">Edit</a><br>';
            echo '<a href="controllers/deleteItem.php?a='.$tempName.'" name="adminName" name="adminName">Delete</a><br><br><br>';
        }
    ?>

    
    

</body>
</html>