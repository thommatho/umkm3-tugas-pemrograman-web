<?php
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM staf WHERE id='$id'");
?>
<script>window.location="index.php?menu=staf";</script>
