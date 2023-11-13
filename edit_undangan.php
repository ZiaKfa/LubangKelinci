<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    if($_SESSION["role"] !== "hatter"){
        header("Location: index.php");
        exit;
    }

    $id_pengundang = $_GET["idpengundang"];
    $id_tamu = $_GET["idtamu"];
    $undangan_query = "SELECT * FROM undangan WHERE id_pengundang = $id_pengundang AND id_tamu = $id_tamu";
    $undangan_result = mysqli_query($mysqli, $undangan_query);
    $undangan = mysqli_fetch_assoc($undangan_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invitation</title>
</head>
<body>
    <h1>Edit Invitation Data</h1>
    <form action="" method="post">
        <label for="id_pengundang">Inviter :</label>
        <select name="id_pengundang" id="id_pengundang">
            <?php
                $user_query = "SELECT * FROM user WHERE role = 'hatter'";
                $user_result = mysqli_query($mysqli, $user_query);
                while($row = mysqli_fetch_assoc($user_result)){
                    echo "<option value='$row[id]'";
                    if($row["id"] == $id_pengundang){
                        echo "selected";
                    }
                    echo ">$row[nama]</option>";
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
                    echo "<option value='$row[id]'";
                    if($row["id"] == $id_tamu){
                        echo "selected";
                    }
                    echo ">$row[nama]</option>";
                }
            ?>
        </select>
        <br>
        <label for="tanggal">Date :</label>
        <input type="date" name="tanggal" id="tanggal" value="<?php echo $undangan['tanggal'] ?>">
        <br>
        <label for="jam">Time :</label>
        <input type="time" name="jam" id="jam" value="<?php echo $undangan['jam'] ?>">
        <br>
        <label for="tempat">Place :</label>
        <input type="text" name="tempat" id="tempat" value="<?php echo $undangan['tempat'] ?>">
        <br>
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        if(editUndangan($_POST) > 0){
            echo "<script>
                    alert('Invitation data changed');
                    document.location.href = 'undangan.php';
                </script>";
        }else{
            echo "<script>
                    alert('Failed to change invitation data or no change detected');
                </script>";
        }
    }
?>