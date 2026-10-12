<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$captcha  = $_POST['captcha'];

if($captcha != $_SESSION['captcha']){
    header("location:login.php?pesan=1");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM staf WHERE username='$username' AND password='$password'");
$data  = mysqli_fetch_assoc($query);

$o = 1;
if (mysqli_num_rows($query) > 0){

    $_SESSION['login']    = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['level']    = $data['level'];

    header("location:index.php");

} else {

    header("location:login.php?pesan=1");

}
?>
