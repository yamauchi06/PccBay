<?php
	header("Content-Type: application/json");
	//Includes	
	include_once("../includes/php/_db-config.php");
	include_once("functions.php");
	
	//Authenticate
	$root_app_id = "9827354187582375129873";
	oAuthAccess($root_app_id);

	// Default var set
	$mainJson = array();
	$query='';if(isset($_GET['q'])){$query=$_GET['q'];}
	$listBy='DESC';if(isset($_GET['l'])){$listBy=$_GET['l'];}
	
	//Set Query
	if(isset($_GET['page'])){
		include('querys.php'); }else{
		array_push($mainJson, 'Query not defined'); }
		
	//Run Query	
	if(!empty($slq_table)){
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
		if(empty($mainJson)){
			print return_graph('No query results', 'text', 'throw'); }else{
			print return_graph($mainJson, 'json'); }
	}else{
		print return_graph('No data table selected', 'text', 'throw'); }
?>