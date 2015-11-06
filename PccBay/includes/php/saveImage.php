<?php
$remoteImage = $_SERVER['DOCUMENT_ROOT'].'/images/user-data/'.$_GET['a'].'/'.$_GET['f'];
$ext = pathinfo($remoteImage, PATHINFO_EXTENSION);
header('Content-Type: image/'.$ext);
print file_get_contents($remoteImage);
?>