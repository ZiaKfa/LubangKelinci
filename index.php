<?php
    require_once("functions.php");
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    $username = $_SESSION["username"];
    $query = "SELECT * FROM user where username = '$username'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alice in Wonderland</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet'>
    
</head>
<body>
    <div id="container-index">
        <nav class="navbar">
            <img src="logo.png" alt="Logo" class="logo">
            <div class = "navlink">
                <a href="#home">Home</a>
                <a href="page1.html">Story</a>
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        
    </div>
    <a href="<?php 
        if($row["role"] == "hatter"){
            echo "undangan.php";
        }else{
            echo "show_undangan.php?idpengundang=2&idtamu=".$row["id"]."&tanggal=".date("Y-m-d");
        }
    ?>"><button class="inv"name="invite">Your Invitation</button></a>
</body>
</html>