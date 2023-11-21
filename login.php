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
   <link rel="stylesheet" href="style.css">
<body>
<div class="container">
      <div class="kiri">
        <img src="login.jpg" width="100%"  height="100%"/>
      </div>
      <div class="kanan">
        <div class="login">
          <center><h1>Login</h1></center>
          <br>
          <br>
          <form name="login" action="" method="post">
          <input type="text" name='username' class="inputan" placeholder="Username">
          <br><br>
          <input type="password" name='password' class="inputan" placeholder="Password">
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
          <br>
          <center><button type="submit" name="login" class="submitan">Login</button></center>
          </form>
          <br>
          
        </div>
      </div>
    </div>
</body>
</html>