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
    <title>Home</title>
</head>
<body>
    <h1>
        Welcome <a href="profile.php"><?php echo $username; ?></a>
    </h1>
    <p>Or should i say <?php echo $row['nama'] ?> !</p>
    <p>See all your invitation card
        <a href="undangan.php">here</a>
    </p>
    <p>See all the inhabitant
        <a href="user.php">here</a>
    </p>
    <a href="logout.php">Logout</a>
</body>
</html>
