<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    $user_query = "SELECT * FROM user";
    $user_result = mysqli_query($mysqli, $user_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
            <br>
            <table class="tabel-user">
                <tr>
                    <th>No</th>
                    <th>Nickname</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
        <tr>
            <?php 
                $num = 1;
                while($row = mysqli_fetch_assoc($user_result)){
                    echo "<tr>";
                    echo "<td>".$num."</td>";
                    echo "<td>".$row["username"]."</td>";
                    echo "<td>".$row["nama"]."</td>";
                    echo "<td>".$row["role"]."</td>";
                    echo "<td><a href='edit_user.php?id=".$row["id"]."'>Edit</a> | <a href='delete_user.php?id=".$row["id"]."'>Delete</a></td>";
                    echo "</tr>";
                    $num++;
                }
            ?>
        </tr>
</body>
</html>