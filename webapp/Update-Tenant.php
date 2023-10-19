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
        if($_SESSION['isAdmin'] == false){
            header("location:LandingPage.php");
        }
        
        include('controllers/konek.php');
        $_SESSION['link']=$_GET['a'];
        $tenName = $_GET['a'];
        

        $query = "SELECT * FROM mstenant 
        WHERE tenantUsername = '$tenName'";

        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br><?php
        }
        echo $_GET['a'];
    ?>

    <form action="" method="POST">
        <div>
            <input type="text" name="username" id="username" placeholder="Username" required><br>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="number" name="phonenum" id="phonenum" placeholder="Phone Number" required><br>
        </div>
        <button type="submit">Save</button>
    </form>

    <form action="controllers/deleteTenant.php" method="POST">
        <input type="hidden" name="adminName" value="<?=$_SESSION['link']?>">
        <button type="submit">Delete</button>
    </form>

    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $old = $_SESSION['link'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $pnum = $_POST['phonenum'];

            if(strlen($username) >= 5){
                include('controllers/konek.php');
                $query = "UPDATE mstenant SET tenantEmail = '$email', tenantUsername = '$username', tenantPNumber = '$pnum' WHERE tenantUsername = '$old'";
                $result = mysqli_query($conn, $query);

                echo "Success!";
            }
            else{
                echo "Failure!";
            }
        }

    ?>

</body>
</html>