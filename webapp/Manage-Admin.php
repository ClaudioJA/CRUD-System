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

    ?>

    <a href="Add-Admin.php">Add Admin</a><br>
    <a href="Update-Admin.php">Update Admin</a><br>


    <?php

        $query = "SELECT * FROM msadmin";
        $result = mysqli_query($conn, $query);
        echo "<br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['adminUsername'];
            echo '<a href="Update-Admin.php?a='.$tempName.'" name="adminName">'.$tempName.'</a><br>';
        }

    ?>

</body>
</html>