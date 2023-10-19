<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="controllers/prosesRegister.php" method="POST">
            <div>
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                <input type="text" pattern="[a-zA-Z]{1,}" name="username" id="username" placeholder="Username" required><br>
                <input type="text" name="phonenum" id="phonenum" placeholder="Phone Number" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required><br>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    <?php
        
    ?>
</body>
</html>