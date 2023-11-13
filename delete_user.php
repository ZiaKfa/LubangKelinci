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
    $id = $_GET["id"];
    if(deleteUser($id) > 0){
        echo "<script>
                alert('Inhabitant data deleted');
                document.location.href = 'user.php';
            </script>";
    }else{
        echo "<script>
                alert('Failed to delete inhabitant data');
            </script>";
    }
    
?>