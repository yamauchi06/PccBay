<?php
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
				$r=array(
					'token'=>$accessToken, 
					'expir'=>date("F j, Y").', 12:00:00 pm',
					'user'=>$val['user'],
					'perm'=>$val['permissions'],
					'data'=>$val['user_data']
				);
				print json_encode($r, 128);
		    }
		}else{
			print json_encode(array('Access Blocked'), 128);
		}
		$conn->close();
		
	}
	elseif(!empty($_GET['access_token'])){
		$token = $_GET['access_token'].'==';
		print pb_time('token:check', array('token'=>$token));;
	}
	else{
		print json_encode(array('Access Blocked'), 128);
	}
?>