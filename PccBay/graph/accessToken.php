<?php
	header("Content-Type: application/json");
	if(!empty($_GET['app_id'])){
		$app_id = $_GET['app_id'] or '';
		$secret = $_GET['secret'] or '';
		include_once("../includes/php/_db-config.php");
		$sql = "SELECT * FROM pb_developers WHERE app_id='$app_id' AND secret='$secret'"; 
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($val = $result->fetch_assoc()) {
				$accessToken = '';
				include_once('accessToken-algorithm.php');
				print json_encode(array('token'=>$accessToken, 'expires'=>date("F j, Y").', 12:00:00 pm'), JSON_PRETTY_PRINT);
		    }
		}else{
			print json_encode(array('Access Blocked'), JSON_PRETTY_PRINT);
		}
		$conn->close();
		
	}else{
		print json_encode(array('Access Blocked'), JSON_PRETTY_PRINT);
	}
?>