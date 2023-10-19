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
        echo $_GET['a'];

    ?>

    <form action="" method="POST">
        <div>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="text" name="username" id="username" placeholder="Username" required><br>
            <input type="number" name="phonenum" id="phonenum" placeholder="Phone Number" required><br>
            <div class="radioBox">
                <input type="radio" id="" name="radio" value="Male" checked>
                <label for="">Male</label>
                <input type="radio" id="" name="radio" value="Female">
                <label for="">Female</label>
            </div>
        </div>
        <button type="submit">Save</button>
    </form>

    <form action="controllers/deleteAdmin.php" method="POST">
        <input type="hidden" name="adminName" value="<?=$_SESSION['link']?>">
        <button type="submit">Delete</button>
    </form>

    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $old = $_SESSION['link'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $pnum = $_POST['phonenum'];
            $gen = $_POST['radio'];

            if(strlen($username) >= 5){
                include('controllers/konek.php');
                $query = "UPDATE msadmin SET adminEmail = '$email', adminUsername = '$username', adminPNumber = '$pnum', adminGender = '$gen' WHERE adminUsername = '$old'";
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