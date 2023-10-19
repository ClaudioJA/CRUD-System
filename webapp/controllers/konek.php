<?php
    $conn = mysqli_connect('localhost', 'root', '');

    if(!$conn){
        echo "Gagal Connect Database!";
    }

    mysqli_select_db($conn, 'amdp_3');
?>