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

    if(!isset($_GET["idpengundang"]) || !isset($_GET["idtamu"])){
        header("Location: undangan.php");
        exit;
    }
    $id_pengundang = $_GET["idpengundang"];
    $id_tamu = $_GET["idtamu"];
    $tanggal = $_GET["tanggal"];
    if(deleteUndangan($id_pengundang, $id_tamu, $tanggal)){
        echo "<script>
            alert('Invitation deleted successfully');
            document.location.href = 'undangan.php';
            </script>";
        exit;
    } else {
        echo "<script>
            alert('Failed to delete invitation');
            document.location.href = 'undangan.php';
            </script>";
        exit;
    }
?>