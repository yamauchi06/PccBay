 <?php
function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}

function png2jpg($originalFile, $outputFile, $quality) {
    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
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


$uploadAlbum = $_POST['album'];
if(empty($uploadAlbum)){
	$uploadAlbum = '_ImageDump';
}	 
$albumURL = 'albums/'.$uploadAlbum.'/';
	 
if(isset($_FILES['file'])){
	include('SimpleImage.php'); 
	
	
	if (!file_exists($albumURL)) {
		$oldmask = umask(0);
	    mkdir($albumURL, 0777, true);
	    umask($oldmask);
	}

	foreach($_FILES['file']['tmp_name'] as $key => $tmp_name)
	{
	    $file_name = $key.$_FILES['file']['name'][$key];
	    $file_size =$_FILES['file']['size'][$key];
	    $file_tmp =$_FILES['file']['tmp_name'][$key];
	    $file_type=$_FILES['file']['type'][$key]; 
	    
	    move_uploaded_file($file_tmp,''.$albumURL.''.$_FILES['file']['name'][$key]);
	    
	    $ext = get_extension($_FILES['file']['name'][$key]);
	    
	    $newName = date("F-j-Y_g-i-a").'_'.generateRandomString();	 
	    
	    rename(''.$albumURL.''.$_FILES['file']['name'][$key], ''.$albumURL.''.$newName.'.'.$ext);
	    

	    if( copy(''.$albumURL.''.$newName.'.'.$ext, ''.$albumURL.'thumb/'.$newName.'.'.$ext) ){
				
			$Thumb = ''.$albumURL.'thumb/'.$newName.'.'.$ext;
			
			$imageFileType = pathinfo($Thumb,PATHINFO_EXTENSION);
			
			$imageFile = $Thumb;

			$width = 200;

			$info = getimagesize($imageFile);

			$aspectRatio = $info[1] / $info[0];

			$newHeight = (int)($aspectRatio * $width);

			$image = new SimpleImage(); 
			$image->load($Thumb); 
			$image->resize($width,$newHeight); 
			$image->save($Thumb);
		
		}

	    
	    
	    
	    echo json_encode('files uploaded');
	}
}else{
	echo json_encode('No files');
}






?>