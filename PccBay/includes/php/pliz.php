<?php
	class pliz{
		
		function sql_connect(){
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
			return $conn;
		}
		function sql_query($conn, $sql){ 
			return $conn->query($sql); 
		}
		function sql_is_callback($callback){
			if( ctype_alpha($callback) || ctype_digit($callback) ){
				return true; }else{
				return false;
			}
		}
		function db($sql, $callback='', $callbackNoResults=''){
			//SQL CONNECT
			$conn=sql_connect();
			//SQL QUERY
			$query=sql_query($conn, $sql);
			//SQL CLOSE
			$conn->close();
			//CHECK CALLBACKS
			if($callback==''){
				return $query;
			}else{
				if ($query->num_rows > 0) {
					if( sql_is_callback($callback)==true ){
						return $callback; }else{
						while($row = $query->fetch_assoc()) {
							$callback($row);
						}
					}
				}else{
					if( sql_is_callback($callbackNoResults)==true ){
						return $callbackNoResults; }else{
						$callbackNoResults();
					}
				}
			}
		}
	
	//Close pliz	
	}	
?>