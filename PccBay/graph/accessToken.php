<?php
	header("Content-Type: application/json");
	if(!empty($_GET['app_id'])){
		$app_id = $_GET['app_id'];
		include_once("../includes/php/_db-config.php");
		$sql = "SELECT * FROM pb_developers WHERE app_id='$_GET[app_id]'"; 
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($val = $result->fetch_assoc()) {
				$accessToken = '';
				include('accessToken-algorithm.php');
				print $accessToken;
		    }
		}else{
			print 'Access Blocked'; 
		}
		$conn->close();
		
	}else{
		print 'Access Blocked';
	}
?>