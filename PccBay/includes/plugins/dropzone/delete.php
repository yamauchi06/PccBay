<?php
	include_once('../../php/_db-config.php');
	if(isset($_POST['id'])){ $file_id=$_POST['id']; }
	if(isset($_GET['id'])){ $file_id=$_GET['id']; }
	
	$file_path='';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
	$sql = "SELECT * FROM pb_safe_image Where uid='$file_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) { 
		while($row = $result->fetch_assoc()) {
			$file_path = $row['string'];
		}
	}else{
		echo 'No file exists!';
	}
	$conn->close();

	if(!empty($file_path)){
		
		if( unlink($_SERVER['DOCUMENT_ROOT'].$file_path) ){
		
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
			$sql = "DELETE FROM pb_safe_image WHERE uid='$file_id'";
			if ($conn->query($sql) === TRUE) {
			    echo "Record deleted successfully";
			} else {
			    echo "Error deleting record: " . $conn->error;
			}
			$conn->close();
		}
		
	}	
?>