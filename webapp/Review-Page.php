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
        
        include('controllers/konek.php');
        // $username = $_SESSION['custName'];
        $shopName = $_GET['a'];

        $query = "SELECT * FROM mstenant WHERE tenantUsername = '$shopName'";
        $result = mysqli_query($conn, $query);
        echo "<br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            echo $row['tenantUsername'];
        }

        $query = "SELECT * FROM reviewList WHERE tenantUsername = '$shopName'";
        $result = mysqli_query($conn, $query);
        echo "<br><br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            echo $row['customerUsername'];
            echo '<br>';
            echo $row['reviewBody'];
            echo '<br>';
            echo $row['rating'];
            echo '<br><br>';
        }
        

    ?>

    

</body>
</html>