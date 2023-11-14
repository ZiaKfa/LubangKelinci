<?php
    require_once("functions.php");
    if(isset($_SESSION["login"])){
        header("Location: index.php");
        exit;
    }  
    if(isset($_POST["login"])){
        $result = login($_POST);
        if($result){
            $_SESSION["login"] = true;
            $_SESSION["username"] = $result["username"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["id"] = $result["id"];
            echo "<script>
                    alert('login berhasil');
                    window.location.href = 'index.php';
                </script>";
            exit;
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
    <title>Login</title>
</head>
<style>
    h1{
        text-align: center;
        font: bold 30px Arial;
    }
</style>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Nickname :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Secret Word :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
    <a href="register.php">Register</a>
</body>
</html>