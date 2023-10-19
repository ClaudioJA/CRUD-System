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
        $username = $_SESSION['tenantName'];
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <input type="file" name="image" required><br>
            <input type="text" name="username" id="username" placeholder="Item Name" required><br>
            <input type="number" name="price" id="price" placeholder="Price" required><br>
            <input type="text" name="desc" id="desc" placeholder="Description" required><br>
            
        </div>
        <button type="submit">Register</button>
    </form>

    <?php
        include('controllers/konek.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $itemname = $_POST['username'];
            $itemdesc = $_POST['desc'];
            $price = $_POST['price'];
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif', 'svg'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
            }
            include('controllers/konek.php');
            $query = "INSERT INTO itemList VALUES('$itemname', '$itemdesc', '$username', '$price', '$imgContent')";
            $result = mysqli_query($conn, $query);
            header("location:Manage-Item.php");
        }

    ?>

</body>
</html>