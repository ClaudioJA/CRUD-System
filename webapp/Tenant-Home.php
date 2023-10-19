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
        if($_SESSION['isTenant'] == false){
            header("location:LandingPage.php");
        }
        include('controllers/konek.php');
        $username = $_SESSION['tenantName'];
    ?>
    <p>This is Tenant</p>
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"><?php echo $username; ?></button>
    <div id="myDropdown" class="dropdown-content">
        <a href="">Home</a>
        <a href="">Completed Order</a>
        <a href="Manage-Item.php">Manage Items</a>
        <a href="Tenant-Setting.php">Settings</a>
        <a href="controllers/logOut.php">Logout</a>
    </div>

    <?php
        include('controllers/konek.php');
        echo "<br><br>Current Orders : <br><br>";
        
        $query = "SELECT * FROM transactionList WHERE tenantUsername = '$username'";
        $result = mysqli_query($conn, $query);
        while($row = $result -> fetch_array(MYSQLI_ASSOC)){ 
            $itemRow = $row['orderID'];
            $icount_que = "SELECT * FROM transactionitemList WHERE orderID = '$itemRow'";
            $icount_res = mysqli_query($conn, $icount_que);
            $itemCount = mysqli_num_rows($icount_res);
            echo $row['customerUsername'];
            echo '<br>';
            echo $itemCount;
            echo ' item(s)<br>Place : ';
            echo $row['place'];
            echo '<br>Total : Rp. ';
            echo $row['totalPrice'];
            echo '<br><br><br>';
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