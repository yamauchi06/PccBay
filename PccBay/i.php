<?php
if(!isset($_GET['day_code'])){
	header('Content-Type: application/json');
	print 'day_code required.';
	exit;
}
if(!isset($_GET['i'])){
	header('Content-Type: application/json');
	print 'Image Key required.';
	exit;
}	
$url_string = explode(':', $_GET['i']);	
$remoteImage = $_SERVER['DOCUMENT_ROOT'].'/images/user-data/'.$url_string[0].'/'.$url_string[1];
if(file_exists($remoteImage) && $_GET['day_code']==md5(date('MdY')).sha1(date('MdY'))){
	$ext = pathinfo($remoteImage, PATHINFO_EXTENSION);
	header('Content-Type: image/'.$ext);
	print file_get_contents($remoteImage);
}
elseif(file_exists($remoteImage) && $_GET['day_code']!==md5(date('MdY')).sha1(date('MdY'))){
	header('Content-Type: application/json');
	print 'Image path has expired.';
}
else{
	header('Content-Type: image/Gif');
	print file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/interior-images/postPlaceholder.gif');
}
?>