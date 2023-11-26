<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    $username = $_SESSION["username"];
    $user_query = "SELECT * FROM user where username = '$username'";
    $user_result = mysqli_query($mysqli, $user_query);
    $row = mysqli_fetch_assoc($user_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
</head>
<body>
    <div class="container-profile">
        <div class="profile">
            <h1 style="color: #FFFF;">Profile</h1>
            <form action="" method="post">
                <table cellpadding="8px">
                        <tr>
                            <td class="label-profile">Username :</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="username" id="username" value="<?php echo $row["username"]; ?>"
                                class="inputan-profile"></td>
                        </tr>
                        <tr>
                            <td class="label-profile">Full Name :</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama" id="nama" value="<?php echo $row["nama"];?>"
                                class="inputan-profile"></td>
                        </tr>
                        <tr>
                            <td class="label-profile">Email :</td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" id="email" value="<?php echo $row["email"];?>"
                                class="inputan-profile"></td>
                        </tr>
                        <tr>
                            <td class="label-profile">Secret word :</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" id="password"
                                placeholder="Enter secret word to change your profile"
                                class="inputan-profile"></td>
                        </tr>
                        <tr>
                            <input type="hidden" name ="id" value="<?php echo $row["id"];?>">
                        </tr>
                </table>
                <br>
                <br>
                <button type="submit" name="submit" class="submitan">Save Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        if(password_verify($_POST["password"], $row["password"])){
           if(editUser($_POST)){
                echo "<script>
                        alert('Profile changed');
                        document.location.href = 'index.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Failed to change profile');
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Wrong secret word mate !');
                </script>";
        }
    }
?>