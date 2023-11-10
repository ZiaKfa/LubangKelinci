<?php
require_once("config.php");
//fungsi register
function register($data){
    global $mysqli;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $nama = strtolower(stripslashes($data["nama"]));
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
    mysqli_query($mysqli, "INSERT INTO user(username,email,nama,password) VALUES('$username', '$email','$nama', '$password')");
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
