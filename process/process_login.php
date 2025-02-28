<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

session_start();


//var_dump($password);
//die();
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
if(mysqli_num_rows($query) != 0){
    $row = mysqli_fetch_assoc($query);
    
    
    session_start();
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['password_raw'] = $_POST['password'];
    $_SESSION['alertShown'] = true;
    
    
    if($row['role'] == 'admin') {
        
        
        header("Location: ../dashboardadmn.php?page=21232f297a57a5a743894a0e4a801fc3");
    
    }else if($row['role'] == 'ATC'){
        header("Location: ../dashboardatc.php?page=a3ac61932ac17091f7b6c0b56618a5b4");

    }

}else{
    $_SESSION['login_error'] = "Username atau password salah.";
    header("Location: ../index.php");
}
?>