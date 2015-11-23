<?php
	header("Content-Type: application/json");
	//Includes	
	include_once("../includes/php/_db-config.php");
	include_once('../includes/php/commonFunctions.php');
	include_once("functions.php");
	
	//Token Get
	if(isset($_GET['app_id'])){
		header('Location: accessToken.php?app_id='.$_GET['app_id'].'&secret='.$_GET['secret'].'');
		exit;
	}
	
	//Authenticate
	$root_app_id = "9827354187582375129873";
	oAuthAccess($root_app_id);

	// Default var set
	$mainJson = array();
	$query='';if(isset($_GET['q'])){$query=$_GET['q'];}if($query=='null'){$query='';}
	$listBy='DESC';if(isset($_GET['l'])){$listBy=$_GET['l'];}
	
	//Set Query
	if(isset($_GET['page'])){
		if($_GET['page']=='smartsearch'){
			include('smartsearch.php');
			exit;
		}
		include('querys.php'); }else{
		array_push($mainJson, 'Query not defined'); }
		
	//Run Query	
	if(!empty($slq_table)){
		if(isset($_GET['loop'])){ $loop=$_GET['loop']; }else{$loop=0;};$count=0;
		while($count <= $loop){
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($val = $result->fetch_assoc()) {
					include('arrays.php');
			    }
			}
			$conn->close();
		$count++;
		}
		
		if( !isset($_GET['html']) ){
			if( empty($mainJson) ){
				print return_graph('No query results', 'text', 'throw'); 
			}else{
				print return_graph($mainJson, 'json');
			}
		}
	}else{
		print return_graph('No data table selected', 'text', 'throw'); }
?>