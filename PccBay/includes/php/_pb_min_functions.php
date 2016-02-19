<?php
	function objectToArray($d) {if (is_object($d)) {$d = get_object_vars($d);}if (is_array($d)) {return array_map(__FUNCTION__, $d);}else {return $d;}}
	function arrayToObject($d) {if (is_array($d)) {return (object) array_map(__FUNCTION__, $d);}else {return $d;}}
	function pb_switch($d, $set=''){
		if(empty($set)){
			if(!empty($d)){
				if(is_array($d)) { $r = arrayToObject($d); }
				if(is_object($d)){ $r = objectToArray($d); }
				return $r;
			}else{
				return false;
			}
		}
		else if($set=='object'){
			return arrayToObject($d);
		}
		else if($set=='array'){
			return objectToArray($d);
		}
	}
	function pb_encrypt_decrypt($action, $string, $secret_key = '91621871872415724817581275', $secret_iv = '1723612767316827368') {
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash('sha256', $secret_key);
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);	
	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }
	    return $output;
	}
	  // PHP strtotime compatible strings
	  function dateDiff($time1, $time2, $doSwop=false, $precision = 6) {
	    // If not numeric then convert texts to unix timestamps
	    if (!is_int($time1)) {
	      $time1 = strtotime($time1);
	    }
	    if (!is_int($time2)) {
	      $time2 = strtotime($time2);
	    }
	 
	    // If time1 is bigger than time2
	    // Then swap time1 and time2
		if ($time1 > $time2 && $doSwop==true) {
	      $ttime = $time1;
	      $time1 = $time2;
	      $time2 = $ttime;
	    }
	 
	    // Set up intervals and diffs arrays
	    $intervals = array('year','month','day','hour','minute','second');
	    $diffs = array();
	 
	    // Loop thru all intervals
	    foreach ($intervals as $interval) {
	      // Create temp time from time1 and interval
	      $ttime = strtotime('+1 ' . $interval, $time1);
	      // Set initial values
	      $add = 1;
	      $looped = 0;
	      // Loop until temp time is smaller than time2
	      while ($time2 >= $ttime) {
	        // Create new temp time from time1 and interval
	        $add++;
	        $ttime = strtotime("+" . $add . " " . $interval, $time1);
	        $looped++;
	      }
	 
	      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
	      $diffs[$interval] = $looped;
	    }
	    
	    $count = 0;
	    $times = array();
	    // Loop thru all diffs
	    foreach ($diffs as $interval => $value) {
	      // Break if we have needed precission
	      if ($count >= $precision) {
	        break;
	      }
	      // Add value and interval 
	      // if value is bigger than 0
	      if ($value > 0) {
	        // Add s if value is not 1
	        if ($value != 1) {
	          $interval .= "s";
	        }
	        // Add value and interval to times array
	        $times[] = $value . " " . $interval;
	        $count++;
	      }
	    }
	 
	    // Return string with times
	    return implode(", ", $times);
	  }
	function pb_time($action='', $options=array(), $callback=null){
		$options = pb_switch(array_merge(array(
		  "format" => "F j, Y, g:i:s a T",
		  "start"  => date("F j, Y, g:i:s a T"),
		  "end"    => date("F j, Y, g:i:s a T"),
		  "expire" => 0,
		  "key"	   => null, 
		  "token"  => null
		), $options));
		$output=false;
		if(empty($action)){ $output = date($options->format); }
		elseif($action=='diff'){
			if(!ctype_digit($options->start)){ $options->start = strtotime($options->start); }
			if(!ctype_digit($options->end))  { $options->end   = strtotime($options->end  ); }
			$output = $options->end - $options->start;
		}
		elseif(strpos($action, 'token') !== false) {
			$token_parts = explode(':', $action);
			if(!empty($token_parts[1]) && $token_parts[1]=='new'){
				$date = new DateTime( $options->start );
				$date->modify($options->expire);
				$end_date = $date->format($options->format);
				$data = array(
					"start" => $options->start,
					"end" => $end_date,
					"expire" => $options->expire
				);
				$output = pb_encrypt_decrypt('encrypt', json_encode($data), $options->key);
				$output = str_replace('=', '', $output);
			}
			elseif(!empty($token_parts[1]) && $token_parts[1]=='check'){
				$decrypt = json_decode(pb_encrypt_decrypt('decrypt',$options->token.'==', $options->key));
				if( strtotime(date($options->format)) < strtotime(date($options->format, strtotime($decrypt->end))) ){
					$output = true;
				}
			}
			else{
				$json = json_decode(pb_encrypt_decrypt('decrypt', $options->token.'==', $options->key));
				$s_date = $json->start;
				$e_date = $json->end;
				$life = $json->expire;
				$die = dateDiff(date($options->format), $e_date);
				if(empty($die)){ $die = '0'; }else{ $die = "in about ".$die; }
				
				$output = json_encode(array(
					"start" => $json->start,
					"end" => $json->end,
					"life" => $json->expire,
					"die" => $die
				));
			}
		}
		return $output;	
	}	
	function pb_safe_image_structure($string, $dir="/images/user-data/", $expire='+1 hour'){
		$dir_hidden = pb_encrypt_decrypt('encrypt', $dir);
		$day_code = pb_time('token:new', array('expire'=>$expire, 'key'=>md5($dir)));
		return '/?safe_image='.str_replace('/', ':', str_replace($dir, '', $string) ).':'.$dir_hidden.'&day_code='.$day_code; 
	}
	function pb_is_image($string){
		$string = str_replace('/?safe_image=', '', $string);
		$url_string = explode(':', $string);	
		$remoteImage = $_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.''.pb_encrypt_decrypt('decrypt', $url_string[2]).''.$url_string[0].'/'.$url_string[1];
		return $remoteImage;
/*
		if(file_exists($remoteImage)){
			return true;
		}
*/
	}
	function time_ago($ptime)
	{
	    $etime = time() - $ptime;
	
	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }
	
	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );
	
	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}
?>