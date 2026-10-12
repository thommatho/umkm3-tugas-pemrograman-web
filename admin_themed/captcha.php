<?php
//captcha.php
session_start();

$karakter = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
$captcha = substr(str_shuffle($karakter),0,4);

$_SESSION['captcha'] = $captcha;

header('Content-type: image/png');

$img = imagecreate(120,40);
$bg = imagecolorallocate($img,255,255,255);
$textcolor = imagecolorallocate($img,0,0,0);

imagestring($img,5,35,10,$captcha,$textcolor);

imagepng($img);
imagedestroy($img);
?>