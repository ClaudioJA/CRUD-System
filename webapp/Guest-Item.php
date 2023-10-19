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

        include('controllers/konek.php');
        $shopName = $_GET['a'];
        ?>
        <a href="LandingPage.php">Back</a><br>
        <?php
        echo $shopName;
        
        echo '<br><a href="Review-Page.php?a='.$shopName.'">Show Review</a>';

        

        $query = "SELECT * FROM itemList WHERE tenantUsername = '$shopName'";
        $result = mysqli_query($conn, $query);
        echo '<br><br>';
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            $tname = $row['itemName'];
            echo $tname;
            echo '<br>';
            echo $row['itemDesc'];
            echo '<br>';
            echo $row['itemPrice'];
            echo '<br><br>';
        }
        
    ?>
    

</body>
</html>