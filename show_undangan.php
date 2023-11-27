<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    if(!isset($_GET["idpengundang"]) || !isset($_GET["idtamu"]) || !isset($_GET["tanggal"])){
        echo "<script>
                alert('You are not invited Yet !');
                window.location.href = 'index.php';
            </script>";
    }

    $id_pengundang = $_GET["idpengundang"];
    $id_tamu = $_GET["idtamu"];
    $tanggal = $_GET["tanggal"];
    if($data = selectUndangan($id_pengundang,$id_tamu,$tanggal)){
        $pengundang_query = "SELECT * FROM user WHERE id = '$id_pengundang'";
        $pengundang_result = mysqli_query($mysqli, $pengundang_query);
        $pengundang = mysqli_fetch_assoc($pengundang_result);
        $nama_pengundang = $pengundang["nama"];
        $username_pengundang = $pengundang["username"];
        $tamu_query = "SELECT * FROM user WHERE id = '$id_tamu'";
        $tamu_result = mysqli_query($mysqli, $tamu_query);
        $tamu = mysqli_fetch_assoc($tamu_result);
        $nama_tamu = $tamu["nama"];
        $username_tamu = $tamu["username"];
        $tanggal = $data["tanggal"];
        $jam = $data["jam"];
        $tempat = $data["tempat"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Invitation</title>
</head>
<body>
    <h1>Invitation</h1>
    <h3>You are invited to tea party</h3>
    <p>From : <?php echo "$nama_pengundang "; ?> as <?php echo $username_pengundang ?></p>
    <p>To : <?php echo "$nama_tamu "; ?> as <?php echo $username_tamu ?></p>
    <p>Date : <?php echo $tanggal; ?></p>
    <p>Time : <?php echo $jam; ?></p>
    <p>Place : <?php echo $tempat; ?></p>
</body>
</html>