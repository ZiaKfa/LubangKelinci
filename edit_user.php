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
    <link rel="stylesheet" href="style.css">
    <style>
        input,input:focus,input:valid{
            width: 200px;
            height: 30px;
            border: none;
            border-radius: 5px;
            font-size: 28px;
        }
        
        .tabel-add-undangan{
            width: 20%;
            font-size: 30px;
            color: #FFFF;
        }

        select{
            width: 200px;
            border: none;
            height: 30px;
            border-radius: 5px;
        }
        .submit{
            width: 150px;
            font-size: 30px;
            height: 40px;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
<div class="container-admin">
        <img src="logo.png" alt="Logo" class="logo-admin">
        <div class="kotak-admin">
        <h1 style="color: #FFFF; text-align: left;">Add Invitation Data</h1><br>
        <form action="" method="post">
            <table class="tabel-add-undangan" cellpadding="15px">
                <tr>
                    <td><label for="username">Username :</label></td>
                    <td><input type="text" name="username" id="username" value="<?php echo $row["username"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama">Name :</label></td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo $row["nama"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td><input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="role">Role :</label></td>
                    <td>
                        <select name="role" id="role">
                            <option value="hatter">hatter</option>
                            <option value="inhabitant">inhabitant</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
            <button type="submit" name="submit">Change Profile</button>
        </form>
        </div>
    </div>
</body>
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