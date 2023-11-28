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
    <title>Edit Invitation</title>
</head>
<body>
    <div class="container-admin">
        <img src="logo.png" alt="Logo" class="logo-admin">
        <div class="kotak-admin">
            <h1 style="color: #FFFF; text-align: left;">Add Invitation Data</h1><br>
            <form action="" method="post">
                <table class="tabel-add-undangan" cellpadding="15px">
                    <tr>
                        <td>Inviter</td>
                        <td>:</td>
                        <td><select name="id_pengundang" id="id_pengundang">
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
                    </td>
                    </tr>
                    <tr>
                        <td>Guest</td>
                        <td>:</td>
                        <td><select name="id_tamu" id="id_tamu">
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
                        </select></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td><input type="date" name="tanggal" id="tanggal"></td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>:</td>
                        <td><input type="time" name="jam" id="jam"></td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td>:</td>
                        <td><input type="text" name="tempat" id="tempat" value = "<?php echo $undangan["tempat"] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="submit" class="submit">submit</button>
                            <button class="submit"><a href="undangan.php">back</a></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
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