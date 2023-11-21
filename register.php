<?php
require_once("functions.php");
if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}  
if(isset($_POST["register"])){
    if(register($_POST) > 0){
        echo "<script>
                alert('New inhabitant added');
                window.location.href = 'login.php';
            </script>";
    }else{
        echo mysqli_error($mysqli);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="kiri">
            <img src="register.jpg" alt="Registration" width="100%" height="100%">
        </div>
        <div class="kanan">
            <div class="register">
                <h1>Registration</h1>
                <br>
                <form action="" method="post">
                    <table width="100%" cellpadding="15px">
                        <tr>
                            <td><input type="text" name="username" placeholder="Username" class="inputan"></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" placeholder="Email" class="inputan"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="fullname" placeholder="Full Name" class="inputan"></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="Secret Word" class="inputan"></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password2" placeholder="Confirm your secret word"
                                class="inputan"></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <input type="submit" name="register" value="Sign Up" class="submitan">
                    <p class="reminder">Already have an account? <a href="login.html"><i>Sign in</i></a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>