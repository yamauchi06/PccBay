<?php
header("Content-Type: application/json");	
$output=array();

$check_id='124981';
$check_pc='02034520';	
	
// Make key
function mc_mykey($id){
	return substr(md5($id).sha1($id), 0, 64);
}
// Encrypt Function
function mc_encrypt($encrypt, $key){
    $encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
}
// Decrypt Function
function mc_decrypt($decrypt, $key){
    $decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}





if($_GET['action']=='mc_encrypt'){
	$student_id = $_POST['student_id'];
	$student_passcode = $_POST['student_passcode'];
	$secret=mc_mykey($student_id.$student_passcode);
	define('ENCRYPTION_KEY', $secret);
	
	if($student_id==$check_id && $student_passcode==$check_pc){
		$data = $_GET['action']( $student_id, ENCRYPTION_KEY);
		array_push($output, array(
			'id' => $student_id,
			'secret'=>$secret,
			'key'=>$data,
			'ukey'=>urlencode($data)
		));
	}else{
		echo('false');
	}
}

if($_GET['action']=='mc_decrypt'){
	define('ENCRYPTION_KEY', $_GET['secret']);
	$key = urldecode($_GET['key']);
	$output = $_GET['action']($key, ENCRYPTION_KEY);
}

echo json_encode($output, JSON_PRETTY_PRINT);

//EAGwZgnGFzX6qqh0mNhYi7LD%2FpCkGPyKTBFcqc3kbb1QnBOSv2tI75MdhC8GB9PyGzmyiMrA2tcD8MWILxXeZgr2bwXzBqTbs79CBSgPWvRVNUQinJkGmG3cY%2Bi62YNA%7CwZa8bBNXPlOLCdCOgj2wqGxZBvM7D%2BNjhDY2kLWKgzc%3D
//7a69400360e16ea26d74a27b0238e95aa63676a834b10bbaa8b0502953173fdc


?>