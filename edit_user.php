<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    if($_SESSION["role"]!== "hatter"){
        header("Location: index.php");
        exit;
    }
    if(!isset($_GET["id"])){
        header("Location: user.php");
        exit;
    }
    $id = $_GET["id"];
    $user_query = "SELECT * FROM user WHERE id = $id";
    $user_result = mysqli_query($mysqli, $user_query);
    $row = mysqli_fetch_assoc($user_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inhabitant</title>
</head>
<body>
<h1>Edit Inhabitant Data</h1>
        <form action="" method="post">
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" value="<?php echo $row["username"]; ?>">
            <br>
            <label for="nama">Name :</label>
            <input type="text" name="nama" id="nama" value="<?php echo $row["nama"]; ?>">
            <br>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>">
            <br>
            <label for="role">Role :</label>
            <select name="role" id="role">
                <option value="hatter">hatter</option>
                <option value="inhabitant">inhabitant</option>
            </select>
            <br>
            <input type="hidden" name ="id" value ="<?php echo $row["id"] ?>">
            <button type="submit" name="submit">Change Profile</button>
        </form>
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        if(editUser($_POST) > 0){
            echo "<script>
                    alert('Inhabitant data changed');
                    document.location.href = 'user.php';
                </script>";
        }else{
            echo "<script>
                    alert('Failed to change inhabitant data or no change detected');
                </script>";
        }
    }
?>