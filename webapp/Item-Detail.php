<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if($_SESSION['isCustomer'] == false){
            header("location:LandingPage.php");
        }
        
        include('controllers/konek.php');
        $username = $_SESSION['custName'];
        $itemName = $_GET['b'];
        $shopName = $_GET['a'];

        $query = "SELECT * FROM itemList WHERE itemName = '$itemName' AND tenantUsername = '$shopName'";
        $result = mysqli_query($conn, $query);

        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            $tname = $row['itemName'];
            echo $tname;
            echo '<br>';
            echo $row['itemDesc'];
            echo '<br><br>';
            // echo '<br><br><br>';
        }

    ?>

    <form action="controllers/addToCart.php" method="POST">
        <div>
            <input type="hidden" name="iname" id="iname" value="<?php echo "$itemName"; ?>">
            <input type="text" name="note" id="note" placeholder="Note" required><br>
            <input type="number" name="qty" id="qty" placeholder="Quantity" required><br>
            <input type="hidden" name="shop-name" id="shop-name" value="<?php echo "$shopName"; ?>">
        </div>
        <button type="submit">Add to Cart</button>
    </form>

</body>
</html>