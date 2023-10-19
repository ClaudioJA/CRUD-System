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
    
    <span style="font-size:30px;padding:5px;">UniEat</span><br>
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"><?php echo $_SESSION['custName']; ?></button>
    <div id="myDropdown" class="dropdown-content">
        <a href="">Home</a>
        <a href="Customer-History.php">History</a>
        <a href="Customer-Setting.php">Settings</a>
        <a href="controllers/logOut.php">Logout</a>
    </div>
    <br><br>

    

    <?php
        include('controllers/konek.php');
        $query = "SELECT * FROM mstenant";
        $result = mysqli_query($conn, $query);
        echo '<a href="Cart.php">Cart</a><br><br><br>';
        echo "<br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            $tname = $row['tenantUsername'];
            echo '<a href="Order-Page.php?a='.$tempName.'" name="adminName" name="adminName">'.$tname.'</a><br><br><br>';
        }
        
    ?>
    
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
    }
    </script>
</body>
</html>