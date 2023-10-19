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
        if($_SESSION['isTenant'] == false){
            header("location:LandingPage.php");
        }
        
        include('controllers/konek.php');
        $_SESSION['link']=$_GET['a'];
        $itemName = $_GET['a'];
        $itemTempName = $_GET['a'];

        $query = "SELECT * FROM itemList 
        WHERE itemName = '$itemName'";

        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br><?php
        }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <input type="file" name="image"><br>
            <input type="text" name="username" id="username" placeholder="Item Name" required><br>
            <input type="number" name="price" id="price" placeholder="Price" required><br>
            <input type="text" name="desc" id="desc" placeholder="Description" required><br>
        </div>
        <button type="submit">Save</button>
    </form>

    <?php
        include('controllers/konek.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $itemNew = $_POST['username'];
            $itemdesc = $_POST['desc'];
            $price = $_POST['price'];
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif', 'svg'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 

            include('controllers/konek.php');
            $query = "UPDATE itemList SET itemName = '$itemNew', itemDesc = '$itemdesc', itemPrice = '$price', image = '$imgContent' WHERE itemName = '$itemTempName'";
            $result = mysqli_query($conn, $query);
        }

    ?>

</body>
</html>