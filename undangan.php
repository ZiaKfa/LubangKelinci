<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $query = "SELECT * FROM undangan where id_pengundang = '$id'";
    $result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Invitation</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
    <style>
        th{
            background-color: #A4A3A3;
            border-left: solid 1px #A4A3A3;
            border-right: solid 1px #A4A3A3;
            border-top: solid 1px black;
            border-bottom: solid 1px black;
        }

        td{
            background-color: white;
            border-left: solid white;
            border-right: solid white;
            border-top: solid 1px black;
            border-bottom: solid 1px black;
        }
    </style>
</head>
<body>
<div class="container-admin">
        <img src="logo.png" alt="Logo" class="logo-admin">
        <br>
        <div class="kotak-admin">
            <h1 style="color: white; text-align: left;">All Inhabitants</h1>
            <h3 style="color: white;">Add new Invitation <a href="create_undangan.php">here</a></h3>
            <br>
            <table class="tabel-user">
                <tr>
                    <th>No</th>
                    <th>Guest</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
        <tr>
            <?php 
                $num = 1;
                $user_query = "SELECT * FROM user";
                $user_result = mysqli_query($mysqli, $user_query);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$num."</td>";
                    while($row2 = mysqli_fetch_assoc($user_result)){
                        if($row["id_tamu"] == $row2["id"]){
                            echo "<td>".$row2["nama"]."</td>";
                        }
                    }
                    mysqli_data_seek($user_result, 0);
                    echo "<td>".$row["tanggal"]."</td>";
                    echo "<td>".$row["jam"]."</td>";
                    echo "<td>".$row["tempat"]."</td>";
                    echo "<td><a href='edit_undangan.php?idpengundang=".$row["id_pengundang"]."&idtamu=".$row["id_tamu"]."&tanggal=".$row["tanggal"]."'>Edit</a> | <a href='delete_undangan.php?idpengundang=".$row["id_pengundang"]."&idtamu=".$row["id_tamu"]."&tanggal=".$row["tanggal"]."'>Delete</a> | <a href='show_undangan.php?idpengundang=".$row["id_pengundang"]."&idtamu=".$row["id_tamu"]."&tanggal=".$row["tanggal"]."'>Show</a></td>";
                    echo "</tr>";
                    $num++;
                }
            ?>
        </tr>


    </table>
</body>
</html>