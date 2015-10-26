<?php
session_name('com_pccbay_user');
session_start('');	

include_once('../../php/_db-config.php');	
	 
$backStep = '../../../';

$date_format = 'Y_j_m';

$cropImagesWidth = 900;

$albumURL = $backStep.'/images/user-data/'.date($date_format).'/';

$imagePath = '/images/user-data/'.date($date_format).'/';


function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function countFolder($dir) {
	return (count(scandir($dir)) - 2);
}

function lastDir($path){
	$files = scandir($path, SCANDIR_SORT_DESCENDING);
	return $files[0];
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}

function convertImage($originalImage, $outputImage, $quality)
{
    // jpg, png, gif or bmp?
    $exploded = explode('.',$originalImage);
    $ext = $exploded[count($exploded) - 1]; 

    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($originalImage);
    else if (preg_match('/png/i',$ext))
        $imageTmp=imagecreatefrompng($originalImage);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($originalImage);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($originalImage);
    else
        return 0;

    // quality is a value from 0 (worst) to 100 (best)
    imagejpeg($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);

    return 1;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!file_exists($albumURL)){
	if (!mkdir($albumURL, 0777)) {
	    die('Failed to create folders...');
	}
}


function addToDb($title, $size, $type, $file, $string){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $_POST;
		
		$uid = generateRandomString();
		$alt = $title;
		$date = date("F j, Y, g:i a");
		$author = $_SESSION['user_id'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO pb_safe_image (uid, title, alt, size, type, date, author, file, string) 
		VALUES ('$uid', '$title', '$alt', '$size', '$type', '$date', '$author', '$file', '$string')";
		
		if ($conn->query($sql) === TRUE) {
			//print 'done';
		} else {
		    echo "Error updating record: " . $conn->error;
		}
   	
   	$conn->close();
   	
   	return $uid;
}
	 
if(isset($_FILES['file'])){
	
    $file_name =$_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type']; 
    
    $move = move_uploaded_file($file_tmp, $albumURL.$_FILES['file']['name']);
    if($move){
	    $ext = get_extension($_FILES['file']['name']);
	    $newName = md5(date("F-j-Y_g-i-a:s").'_').generateRandomString();	 
	    rename(''.$albumURL.''.$_FILES['file']['name'], ''.$albumURL.''.$newName.'.'.$ext);

/*
	    if($ext !== 'jpg'){
		    convertImage($albumURL.$newName.'.'.$ext, $albumURL.$newName.'.jpg', 100);
		    unlink($albumURL.$newName.'.'.$ext);
		    $ext = 'jpg';
	    }
*/

		$width = $cropImagesWidth;		
		$Thumb = $albumURL.$newName.'.'.$ext;
		$imageFileType = pathinfo($Thumb,PATHINFO_EXTENSION);
		$imageFile = $Thumb;
		$info = getimagesize($imageFile);
		if($info[0] >= $cropImagesWidth){
			include('tinyImage.php'); 
			$aspectRatio = $info[1] / $info[0];
			$newHeight = (int)($aspectRatio * $width);
			$image = new SimpleImage(); 
			$image->load($Thumb); 
			$image->resize($width,$newHeight); 
			$image->save($Thumb);	
		}
		
		
		
		echo addToDb($_FILES['file']['name'], $info[0].':'.$info[1], $ext, $newName.'.'.$ext, $imagePath.$newName.'.'.$ext);
	    //echo $imagePath.$newName.'.'.$ext;
    }else{
	    echo exit_status('Move failed');
    }
}else{
	echo exit_status('No files');
}
?>