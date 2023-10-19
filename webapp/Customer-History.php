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
        echo "Previous Orders : <br><br>";
        
        $query = "SELECT * FROM transactionList WHERE customerUsername = '$username'";
        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            $img_query = "SELECT * FROM mstenant WHERE tenantUsername = '$tempName'";
            $img_res = mysqli_query($conn, $img_query);
            $img_row = $img_res -> fetch_array(MYSQLI_ASSOC);
            ?>
        
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img_row['image']); ?>" style="width:150px;height:150px;" /><br>
            
            <?php
            echo '<a href="Customer-History-Page.php?a='.$tempName.'" name="adminName" name="adminName">'.$tempName.'</a><br>';
            echo $row['totalPrice'];
            echo '<br><br>';
        }
        
    ?>
    

</body>
</html>