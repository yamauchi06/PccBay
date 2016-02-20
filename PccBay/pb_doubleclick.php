<?php
	include_once('includes/php/_db-config.php');
	include_once('includes/php/_pb_db.php');
	
	$path = $_GET['path'];
	$id = $_GET['id'];
	$src = $_GET['source'];
	$market = $_GET['marketplace'];
	
	if($market !== 'free_user_ads'){
		pb_db("UPDATE pb_doubleclick SET hits = hits + 1 WHERE id='$id'");
	}
	
	header('Location: '.$path.'#pb_doubleclick='.$src);
?>