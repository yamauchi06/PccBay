<?php
	include_once('_db-config.php');
	
	if(!empty($_GET['sessionSet'])){ $_SESSION[$_GET['sessionSet']] = $_GET['value']; }
	if(!empty($_GET['sessionUnSet'])){ unset( $_SESSION[$_GET['sessionUnSet']] ); }
	
	// START PB DATABASE CONNECTIONS
	function pb_sql_connect(){
		$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
		return $conn;
	}
	function pb_sql_query($conn, $sql){ 
		return $conn->query($sql); 
	}
	function pb_db($sql, $callback='', $callbackNoResults=''){
		$conn=pb_sql_connect();
		$query=pb_sql_query($conn, $sql);
		$conn->close();
		if($callback==''){
			return $query;
		}else{
			if ($query->num_rows > 0) {
				while($row = $query->fetch_assoc()) {
					$callback($row);
				}
			}else{
				if(function_exists($callbackNoResults)){ $callbackNoResults(); }else{ return $callbackNoResults; }
			}
		}
	}
	// END PB DATABASE CONNECTIONS

	function domain($type='url'){
		if($type=='url'){
			return $_SERVER['HTTP_HOST'];
		}
		if($type=='title'){
			return 'PCCbay';
		}
		if($type=='domain'){
			return 'PCCbay.com';
		}
		if($type=='tagline'){
			return 'The eBay for PCC';
		}
	}
	
	function rand_str($kind='mixed', $length = 10) {
	    if($kind=='mixed'){
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		if($kind=='letters'){
		    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		if($kind=='numbers'){
		    $characters = '0123456789'; }
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	function pb_new_id($table, $row, $length, $kind='mixed') {
		$token = rand_str($kind, $length);
		$result = pb_db("SELECT * FROM $table Where $row='$token'");
		if ($result->num_rows > 0) { 
			pb_new_id($table, $row, $length, $kind);	
		}else{
			return $token;
		}
	}
	
	function postorget($var){
		if(isset($_GET[$var])){ $type='GET'; $result=$_GET[$var]; }
		if(isset($_POST[$var])){ $type='POST'; $result=$_POST[$var]; }
		if(empty($result)){$result=null;}
		return $result;
	}
	
	function get_words($sentence, $count = 8) {
	  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
	  return $matches[0];
	}
	
	function pb_page(){
		return 'index.php';
	}
	
	function pb_do_function($function, $attr){
		return $function($attr);
	}
	
	function pb_if($if, $doif='', $doelse=''){
		if($if){
			return $doif;
		}else{
			return $doelse;
		}
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
	
	function htmlify($str){
		$str=str_replace('–', '&#8211;', $str);
		$str=str_replace('—', '&#8212;', $str);
		$str=str_replace('"', '&#34;',  $str);
		$str=str_replace('“', '&#8220;', $str);
		$str=str_replace('”', '&#8221;', $str);
		$str=str_replace("'", '&rsquo;',   $str);
		$str=str_replace("'", '&rsquo;',   $str);
		$str=str_replace("‘", '&#8216;', $str);
		$str=str_replace("’", '&#8217;', $str);
		return $str;
	}
	
	function pb_safe_image($unique_id, $method='image', $attr='', $popup='true', $html='{{image}}'){
		$result = pb_db("SELECT * FROM pb_safe_image Where uid='$unique_id'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $size=explode(':', $row['size']);
			    if($popup=='true'){$attr .= 'data-overHead-img="'.$row['string'].'" data-original="'.$row['string'].'"';}
		        if($method=='base64'){ $results = $row['string']; }
		        if($method=='image'){  $results = '<img src="'.$row['string'].'" alt="'.$row['alt'].'" title="'.$row['title'].'" '.$attr.' />';}
		        if($method=='image-lazy'){$results = '<img src="'.$row['string'].'" '.$attr.' />';}
		    }print str_replace('{{image}}', $results, $html);
		}
	}
	
	function pb_include_globals($include){
		$split = explode('?', $include);
		$array=array();
		parse_str(parse_url($include, PHP_URL_QUERY), $array);
		foreach($array as $param){
			${$param} = $array[$param];
		}
		return $split[0];
	}
	
	function pb_include($include, $root=true, $includeTimes='', $Global='', $useif='false'){
		$includeEX = explode('~', $include);
		$include=$includeEX[0];
		if(!empty($includeEX[1])){$include_cmd=$includeEX[1];}
		if($root){ $include = $_SERVER['DOCUMENT_ROOT'].$include; }
		if(file_exists($include)){
			if($includeTimes == 'once'){
				include_once($include); }else{
				include($include); }
		}else{
			print '<b>The path [ '.$include.' ] was not not found</b>';	
		}
	}
	
	function pb_isset_session($sessionName){
		if(isset($_SESSION[$sessionName])){
			return $_SESSION[$sessionName];
		}else{
			return 'session_unset';
		}
	}
	
	function pb_isset($var, $isset='', $unset=''){
		if($var == 'session_unset'){ unset($var); }
		if( isset($var)){ print $isset; }else{ print $unset; }
	}
	
	function pb_ifset($var){
		if( isset($var)){ return $var; }else{ return false; }
	}
	
	function pb_parse_json($json, $find){
		foreach ($json as $key => $val) {
			
		}
	}
	
	function loggedClass($in, $out){
		if(isset($_SESSION['user_id'])){
			print $in;
		}else{
			print $out;
		}
	}
	
	function topTags($limit){
		pb_db("SELECT * FROM pb_tags ORDER BY count DESC LIMIT $limit", function($row){
			print '<li><a href="/s/'.$row['tag'].'">'.ucwords($row['tag']).'</a></li>';
		});
	}	
	
	function pb_graph_token($app_id='', $secret='', $expire='days'){
		return json_decode(file_get_contents('http://'.domain().'/graph/accessToken.php?app_id='.$app_id.'&secret='.$secret.'&expire='.$expire))->token;
	}
	
	function pb_user_data($user_id, $row){
		$result = pb_db("SELECT * FROM  pb_users Where (user_id='$user_id' OR username='$user_id' OR id_card_key='$user_id')");
		if ($result->num_rows > 0) {
		    while($sqlrow = $result->fetch_assoc()) {
				return $sqlrow[$row];
		    }
		}
	}
	
	function pb_user_permission($user_id, $get, $style){
		$user_data = pb_user_data($user_id, 'permissions');
		$allowedKind=array('permission', 'label');
		if(in_array($get, $allowedKind)){
			if($get=='permission'){
				$return = $user_data;
			}
			if($get=='label'){
				if($user_data <= 25){ $return = ''; $style=false; }
				else if($user_data <= 50){ $return = 'staff'; }
				else if($user_data <= 75){ $return = 'manager'; }
				else if($user_data <= 100){ $return = 'admin'; }
			}
			
			if($style==true){
				return '<span class="pb-u-p-bubble pb-u-p-bubble_'.$return.'">'.$return.'</span>';
			}else{
				return $return;
			}
		}
	}
	
	function pb_table_data($table, $row, $where){
		$result = pb_db("SELECT * FROM $table Where $where");
		if ($result->num_rows > 0) {
		    while($sqlrow = $result->fetch_assoc()) {
				return $sqlrow[$row];
		    }
		}
	}

	function pb_my_notifications($user_id){
		$result = pb_db("SELECT * FROM  pb_notify Where notify_to IN ($user_id) AND seen='0'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $tm=$row['item'];
			    $postTitle = json_decode(pb_table_data('pb_post', 'product_info', "product_id='$tm'"));
			    foreach($postTitle as $data){
					$item_t=$data->title;
				} 
			    $user_data = json_decode(pb_user_data($row['notify_from'], 'user_data'), true);
				foreach($user_data as $data){
					$pb_user['name']=$data['name'];
					$pb_user['username']=$data['username'];
					$pb_user['avatar']=$data['avatar'];
				} 
				print '<li class="pb-notify-item" id="notify_'.$row['id'].'">
					<a href="'.$row['link'].'#notify='.$row['id'].'">
						<img src="'.$pb_user['avatar'].'" class="pb-post-avatar">
						<span><strong>'.$pb_user['name'].'</strong> '.$row['intro'].' <em>'.$item_t.' </em>&nbsp;"'.$row['content'].'"</span><br />
						<span class="pb-post-timestamp pb-rule-above"> <i class="zmdi zmdi-calendar-note"></i> <i class="pb-post-timestamp-o">
						'.time_ago( strtotime($row['date']) ).'
						</i></span>
					</a>
				</li>';
		    }
		}else{
			print '<p style="text-align:center">No new notifications.</p>';
		}
	}
	
	function pb_update_notifications($id, $seen){
		pb_db("UPDATE pb_notify SET seen='$seen' WHERE id='$id'");
	}
	
	function pb_notify($to, $from, $item, $intro, $content, $link){
		$date = date("F j, Y, g:i:s a");			
		pb_db("INSERT INTO pb_notify (notify_to, notify_from, item, intro, content, link, date, seen) 
		VALUES ('$to', '$from', '$item', '$intro', '$content', '$link', '$date', '0')"); 
	}
	
	function pb_add_product($user_id) {
		$post_type = $_POST['post_type'];
		$product_info = array();
  		array_push($product_info, array(
  			"timestamp" => "".date("F j, Y, g:i a")."",
  			"title"     => "".htmlify( $_POST['product_title'] )."",
  			"desc"      => "".htmlify( $_POST['product_desc'] )."",
  			"tags"      => "".$_POST['product_tags']."",
  			"price"     => "".$_POST['product_price']."",
  			"condition" => "".$_POST['product_condition']."",
  			"images" => "".$_POST['product_images'].""
  		));
  		
     $product_info = json_encode($product_info);
     
     $trans_info = array();
        array_push($trans_info, array(
           "completed" => 0,
           "method"    => 0,
           "sold_to"   => 0,
           "date_sold" => 0
        ));
      		
      	$trans_info = json_encode($trans_info);
		pb_db("INSERT INTO pb_post (type, user_id, product_info, trans_info, status) VALUES ('$post_type', '$user_id','$product_info','$trans_info', 'open')");
	}

	function pb_update_account($user_id) {
		global $_POST;
		//var_dump($_POST);
		if(isset($_POST['account_residence'])){ $account_residence = 'true'; }else{ $account_residence = 'false'; }
		if(isset($_POST['account_note_desktop'])){ $account_note_desktop = 'true'; }else{ $account_note_desktop = 'false'; }
		if(isset($_POST['account_note_mobile'])){ $account_note_mobile = 'true'; }else{ $account_note_mobile = 'false'; }
		
		$contact_info = array();
  		array_push($contact_info, array(
  			"resident" => "".$account_residence."",
  			"building"     => "".$_POST['account_building']."",
  			"room"      => "".$_POST['account_room']."",
  			"phone"      => "".$_POST['account_phone']."",
  			"email"     => "".$_POST['account_email']."",
  			"notify_d" => "".$account_note_desktop."",
  			"notify_m" => "".$account_note_mobile.""
  		));
        $contact_info = json_encode($contact_info);
        
        $user_data = array();
  		array_push($user_data, array(
  			"ID" => $_POST['account_ID'],
  			"username"     => "".$_POST['account_username']."",
  			"name"      => "".$_POST['account_name']."",
  			"avatar"      => "".$_POST['account_avatar']."",
  			"registered"     => "".$_POST['account_registered']."",
  			"permissions"     => "".$_POST['account_permissions']."",
  			"theme"     => "".$_POST['account_theme']."",
  			"interest"     => "".$_POST['account_interest']."",
  		));
        $user_data = json_encode($user_data);
		pb_db("UPDATE pb_users SET contact_info='$contact_info', user_data='$user_data' WHERE user_id='$user_id'");
	}
	
	function pb_add_comment($user_id) {
        $current_date = date("F j, Y, g:i:s a");
		$comment = htmlify($_POST['comment']);
		$post_id = $_POST['post_id'];
		$post_owner = pb_table_data('pb_post', 'user_id', "product_id='$post_id'");
		pb_notify($post_owner, $user_id, $post_id, 'Commented on', get_words($comment, 20), '/item?id='.$post_id);
		pb_db("INSERT INTO pb_comments (post_id, date, author, status, comment) VALUES ('$post_id', '$current_date','$user_id','open', '$comment')"); 
	}
	function pb_comment_count($post_id){
		$json = json_decode( file_get_contents('http://'.domain().'/graph/index.php?page=comments&accessToken=rootbypass_9827354187582375129873&q='.$post_id.'&timeago=true') );$c=0;foreach($json as $data){ if(!empty($data->id)){$c++;} }return $c;
	}
	function pb_recent_comments($post_id, $count, $order='DESC'){
		$json = json_decode( file_get_contents('http://'.domain().'/graph/index.php?page=comments&accessToken=rootbypass_9827354187582375129873&q='.$post_id.'&timeago=true&l='.$order.'') );
		$result='';
		$s=0;
			foreach($json as $data){
				if(!empty($data->id)){
					$user_data = json_decode(pb_user_data($data->author, 'user_data'), true);
					foreach($user_data as $udata){
						$pb_user['name']=$udata['name'];
						$pb_user['username']=$udata['username'];
						$pb_user['avatar']=$udata['avatar'];
					}
					$result.='
					<div class="col-md-12 pb-post pb-comment-inline">'.
				    	'<div class="pb-post-block">'.
				            '<div class="pb-post-head-noB">'.
				                '<img class="pb-post-avatar" src="'.$pb_user['avatar'].'">'.
				                '<div class="pb-post-author">'.
				                   	'<strong><a href="/@'.$pb_user['username'].'">'.$pb_user['name'].'</a></strong> '.pb_user_permission($data->author,'label', true).'<br>'.
				                    '<span class="pb-post-timestamp"><i class="pb-post-timestamp-o">'.$data->date.'</i></span>'.
				                '</div>'.
				            '</div>'.
				            '<div class="pb-post-content">'.
								''.$data->comment.''.
				            '</div>'.
				        '</div>'.
				   ' </div>';
				$s++;
				if($s == $count) {  break;  }
				}
			}
		return $result;
	}

	function pb_add_servise($user_id) {
        $current_date = date("F j, Y, g:i:s a");
		$about = htmlify($_POST['about']);
		$service_id = pb_new_id('pb_services', 'service_id', 10, 'numbers');
		pb_db("INSERT INTO pb_services (service_id, category, title, cost, location, hours, established, bio, cover, logo, owner, members, ratings, portfolio) 
				VALUES ('$service_id', '$_POST[category]', '$_POST[title]', '$_POST[cost]', '$_POST[location]', '', '$current_date', '$about', '$_POST[profile_cover]', '$_POST[profile_img]', '$user_id', '', '', '$_POST[profile_logo]')");
	}	
?>