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
    body{
      font-family: 'Judson';
      padding: auto;
      margin: auto;
    }
      .container{
        display: flex;
        height: 100vh;
      }
      .kiri{
        width: 50%;
        height: 100%;
      }
      
      .kanan{
        width: 40%;
        height: 100%;
      }
      
      .login{
        width: 50%;
        min-height: 50%;
        margin: auto;
        margin-top: 20%;
      }
      .inputan{
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 2px solid black;
        margin-top: 5px;
        width: 100%;
      }

      .inputan::placeholder{
        font-size: 16px;
        font-family: 'Judson';
      }
      
      .submitan{
        background-color: #5EB1D3;
        color: white;
        border-radius: 30px;
        font-size: 20px;
        padding-top: 5px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 5px;
        border: none;
        font-family: 'Judson';
      }

      .submitan:hover{
        background-color: white;
        color: #5EB1D3;
        border-radius: 30px;
        font-size: 20px;
        border: #5EB1D3 1px solid;
        padding-top: 5px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 5px;
        font-family: 'Judson';
        cursor: pointer;
      }
      
      .signup{
        font-size: 7px;
      }
</style>
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