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

    <form action="" method="POST">
        <div>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="text" pattern="[a-zA-Z]{1,}" name="username" id="username" placeholder="Username" required><br>
            <input type="number" name="phonenum" id="phonenum" placeholder="Phone Number" required><br>
            <div class="radioBox">
                <input type="radio" id="" name="radio" value="Male" checked>
                <label for="">Male</label>
                <input type="radio" id="" name="radio" value="Female">
                <label for="">Female</label>
            </div>
        </div>
        <button type="submit">Register</button>
    </form>

    <?php
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
            $email = $_POST['email'];
            $username = $_POST['username'];
            $pnum = $_POST['phonenum'];
            $gen = $_POST['radio'];
            $pass = RandomString();
            
            function valid_email($str) {
                return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
            }
        
            if(!valid_email($email)){
                echo "Failed";
            }
            else if(strlen($username) >= 5){
                include('controllers/konek.php');

                $query = "SELECT * FROM msadmin WHERE adminUsername = '$username'";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) == 0){
                        
                    

                    $query = "INSERT INTO msadmin VALUES('$email', '$username', '$pnum', '$pass', '$gen')";
                    $result = mysqli_query($conn, $query);

                    // use PHPMailer\PHPMailer\PHPMailer; 
                    // use PHPMailer\PHPMailer\SMTP; 
                    // use PHPMailer\PHPMailer\Exception; 

                    require 'PHPMailer/Exception.php'; 
                    require 'PHPMailer/PHPMailer.php'; 
                    require 'PHPMailer/SMTP.php'; 

                    $mail = new PHPMailer; 
                    $mail->isSMTP();
                    $mail->Host = 'unieat.asia.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'UniEat@unieat.com';
                    $mail->Password = 'UniEat123';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465; 
                    
                    $mail->setFrom('unieat@gmail.com', 'UniEat'); 

                    $mail->addAddress($email); 
                    
                    $mail->isHTML(true); 
                    
                    $mail->Subject = 'UniEat : Admin Account Details'; 
                    
                    $bodyContent = '<h1>Your UniEat Admin Account.</h1>'; 
                    $bodyContent .= '<p>Username : '. $username .'<br>Password : '. $pass .'<br>Please change the password as soon as you login into the account.</p>'; 
                    $mail->Body    = $bodyContent; 
                    

                    if(!$mail->send()) { 
                        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
                    } else { 
                        echo 'Message has been sent.'; 
                    }


                    header("location:Manage-Admin.php");
                }
                else{
                    echo "Failure!";
                }
            }
            else{
                echo "Failure!";
            }
        }

    ?>

</body>
</html>