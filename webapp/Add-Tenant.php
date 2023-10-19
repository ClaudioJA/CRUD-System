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

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <input type="text" name="username" id="username" placeholder="Username" required><br>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="number" name="phonenum" id="phonenum" placeholder="Phone Number" required><br>
            <input type="file" name="image">
        </div>
        <button type="submit">Register</button>
    </form>

    <?php
        include('controllers/konek.php');
        $randstring = '';
        function RandomString()
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numbers = '0123456789';
            $randstring = '01234567';
            for ($i = 0; $i < 5; $i++) {
                $randstring[$i] = $characters[rand(0, strlen($characters))];
            }
            for ($i = 5; $i < 8; $i++) {
                $randstring[$i] = $numbers[rand(0, strlen($numbers))];
            }

            return $randstring;
        }
        $randstring = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pnum = $_POST['phonenum'];
            $pass = RandomString();
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 

            

            if(strlen($username) >= 5){
                include('controllers/konek.php');

                $query = "SELECT * FROM mstenant WHERE tenantUsername = '$username'";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) == 0){
                    $query = "INSERT INTO mstenant VALUES('$email', '$username', '$pnum', '$pass', '$imgContent')";
                    $result = mysqli_query($conn, $query);
                    header("location:Admin-Home.php");
                }
                else{
                    echo "Failure!";
                }

                
            }
        }

    ?>

</body>
</html>