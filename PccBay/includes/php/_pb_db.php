<?php
	function pb_sql_connect(){
		$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
		return $conn;
	}
	function pb_sql_query($conn, $sql){ 
		return $conn->query($sql); 
	}
	function pb_sql_is_callback($callback){
		if( ctype_alpha($callback) || ctype_digit($callback) ){
			return true; }else{
			return false;
		}
	}
	function pb_db($sql, $callback='', $callbackNoResults='', $return='array'){
		//SQL CONNECT
		$conn=pb_sql_connect();
		//SQL QUERY
		$query=pb_sql_query($conn, $sql);
		//SQL CLOSE
		$conn->close();
		//CHECK CALLBACKS
		if($callback==''){
			return $query;
		}
		else if($callback===true){
			return pb_switch( $query->fetch_assoc() );
		}
		else{
			if ($query->num_rows > 0) {
				if( pb_sql_is_callback($callback)==true ){
					return $callback; }else{
					while($row = $query->fetch_assoc()) {
						if($return=='array'){ $callback($row); }else{
							$callback(pb_switch($row));
						}
					}
				}
			}else{
				if( pb_sql_is_callback($callbackNoResults)==true ){
					return $callbackNoResults; }else{
					$callbackNoResults();
				}
			}
		}
	}
?>