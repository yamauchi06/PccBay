<?php
	header("Content-Type: application/json");	
	include_once("../php/_db-config.php");
	$sql = $_GET['sql'];
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
			print $val[ $_GET['get'] ];
	    }
	}
	$conn->close();
?>