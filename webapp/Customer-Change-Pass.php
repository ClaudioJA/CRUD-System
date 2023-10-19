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

    ?>

    <form action="" method="POST">
        <input type="password" name="oldPass" id="oldPass" placeholder="Current Password" required><br>
        <input type="password" name="newPass" id="newPass" placeholder="New Password" required><br>
        <input type="password" name="cPass" id="cPass" placeholder="Confirm Password" required><br>
        <input type="submit" value="Save">
    </form>
    
    
    <?php
        include('controllers/konek.php');
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $cPass = $_POST['cPass'];

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if($newPass == $cPass){
                $query = "UPDATE mscustomer SET customerPassword = '$newPass' WHERE customerUsername = '$username' AND customerPassword = '$oldPass'";
                $result = mysqli_query($conn, $query);
                echo "Success!";
            }
            else{
                echo "Failed!";
            }
        }
        else{
            echo "Failed!";
        }

        
    ?>
    

</body>
</html>