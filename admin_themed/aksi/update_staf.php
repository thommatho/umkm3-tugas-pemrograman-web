<?php
$id       = $_POST['id'];
$username = $_POST['username'];
$nama     = $_POST['nama'];

if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    mysqli_query($conn, "UPDATE staf SET username='$username', password='$password', nama='$nama' WHERE id='$id'");
} else {
    mysqli_query($conn, "UPDATE staf SET username='$username', nama='$nama' WHERE id='$id'");
}
?>
<script>window.location="index.php?menu=staf";</script>
