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
        $shopName = $_GET['a'];

        include('controllers/konek.php');
        
        echo "Rate and Review<br><br>";
    ?>

    <form action="" method="POST">
        <label for="">Rating [1-5] : </label>
        <input type="number" step="0.1" name="rating" id="rating" required>
        <br>
        <label for="">Review : </label>
        <input type="text" name="review" id="review">
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $ratingscore = $_POST['rating'];
            $reviewbody = $_POST['review'];
            
            $query = "INSERT INTO reviewlist VALUES('$shopName', '$username', '$reviewbody', '$ratingscore')";
            $result = mysqli_query($conn, $query);
            header("location:Customer-History-Page.php?a='$shopName'");
        }

    ?>


</body>
</html>