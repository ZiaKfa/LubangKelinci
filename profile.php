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
    <title>Profile</title>
</head>
<body>
    <h1>Your Profile</h1>
        <form action="" method="post">
            <label for="username">Nickname :</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
            <br>
            <label for="nama">Name :</label>
            <input type="text" name="nama" id="nama" value="<?php echo $row["nama"]; ?>">
            <br>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>">
            <br>
            <label for="password">Secret Word</label>
            <input type="password" name="password" id="password" placeholder="Enter your secret word to change profile">
            <br>
            <input type="hidden" name ="id" value ="<?php echo $row["id"] ?>">
            <button type="submit" name="submit">Change Profile</button>
        </form>
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