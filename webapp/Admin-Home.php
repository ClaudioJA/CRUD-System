<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <?php
        session_start();
        if($_SESSION['isAdmin'] == false){
            header("location:LandingPage.php");
        }
    ?>
    <p>This is Admin</p>
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"><?php echo $_SESSION['adminName']; ?></button>
    <div id="myDropdown" class="dropdown-content">
        <a href="">Home</a>
        <a href="Manage-Admin.php">Manage Admin</a>
        <a href="">Manage Categories</a>
        <a href="controllers/logOut.php">Logout</a>
    </div>
    <br><br>
    <a href="Add-Tenant.php">Add Tenant</a><br><br>

    <?php
        include('controllers/konek.php');
        $query = "SELECT * FROM mstenant";
        $result = mysqli_query($conn, $query);
        echo "<br>";
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            $tname = $row['tenantUsername'];
            echo '<a href="Update-Tenant.php?a='.$tempName.'" name="adminName" name="adminName">'.$tname.'</a><br><br><br>';
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
</div>
</body>
</html>