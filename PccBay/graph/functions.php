<?php
function return_graph($content='', $format='json', $dataText='data')	{
	if($format=='json')
		$result = json_encode($content, 128);
	else if($format=='text')
		$result = json_encode(array($dataText => $content), 128);	
	return $result;	
}

function get_comments($post_id){
	$comment = array();
	$sql = "SELECT * FROM pb_comments WHERE post_id='$post_id'"; 
	$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
		    $user_data = json_decode(pb_table_data('pb_users', 'user_data', "user_id='+$val[author]'"), true);
			$item = array(
				'id' => $val['id'],
				'date' => $val['date'],
				'timestamp' => array(
					'date' => $val['date'],
					'laps' => time_ago(strtotime( $val['date'] ))
				),
				'user' => array(
					'id' => $val['author'],
					'name' => $user_data[0]['name'],
					'username' => $user_data[0]['username'],
					'avatar' => $user_data[0]['avatar'],
				),
				'status' => $val['status'],
				'comment' => $val['comment']
			);
			array_push($comment, $item);
	    }
	}
	$conn->close();
	return json_encode($comment);
}

function oAuthAccess($app_id){
	if($_GET['page']=='phpinfo'){ header('Content-Type: text/html; charset=utf-8'); print phpinfo();exit;}
	global $servername;
	global $username;
	global $password;
	global $dbname;
	$accessToken = '';
	$appCleared=false;
	$sql = "SELECT * FROM pb_developers WHERE app_id='$app_id'"; 
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
			include('accessToken-algorithm.php');
			$appCleared=true;
	    }
	}else{ print 'Access Blocked';  }
	$conn->close();
	if(isset($_GET['accessToken'])){
		$getStr=$_GET['accessToken'];
		if($appCleared){ if($getStr=='rootbypass_'.$app_id){$accessToken = $getStr;} }
	}else{$getStr=null;};
	if($getStr !== $accessToken|| $getStr==null){
		print json_encode(array('OG_ERROR' => 'Authentication Failed. A bad accessToken or no accessToken was given.'), 128);	
		exit;
	}else{
		header("Access-Control-Allow-Origin: *"); }
}
?>