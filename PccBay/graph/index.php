<?php
	$format='application/json';
	if(!empty($_GET['format'])){$format=$_GET['format'];}
	header("Content-Type: ".$format);
	
	if( !isset($_GET['errors']) ){
		error_reporting(0);
		ini_set('display_errors', 0);
	}
	
	//Includes	
	include_once("../includes/php/_db-config.php");
	include_once('../includes/php/commonFunctions.php');
	include_once("functions.php");
	
	//Token Get
	if(isset($_GET['app_id'])){ include('accessToken.php'); exit; }
	
	//Authenticate
	$root_app_id = "9827354187582375129873";
	oAuthAccess($root_app_id);

	// Default var set
	$mainJson = array();
	$query='';if(isset($_GET['q'])){$query=$_GET['q'];}if($query=='null'){$query='';}
	$listBy='DESC';if(isset($_GET['l'])){$listBy=$_GET['l'];}
	$max=10000000;if(isset($_GET['max'])){$max=$_GET['max'];}
	
	//Set Query
	if(isset($_GET['page'])){
		if($_GET['page']=='smartsearch'){
			include('smartsearch.php');
			exit;
		}
		else if($_GET['page']=='addtocart'){
			include('addtocart.php');
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
				$i=0;
			    while($val = $result->fetch_assoc()) {
					include('arrays.php');
					if($i==$max){break;}
					$i++;
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