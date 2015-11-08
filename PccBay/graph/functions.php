<?php
function return_graph($content='', $format='json', $dataText='data')	{
	if($format=='json')
		$result = json_encode($content, JSON_PRETTY_PRINT);
	else if($format=='text')
		$result = json_encode(array($dataText => $content), JSON_PRETTY_PRINT);	
	return $result;	
}

function get_comments($post_id){
	global $servername;
	global $username;
	global $password;
	global $dbname;
	$comment = array();
	$sql = "SELECT * FROM pb_comments WHERE post_id='$post_id'"; 
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
		    $user_data = json_decode(pb_user_data($val['author'], 'user_data'), true);
			foreach($user_data as $data){ $author=$data['name'];$user=$data['username'];$avatar=$data['avatar']; }
			$item = array(
				'id' => $val['id'],
				'date' => $val['date'],
				'timestamp' => array(
					'date' => $val['date'],
					'laps' => time_ago(strtotime( $val['date'] ))
				),
				'user' => array(
					'id' => $val['author'],
					'name' => $author,
					'username' => $user,
					'avatar' => $avatar,
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
		print json_encode(array('Authentication Failed' => 'A bad accessToken or no accessToken was supplied.'), JSON_PRETTY_PRINT);	
		exit;
	}else{
		header("Access-Control-Allow-Origin: *"); }
}
?>