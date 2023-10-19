<?php
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pnum = $_POST['phonenum'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_pass'];

    function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }

    if(!valid_email($email)){
        echo "Failed";
    }
    else if($pass == $cpass && strlen($username) >= 5 && $pnum > 999999999 && strlen($pass) >= 6){
        include('konek.php');

        $query = "SELECT * FROM mscustomer WHERE customerUsername = '$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 0){
            $query = "INSERT INTO mscustomer VALUES('$email', '$username', '$pnum', '$pass')";
            $result = mysqli_query($conn, $query);
            header("location:../Login.php");
        }
        else{
            echo "Failure!";
        }
        
    }
    else{
        echo "Failure!";
    }

?>