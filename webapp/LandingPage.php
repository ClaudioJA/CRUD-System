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

    ?>
    
    <span style="font-size:30px;padding:5px;">UniEat</span><br>
    <a href="Login.php">Login</a>
    <span>   </span>
    <a href="Register.php">Register</a>
    <br><br>

    

    <?php
        include('controllers/konek.php');
        $query = "SELECT * FROM mstenant";
        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $tempName = $row['tenantUsername'];
            ?>
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style="width:150px;height:150px;" /><br>
            <?php
            $tname = $row['tenantUsername'];
            echo '<a href="Guest-Item.php?a='.$tempName.'" name="adminName" name="adminName">'.$tname.'</a><br><br><br>';
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