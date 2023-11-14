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
    <style>
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
            cellspacing: 0;
            padding: 10px;

        }
    </style>
</head>
<body>
    <h1>All inhabitant</h1>
    <p>Add new Inhabitant
        <a href="create_user.php">here</a>
    </p>
    <table>
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