<?php
$username = $_POST['username'];
$password = md5($_POST['password']);
$nama     = $_POST['nama'];

$stmt = $conn->prepare("INSERT INTO staf (username, password, nama) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $nama);
$stmt->execute();
?>
<script>window.location="index.php?menu=staf";</script>
