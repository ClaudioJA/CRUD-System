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
        if($_SESSION['isTenant'] == false){
            header("location:LandingPage.php");
        }
        $username = $_SESSION['custName'];

        include('controllers/konek.php');
        $query = "SELECT * FROM mstenant WHERE tenantUsername = '$username'";
        $result = mysqli_query($conn, $query);
        echo "Current Picture : <br>";
    ?>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required><br>
        <input type="text" pattern="[a-zA-Z]{1,}" name="newUsername" id="newUsername" placeholder="Name" required><br>
        <label for="">Category</label><br>
        <input type="submit" value="Update">
    </form>
    <a href="Customer-Change-Pass.php">Change Password</a>
    
    <?php
        include('controllers/konek.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $newName = $_POST['newUsername'];
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif', 'svg'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
            }
            $query = "UPDATE mstenant SET tenantUsername = '$newName', image = '$imgContent' WHERE tenantUsername = '$username'";
            $result = mysqli_query($conn, $query);
            
            echo "Success!";
        }

        
    ?>
    

</body>
</html>