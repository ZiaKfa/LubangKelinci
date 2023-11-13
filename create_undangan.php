<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] != "hatter"){
            header("Location: index.php");
            exit;
        }
    }
    if(isset($_POST["submit"])){
        if(addUndangan($_POST) > 0){
            echo "<script>
                    alert('Invitation created');
                    document.location.href = 'undangan.php';
                </script>";
        }else{
            echo "<script>
                    alert('Failed to create Invitation');
                </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Invitation</title>
</head>
<body>
    <h1>Add Invitation Data</h1>
    <form action="" method="post">
        <label for="id_pengundang">Inviter :</label>
        <select name="id_pengundang" id="id_pengundang">
            <?php
                $user_query = "SELECT * FROM user WHERE role = 'hatter'";
                $user_result = mysqli_query($mysqli, $user_query);
                while($row = mysqli_fetch_assoc($user_result)){
                    echo "<option value='$row[id]'>$row[nama]</option>";
                }
            ?>
        </select>
        <br>
        <label for="id_tamu">Guest :</label>
        <select name="id_tamu" id="id_tamu">
            <?php
                $user_query = "SELECT * FROM user WHERE role = 'inhabitant'";
                $user_result = mysqli_query($mysqli, $user_query);
                while($row = mysqli_fetch_assoc($user_result)){
                    echo "<option value='$row[id]'>$row[nama]</option>";
                }
            ?>
        </select>
        <br>
        <label for="tanggal">Date :</label>
        <input type="date" name="tanggal" id="tanggal">
        <br>
        <label for="jam">Time :</label>
        <input type="time" name="jam" id="jam">
        <br>
        <label for="tempat">Place :</label>
        <input type="text" name="tempat" id="tempat">
        <br>
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>