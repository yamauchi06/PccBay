<?php
$remoteImage = $_SERVER['DOCUMENT_ROOT'].'/images/user-data/'.$_GET['a'].'/'.$_GET['f'];
if(file_exists($remoteImage)){
	$ext = pathinfo($remoteImage, PATHINFO_EXTENSION);
	header('Content-Type: image/'.$ext);
	print file_get_contents($remoteImage);
}else{
	header('Content-Type: image/Gif');
	print file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/interior-images/postPlaceholder.gif');
}
?>