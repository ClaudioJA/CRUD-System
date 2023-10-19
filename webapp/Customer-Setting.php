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
        <input type="text" pattern="[a-zA-Z]{1,}" name="username" id="username" placeholder="Name" required><br>
        <input type="text" name="pnum" id="pnum" placeholder="Phone" required><br>
        <input type="email" name="email" id="email" placeholder="Email" required><br>
        <input type="submit" value="Update">
    </form>
    <a href="Customer-Change-Pass.php">Change Password</a>
    
    <?php
        include('controllers/konek.php');
        $newName = $_POST['username'];
        $newNum = $_POST['pnum'];
        $newMail = $_POST['email'];

        function valid_email($str) {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
    
        if(!valid_email($newMail)){
            echo "Failed";
        }
        else if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $query = "UPDATE mscustomer SET customerUsername = '$newName', customerPNumber = '$newNum', customerEmail = '$newMail' WHERE customerUsername = '$username'";
            $result = mysqli_query($conn, $query);
            echo "Success!";
        }

        
    ?>
    

</body>
</html>