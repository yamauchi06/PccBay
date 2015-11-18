<?php
	include('commonFunctions.php');
	$pliz = new pliz;
	
	echo $pliz->db("SELECT * FROM pb_post");
	
?>