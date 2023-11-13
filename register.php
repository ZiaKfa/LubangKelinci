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
    <title>Register</title>
</head>
<body>
    <h1>Register Page</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Nickname :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
            </li>
            <li>
                <label for="nama">Name :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="role">Role :</label>
                <select name="role" id="role">
                    <option value="hatter">hatter</option>
                    <option value="inhabitant">inhabitant</option>
                </select>
            <li>
                <label for="password">Secret Word :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">Confirm The Secret Word :</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
    <a href="login.php">Login</a>
</body>
</html>