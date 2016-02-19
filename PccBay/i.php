<?php
include_once($_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.'/includes/php/_pb_min_functions.php');	
if(!isset($_GET['day_code'])){
	header('Content-Type: application/json');
	print 'day_code required.';
	exit;
}
if(!isset($_GET['safe_image'])){
	header('Content-Type: application/json');
	print 'Image Key required.';
	exit;
}	
$url_string = explode(':', $_GET['safe_image']);	
$remoteImage = $_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.''.pb_encrypt_decrypt('decrypt', $url_string[2]).''.$url_string[0].'/'.$url_string[1];

$confirm = pb_time('token:check', array('key'=>md5(pb_encrypt_decrypt('decrypt', $url_string[2])), 'token'=>$_GET['day_code']));

if( file_exists($remoteImage) && $confirm ){
	$ext = pathinfo($remoteImage, PATHINFO_EXTENSION);
	header('Content-Type: image/'.$ext);
	print file_get_contents($remoteImage);
}
elseif(file_exists($remoteImage) && !$confirm  ){
	header('Content-Type: application/json');
	print "This image has expired.";
}
else{
	header('Content-Type: image/Gif');
	print file_get_contents($_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.'/images/interior-images/placeholder.jpg');
}
?>