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
    <title>Undangan</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Literata:wght@400;700&display=swap">

</head>
<body>
    <div id="container-undangan">
        <div id="kotak-undangan">
            <div class="undangan-tamu">
                Hello <?php echo "$nama_tamu "; ?> as <?php echo $username_tamu ?>!</p>
            </div>
            <div class="undangan-judul">
                Tea Time!
            </div>
            <div class="kalimat-cantik">
                Join us for tea & treats
            </div>
            <div class="deskripsi-undangan">
                <?php
                $monthAndDate = date("j F", strtotime($tanggal));
                echo $monthAndDate;
                ?> at <?php echo $jam?> pm
            </div>
            <div class="kalimat-cantik">
                <?php echo $tempat?>
            </div>
            <div class="logo-undangan">
                <img src="logo-undangan.png" alt="logo">
            </div>
            <div class="late-border">
                Don't be late!
            </div>
            <div class="undangan-ttd">
                <?php echo "$nama_pengundang "; ?> as <?php echo $username_pengundang ?>
            </div>
        </div>
    </div>
</body>
</html>
    <h1>Invitation</h1>
    <h3>You are invited to tea party</h3>
    <p>From : <?php echo "$nama_pengundang "; ?> as <?php echo $username_pengundang ?></p>
    <p>To : <?php echo "$nama_tamu "; ?> as <?php echo $username_tamu ?></p>
    <p>Date : <?php echo $tanggal; ?></p>
    <p>Time : <?php echo $jam; ?></p>
    <p>Place : <?php echo $tempat; ?></p>
</body>
</html>