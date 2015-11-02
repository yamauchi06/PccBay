<?php
function time_ago($pt){$et=time()-$pt;if($et<1){return'0 seconds';}$a=array(365*24*60*60=>'year',30*24*60*60=>'month',24*60*60=>'day',60*60=>'hour',60=>'minute',1=>'second');$ap=array('year'=>'years','month'=>'months','day'=>'days','hour'=>'hours','minute'=>'minutes','second'=>'seconds');foreach($a as $secs=>$str){$d=$et/$secs;if($d>=1){$r=round($d);return $r .' '. ($r>1?$ap[$str]:$str).' ago';}}}

function return_graph($content='', $format='json', $dataText='data')	{
	if($format=='json')
		$result = json_encode($content, JSON_PRETTY_PRINT);
	else if($format=='text')
		$result = json_encode(array($dataText => $content), JSON_PRETTY_PRINT);	
	return $result;	
}

function oAuthAccess($app_id){
	global $servername;
	global $username;
	global $password;
	global $dbname;
	$accessToken = '';
	$sql = "SELECT * FROM pb_developers WHERE app_id='$app_id'"; 
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
			include('accessToken-algorithm.php');
	    }
	}else{ print 'Access Blocked';  }
	$conn->close();
	if(isset($_GET['accessToken'])){$getStr=$_GET['accessToken'];}else{$getStr=null;};
	if($getStr !== $accessToken|| $getStr==null){
		print json_encode(array('Authentication Failed' => 'A bad accessToken or no accessToken was supplied.'), JSON_PRETTY_PRINT);	
		exit;
	}else{
		header("Access-Control-Allow-Origin: *"); }
}
?>