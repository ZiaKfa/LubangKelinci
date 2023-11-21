<?php
session_start();
require_once("config.php");
//fungsi register
function register($data){
    global $mysqli;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $nama = $data["nama"];
    $role = strtolower(stripslashes($data["role"]));
    $password = mysqli_real_escape_string($mysqli, $data["password"]);
    $password2 = mysqli_real_escape_string($mysqli, $data["password2"]);

    //pengecekan username
    $user = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($user)){
        echo "<script>
                alert('username sudah terdaftar, gunakan username lain');
            </script>";
        return false;
    }
    //pengecekan password
    if($password !== $password2){
        echo "<script>
               alert('Password tidak sesuai');
            </script>";
        return false;
    }
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //memasukan data ke database
    mysqli_query($mysqli, "INSERT INTO user(username,email,nama,role,password) VALUES('$username', '$email','$nama','inhabitant','$password')");
    return mysqli_affected_rows($mysqli);
}

//fungsi login
function login($data){
    global $mysqli;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($mysqli, $data["password"]);

    //pengecekan username
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1){
        //cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            return $row;
        }
    }
    echo "<script>
            alert('username atau password salah');
        </script>";
    return false;
}

function editUser($data){
    global $mysqli;
    $id = $data["id"];
    $username = strtolower(stripslashes($data["username"]));
    $nama = $data["nama"];
    $email = $data["email"];
    if(isset($data["role"])){
        $role = $data["role"];
        $update_query = "UPDATE user SET username = '$username', nama = '$nama', email = '$email', role = '$role' WHERE id = '$id'";
    } else {
        $update_query = "UPDATE user SET username = '$username', nama = '$nama', email = '$email' WHERE id = '$id'";
    }
    $update_result = mysqli_query($mysqli, $update_query);
    if($update_result){
        $affected_rows = mysqli_affected_rows($mysqli);
        if($affected_rows > 0){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function deleteUser($id){
    global $mysqli;
    $delete_query = "DELETE FROM user WHERE id = '$id'";
    $delete_result = mysqli_query($mysqli, $delete_query);
    if($delete_result){
        $affected_rows = mysqli_affected_rows($mysqli);
        if($affected_rows > 0){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function addUndangan($data){
    global $mysqli;
    $id_pengundang = $data["id_pengundang"];
    $id_tamu = $data["id_tamu"];
    $tanggal = $data["tanggal"];
    $jam = $data["jam"];
    $tempat = $data["tempat"];
    $insert_query = "INSERT INTO undangan(id_pengundang, id_tamu, tanggal, jam, tempat) VALUES('$id_pengundang', '$id_tamu', '$tanggal', '$jam', '$tempat')";
    mysqli_query($mysqli, $insert_query);
    return mysqli_affected_rows($mysqli);
}

function editUndangan($data){
    global $mysqli;
    $id_pengundang = $data["id_pengundang"];
    $id_tamu = $data["id_tamu"];
    $tanggal = $data["tanggal"];
    $jam = $data["jam"];
    $tempat = $data["tempat"];
    $update_query = "UPDATE undangan SET id_pengundang = '$id_pengundang', id_tamu = '$id_tamu', tanggal = '$tanggal', jam = '$jam', tempat = '$tempat' WHERE id_pengundang = '".$_GET["idpengundang"]."' AND id_tamu = '".$_GET["idtamu"]."' AND tanggal = '".$_GET["tanggal"]."'";
    $update_result = mysqli_query($mysqli, $update_query);
    if($update_result){
        $affected_rows = mysqli_affected_rows($mysqli);
        if($affected_rows > 0){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function deleteUndangan($pengundang,$tamu,$tanggal){
    global $mysqli;
    $delete_query = "DELETE FROM undangan WHERE id_pengundang = '$pengundang' AND id_tamu = '$tamu' AND tanggal = '$tanggal' ";
    $delete_result = mysqli_query($mysqli, $delete_query);
    if($delete_result){
        $affected_rows = mysqli_affected_rows($mysqli);
        if($affected_rows > 0){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function selectUndangan($id_pengundang, $id_tamu, $tanggal){
    global $mysqli;
    $select_query = "SELECT * FROM undangan WHERE id_pengundang = '$id_pengundang' AND id_tamu = '$id_tamu' AND tanggal = '$tanggal'";
    $select_result = mysqli_query($mysqli, $select_query);
    if($select_result){
        $affected_rows = mysqli_affected_rows($mysqli);
        if($affected_rows > 0){
            return mysqli_fetch_assoc($select_result);
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>