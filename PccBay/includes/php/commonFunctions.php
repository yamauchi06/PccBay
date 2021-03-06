<?php
	include_once('_db-config.php');
	include_once('_pb_db.php');
	include_once('_pb_og.php');
	include_once('_pb_filters.php');
	include_once('pb_short_code.php');
	
	include_once('_pb_min_functions.php');

	
	if(!empty($_GET['sessionSet'])){ $_SESSION[$_GET['sessionSet']] = $_GET['value']; }
	if(!empty($_GET['sessionUnSet'])){ unset( $_SESSION[$_GET['sessionUnSet']] ); }

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
		if($type=='description'){
			return 'The eBay for PCC';
		}
		if($type=='actual_link'){
			return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
	}
	
	function in_str($needle, $haystack){
		$p=explode($needle, $haystack);
		if(!empty($p[1])){
			return true;
		}
	}
	
	function pb_page_code($prefix, $return=false){
		if($return==true){
			if(isset($_SESSION[$prefix.PAGE_LOAD_CODE])){
				return $_SESSION[$prefix.PAGE_LOAD_CODE];
			}else{
				return false;
			}
		}else{
			if(!isset($_SESSION[$prefix.PAGE_LOAD_CODE])){
				$_SESSION[$prefix.PAGE_LOAD_CODE]=array();
				if(isset($_SESSION[$prefix.'_last'])){
					$_SESSION[ $_SESSION[$prefix.'_last'] ]='';
					unset( $_SESSION[ $_SESSION[$prefix.'_last'] ] );
				}
			}else{
				$_SESSION[$prefix.'_last']=$prefix.PAGE_LOAD_CODE;
			} 
		}
	}
	
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	
	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	
	function fDate($date, $modify){
		//"2006-12-12"
		$newDate = new DateTime($date);
		//"+7 day"
		$newDate->modify($modify);
		return $newDate->format("Y-m-d");
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
	
	function pb_new_row($table, $row, $sting) {
		$token = rand_str('numbers', 3);
		$result = pb_db("SELECT $row FROM $table Where $row='$sting'");
		if ($result->num_rows > 0) { 
			return pb_new_row($table, $row, $sting.$token);	
		}else{
			return $sting;
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
	
	function isCurrency($number){
	  return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
	}
		
	function pb_price($price='', $empty='free', $currency='$'){
		if(!empty($price)){
			if(isCurrency($price)){
				return $currency.$price;
			}else{
				return $price;
			}
		}else{
			return $empty;
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
	
	function pb_members_only($do='nothing', $text="<h2>Access Denied, You must be logged in to view this page.</h2>"){
		if(!isset($_SESSION['user_id'])){
			if($do=='nothing'){
				print $text;
				exit;
			}
			if($do=='homepage'){
				header('Location: /');
			}
			if($do=='login'){
				header('Location: /includes/php/fbapp/login.php?redirect_on_login='.domain('actual_link').'&ext=true');
			}
		}
	}
	
	function pb_safe_image($unique_id, $method='image', $attr='', $popup='true', $html='{{image}}'){
		$result = pb_db("SELECT * FROM pb_safe_image Where uid='$unique_id'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $size=explode(':', $row['size']);
			    $row['string'] = pb_safe_image_structure($row['string']);
			    if($popup=='true'){$attr .= 'data-overHead-img="'.$row['string'].'" data-original="'.$row['string'].'"';}
		        if($method=='base64' || $method=='url'){ $results = $row['string']; }
		        if($method=='image'){  $results = '<img src="'.$row['string'].'" alt="'.$row['alt'].'" title="'.$row['title'].'" '.$attr.' />';}
		        if($method=='image-lazy'){$results = '<img src="'.$row['string'].'" '.$attr.' />';}
		    }print str_replace('{{image}}', $results, $html);
		}
	}
	
	function pb_safe_image_return($unique_id, $method='image', $attr='', $popup='true', $html='{{image}}'){
		$result = pb_db("SELECT * FROM pb_safe_image Where uid='$unique_id'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $size=explode(':', $row['size']);
			    $row['string'] = pb_safe_image_structure($row['string']);
			    if($popup=='true'){$attr .= 'data-overHead-img="'.$row['string'].'" data-original="'.$row['string'].'"';}
		        if($method=='base64' || $method=='url'){ $results = $row['string']; }
		        if($method=='image'){  $results = '<img src="'.$row['string'].'" alt="'.$row['alt'].'" title="'.$row['title'].'" '.$attr.' />';}
		        if($method=='image-lazy'){$results = '<img src="'.$row['string'].'" '.$attr.' />';}
		    }return $results;
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
	
	function pb_include($include, $root=true, $includeTimes='', $Global='', $ext='php'){
		$includeEX = explode('~', $include);
		$include=$includeEX[0];
		if(!empty($includeEX[1])){$include_cmd=$includeEX[1];}
		if($root){ $include = $_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.$include; }
		$extin=pathinfo($include, PATHINFO_EXTENSION);
		if( empty($extin) || $extin=='' || !isset($extin) ){ $include = $include.'.'.$ext; }
		if(file_exists($include)){
			if($includeTimes == 'once'){
				include_once($include); }else{
				include($include); }
		}else{
			print '<b>The path [ '.$include.' ] was not not found</b>';	
		}
	}
	
	function pb_file_exists($path){
		if( file_exists($_SERVER['DOCUMENT_ROOT'].$path) ){
			return true;
		}else{return false;}
	}
	
	function pb_date(){
		return date("F j, Y, g:i:s a");
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
		if(empty($isset) && empty($unset)){
			return isset($var);
		}else{
			if( isset($var)){ print $isset; }else{ print $unset; }
		}
	}
	
	function pb_ifset($var){
		if( isset($var)){ return $var; }else{ return false; }
	}
	
	function pb_parse_json($json, $find){
		foreach ($json as $key => $val) {
			
		}
	}
	
	function loggedClass($in, $out, $return=false){
		if(isset($_SESSION['user_id'])){
			$output=$in;
		}else{
			$output=$out;
		}
		if($return==false){
			print $output;
		}else{
			return $output;
		}
	}
	
	function topTags($limit){
		pb_db("SELECT * FROM pb_tags ORDER BY count DESC LIMIT $limit", function($row){
			if(!empty($row['tag']) && isset($row['tag'])){
				print '<li><a href="/s/'.$row['tag'].'">'.ucwords($row['tag']).'</a></li>';
			}
		});
	}	
	
	function add_tag($tag, $each=false){
		if($each==true){
			if(!is_array($tag)){
				$tag=explode(',',$tag);
			}
			foreach($tag as $pTag){ 
				add_tag($pTag);
			}
		}else{
			$result = pb_db("SELECT * FROM pb_tags Where tag='$tag'");
			if($result->num_rows>0){
				pb_db("UPDATE pb_tags SET count = count + 1 WHERE tag='$tag'");
			}else{
				pb_db("INSERT INTO pb_tags (tag, count) VALUES ('$tag', '1')");
			}
		}
	}
	
	function pb_order($post_id){
		$return='';
		$result=pb_db("SELECT * FROM pb_orders WHERE post_id='$post_id'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
				$return=$row;
		    }
		}
		return pb_switch($return);
	}	
	
	function pb_is_allowed($perm='0', $user_id=''){
		if(empty($user_id)){
			if(isset($_SESSION['user_id'])){
				$user_id=$_SESSION['user_id'];
			}
		}
		if(!empty($user_id)){
			$userPerm=pb_table_data('pb_users', 'permissions', "(user_id='$user_id' OR username='$user_id')");
			if($userPerm>=$perm){
				return true; }else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	function pb_graph_token($app_id='', $secret='', $expire='days'){
		return json_decode(file_get_contents('http://'.domain().'/graph/accessToken.php?app_id='.$app_id.'&secret='.$secret.'&expire='.$expire))->token;
	}
	
	function pb_user_data($user_id, $row, $loop=false){
		if(is_object($user_id)){
			$user_id = $user_id->user_id;
		}
		$result = pb_db("SELECT * FROM pb_users WHERE (user_id='$user_id' OR username='$user_id') LIMIT 1");
		if ($result->num_rows > 0) {
		    while($sqlrow = $result->fetch_assoc()) {
				$return = $sqlrow[$row];
		    }
		}
		if($loop==true){
			foreach($return as $data){
				$re[] = $data;
			} 
			$return=$re;
		}
		
		return $return;
	}
	
	function pb_obj($object, $property, $return=''){
		if(property_exists($object, $property)){
			return $object->$property;
		}else{return $return;}
	}
	
	function e($s){if(empty($s)){return false;}else{return true;}}

	
	function pb_user($type='object', $user_id='', $save=true){
		if(empty($user_id)){if(isset($_SESSION['user_id'])){ $user_id=$_SESSION['user_id']; }}
		if(empty($user_id)){
			return '{{no user id}}';
		}else{
			if(!isset($_SESSION['user_data'.$user_id])){
				$user_data = json_decode(pb_user_data($user_id, 'user_data')); $user_data=$user_data[0];
				$contact_info = json_decode(pb_user_data($user_id, 'contact_info')); $contact_info=$contact_info[0];		
				$arrs = array_merge(pb_switch($user_data), pb_switch($contact_info));
				$session = array(
					'user_id' => pb_user_data($user_id, 'user_id'),
					'card_id' => pb_user_data($user_id, 'id_card_key'),
					'ratings' => pb_user_data($user_id, 'total_ratings'),
					'ratings_num' => pb_user_data($user_id, 'num_of_ratings'),
					'steps' => pb_user_data($user_id, 'steps'),
					'lastLogin' => strtotime(date("F j, Y, g:i:s a")),
					'utid' => 'pb:'.sha1($user_data->ID.$user_data->registered), 
					'session'=>'false'
				);
				$arrs = array_merge($arrs, $session);
				if($save){$_SESSION['user_data'.$user_id]=$arrs;}
			}else{
				$arrs=$_SESSION['user_data'.$user_id];
				$arrs['session']='true';
				$arrs['utid']='pb:'.sha1($arrs['ID'].$arrs['registered']);
			}
			if($type=='object'){
				return pb_switch($arrs); }else{
				return $user_id;
			}
		}
	}
	
	function pb_post($post_id='', $type='object'){
		$result = pb_db("SELECT * FROM pb_post WHERE product_id='$post_id'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $j1=json_decode($row['product_info']);
			    $j2=json_decode($row['trans_info']);
				$post=array(
					'id' => $row['product_id'],
					'type' => $row['type'],
					'user' => $row['user_id'],
					'status' => $row['status'],
					'info' => $j1[0],
					'trans' => $j2[0]
				);
		    }
		}
		return pb_switch($post);
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
	
	function pb_remove_img($imgId='', $response='text'){
		return pb_db("DELETE FROM pb_safe_image WHERE uid='$imgId'");
	}
	
	function pb_collage_build($row){
		$pb_collage=array();
		if(!empty($row['logo'])){ array_push($pb_collage, $row['logo']); }
		if(!empty($row['cover'])){ array_push($pb_collage, $row['cover']); }
		$port=explode(',',$row['portfolio']);
		foreach($port as $item){
			if(!empty($item)){ array_push($pb_collage, $item); }
		}
		return $pb_collage;
	}
	
	function pb_collage($images, $height, $output='return', $temp='{{collage}}'){
		$html='<div class="pb-collage">';
		$heightH=(int)$height/2;
		if(!is_array($images)){ $images=explode(',', str_replace(' ', '', $images)); }
		$images=str_replace(' ', '', $images);
		$imgCount=count($images);
		if(!empty($images[0])){
			if($imgCount==1){
				$url=pb_safe_image_return($images[0], 'base64');
				$html.='<div class="pb-mask" style="background-image:url('.$url.');height:'.$height.'px;"></div>';
			}
			else if($imgCount==2){
				foreach($images as $key=>$image){
					$url=pb_safe_image_return($image, 'base64');
					$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$height.'px;"></div>';
				}
			}
			else if($imgCount==3){
				foreach($images as $key=>$image){
					$url=pb_safe_image_return($image, 'base64');
					if($key==0){
						$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$height.'px;"></div>';
						$html.='<div class="pb-mask-half">';
					}else{
						$html.='<div class="pb-mask" style="background-image:url('.$url.');height:'.$heightH.'px;"></div>';
					}
				}
				$html.='</div>';
			}
			else if($imgCount==4){
				foreach($images as $key=>$image){
					$url=pb_safe_image_return($image, 'base64');
					if($key==0){
						$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$height.'px;"></div>';
						$html.='<div class="pb-mask-half">';
					}else{
						if($key<=3){
							if($key==1){
								$html.='<div class="pb-mask" style="background-image:url('.$url.');height:'.$heightH.'px;"></div>';
								$html.='<div class="pb-mask">';
							}else{
								$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$heightH.'px;"></div>';
							}
						}
					}
				}
				$html.='</div>';
				$html.='</div>';
			}
			else if($imgCount==5){
				foreach($images as $key=>$image){
					$url=pb_safe_image_return($image, 'base64');
					if($key==0){
						$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$height.'px;"></div>';
						$html.='<div class="pb-mask-half">';
					}else{
						if($key<=4){
							$html.='<div class="pb-mask-half" style="background-image:url('.$url.');height:'.$heightH.'px;"></div>';
						}
					}
				}
				$html.='</div>';
			}
		}
		$html.='</div>';
		if($output=='return'){return str_replace('{{collage}}', $html, $temp);}
		if($output=='print'){print str_replace('{{collage}}', $html, $temp);;}
	}
	

	function pb_my_notifications($user_id){
		pb_expired($user_id, 'notify');
		$result = pb_db("SELECT * FROM  pb_notify Where notify_to IN ($user_id) AND seen='0'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $tm=$row['item'];
			    $postTitle = json_decode(pb_table_data('pb_post', 'product_info', "product_id='$tm'"));
			    foreach($postTitle as $data){
					$item_t=$data->title;
				} 
			    if($row['notify_from']!=='system'){
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
			    }else{
				    print '<li class="pb-notify-item pb-notify-warning" id="notify_'.$row['id'].'" style="padding:5px;">
							<span>'.$row['intro'].'<em>'.$item_t.'</em>'.$row['content'].'</span><br />
							<span class="pb-post-timestamp pb-rule-above"> <i class="zmdi zmdi-calendar-note"></i> <i class="pb-post-timestamp-o">
							'.time_ago( strtotime($row['date']) ).'
							</i></span>
					</li>';
			    }
		    }
		}else{
			print '<p style="text-align:center">No new notifications.</p>';
		}
	}
	
	function pb_update_notifications($id, $seen){
		return pb_db("UPDATE pb_notify SET seen='$seen' WHERE id='$id'");
	}
	
	function pb_reactivate_post($id){
		$curr=pb_post($id)->info;
		$cDate = $curr->timestamp;
		$s = print_r($curr, 1);	
		$output = str_replace($cDate,  pb_date(), $s);
		return pb_db("UPDATE pb_post SET product_info='$output' WHERE product_id='$id'");
	}
	
	function pb_table_data($table, $row, $where){
		$result = pb_db("SELECT * FROM $table Where $where");
		if ($result->num_rows > 0) {
		    while($sqlrow = $result->fetch_assoc()) {
				return $sqlrow[$row];
		    }
		}
	}
	
	function pb_notify($to, $from, $item, $intro, $content, $link, $type="0"){
		$date = date("F j, Y, g:i:s a");			
		return pb_db("INSERT INTO pb_notify (notify_to, notify_from, item, intro, content, link, date, seen, type) 
		VALUES ('$to', '$from', '$item', '$intro', '$content', '$link', '$date', '0', '$type')"); 
	}
	function pb_db_last($table, $ob){
		$result = pb_db("SELECT * FROM $table ORDER BY $ob DESC LIMIT 1");
		if ($result->num_rows > 0) { return pb_switch($result->fetch_assoc()); }
	}
	function pb_db_first($table, $ob){
		$result = pb_db("SELECT * FROM $table ORDER BY $ob ASC LIMIT 1");
		if ($result->num_rows > 0) { return pb_switch($result->fetch_assoc()); }
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
        
        add_tag($_POST['product_tags'], true);
        
        $expire=fDate(date("F j, Y, g:i a"), '+1 month');
        	
      	$trans_info = json_encode($trans_info);
		return pb_db("INSERT INTO pb_post (type, user_id, product_info, trans_info, status, expires, expires_tick) 
		VALUES ('$post_type', '$user_id','$product_info','$trans_info', 'open', '$expire', '0')");
	}

	function pb_update_account($user_id) {
		unset($_SESSION['user_data'.$user_id]);
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
		return pb_db("UPDATE pb_users SET contact_info='$contact_info', user_data='$user_data' WHERE user_id='$user_id'");
	}
	
	function pb_add_comment($user_id) {
        $current_date = date("F j, Y, g:i:s a");
		$comment = htmlify($_POST['comment']);
		$post_id = $_POST['post_id'];
		if(!isset($_POST['add_reveiw'])){
			$post_owner = pb_table_data('pb_services', 'owner', "service_id='$post_id'"); }else{
			$post_owner = pb_table_data('pb_post', 'user_id', "product_id='$post_id'");
		}
		if( pb_explicit($_POST['comment'])=='true' ){
			$status='flagged'; }else{
			$status='open';
		}
		pb_notify($post_owner, $user_id, $post_id, 'Commented on', get_words($comment, 20), '/item?id='.$post_id);
		return pb_db("INSERT INTO pb_comments (post_id, date, author, status, comment) VALUES ('$post_id', '$current_date','$user_id','$status', '$comment')"); 
	}
	function pb_comment_count($post_id){
		$json = json_decode( file_get_contents('http://'.domain().'/graph/index.php?page=comments&accessToken=rootbypass_9827354187582375129873&q='.$post_id.'&timeago=true') );$c=0;foreach($json as $data){ if(!empty($data->id)){$c++;} }return $c;
	}
	function pb_recent_comments($post_id, $count, $order='DESC', $emptyMsg='Be the first to comment.'){
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
		if($s==0){$result=$emptyMsg;}	
		return $result;
	}
	
	function pb_add_reveiw($user_id) {
		pb_add_comment($user_id);
		$svr_id = $_POST['post_id'];
		$ratings = $_POST['ratings'];
		if($ratings>'0'){
			if($ratings > '0') { $r = '3';   }
			if($ratings > '25'){ $r = '3.5'; }
			if($ratings > '50'){ $r = '4';   }
			if($ratings > '75'){ $r = '4.5'; }
			if($ratings > '90'){ $r = '5';   }
		}else{
			if($ratings < '0') {  $r = '3';   }
			if($ratings < '-25'){ $r = '3.5'; }
			if($ratings < '-50'){ $r = '2';   }
			if($ratings < '-75'){ $r = '1.5'; }
			if($ratings < '-90'){ $r = '1';   }
		}
		$indb=pb_table_data('pb_services', 'ratings', "service_id='$svr_id'");
		$tot=(float)$r+(float)$indb;
		$adv=$tot/2;
		return pb_db("UPDATE pb_services SET ratings='$adv' WHERE service_id='$svr_id'"); 
	}

	function pb_add_servise($user_id) {
        $current_date = date("F j, Y, g:i:s a");
        $exp=fDate(date("Y-m-d"), '+6 month');
		$about = htmlify($_POST['about']);
		$service_id = pb_new_id('pb_services', 'service_id', 10, 'numbers');
		return pb_db("INSERT INTO pb_services (service_id, category, title, cost, location, hours, established, expires, bio, cover, logo, owner, members, ratings, portfolio, status) 
				VALUES ('$service_id', '$_POST[category]', '$_POST[title]', '$_POST[cost]', '$_POST[location]', '', '$current_date', '$exp', '$about', '$_POST[profile_cover]', '$_POST[profile_img]', '$user_id', '', '', '$_POST[profile_logo]', 'open')");
	}	
	
	function pb_addtocart($item_id){
		return '/graph/addtocart?id='.$item_id.'&accessToken='.pb_og('token').'&redirect='.domain('actual_link');
	}
	
	
	function pb_expired($user_id, $action){
/*
		$return=array();
		$result = pb_db("SELECT product_id FROM pb_post WHERE user_id='$user_id' AND status='open'");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $id=$row['product_id'];
				$posted = pb_post($row['product_id'], 'object')->info->timestamp;
				if(strtotime($posted) < strtotime('30 days ago')){
					array_push($return, array(
						'id' => $row['product_id'],
						'date' => $posted,
					));
					if($action=='notify'){
						if( pb_db_last('pb_notify', 'id') ){ $next=pb_db_last('pb_notify', 'id')->id+1; }
						pb_notify($user_id, 'system', $row['product_id'], 'Your post (', ') has expired: <br /> <a class="pb-notify-button" href="#notify='.$next.'">Discard</a> or <a class="pb-notify-button" href="#notify_keep='.$next.'">Re-activate</a>', '/item?id='.$row['product_id']);
					}
					pb_db("UPDATE pb_post SET status='expired' WHERE product_id='$id'");
				}
		    }
		}
*/
		
	//	return $return;
	}
	
	

	function pb_ad($defaults, $loop=1, $location=''){
		$defaults=pb_switch($defaults);
		$location=clean($location);
		$ad_id=pb_obj($defaults, 'id');
		$width=pb_obj($defaults, 'style');
		$keywords=pb_obj($defaults, 'tags');
		$caption=pb_obj($defaults, 'caption', true);
		$type=pb_obj($defaults, 'type', 'long');
		
		$_SESSION['pb_ad_style']=$width;
		$_SESSION['pb_ad_cap']=$caption;
		$code_previx="pb_ad".$location;
		pb_page_code($code_previx);
		$adCount=1;
		while($adCount <= $loop){
			if(empty($ad_id) || $ad_id=='paid'){
				$result= pb_db("SELECT * FROM pb_doubleclick WHERE status=1 order by RAND() LIMIT 1");
				if($result->num_rows>0){
					$ad_id=$result->fetch_assoc(); $ad_id=$ad_id['id'];
				}
			}
			if($ad_id=='free'){
				$ran = pb_db("SELECT product_id, user_id, product_info FROM pb_post WHERE type='product' AND status='open' order by RAND() LIMIT 1", true);
				$data = json_decode($ran->product_info); $data=$data[0];
				$img_id = explode(',', $data->images);$img_id=$img_id[0];
				$img_cta = $data->title;
				$img_user = $ran->user_id;
				$pid = $ran->product_id;
				$pb_safe_image=pb_db("SELECT string FROM pb_safe_image WHERE uid='$img_id'", true);
				if(!in_array('free_ads_'.$pid, pb_page_code($code_previx, true) )){
				    if(isset($pb_safe_image->string)){
					    $img_url=$pb_safe_image->string;
					    array_push($_SESSION[$code_previx.PAGE_LOAD_CODE], 'free_ads_'.$pid);
						print '<a class="pb_ad transition-300" href="/pb_doubleclick?path=/item?id='.$pid.'&marketplace=free_user_ads&pg='.PAGE_LOAD_CODE.'&source='.$location.'&session='.$code_previx.'&user_id='.$img_user.'"';
						print 'style="background:no-repeat center url('.pb_safe_image_structure($img_url).');background-size:cover;'.$_SESSION['pb_ad_style'].'">';
						if(!empty($img_cta) && e($_SESSION['pb_ad_cap']) ){ print '<div class="transition-300">'.$img_cta.'</div>'; }
						print '</a>';
				    }
			    }
			}else{
				$ad=pb_db("SELECT * FROM pb_doubleclick WHERE id='$ad_id' AND status=1 LIMIT 1", true);
				if($type=='long'){$img = $ad->cover;}
				if($type=='square'){$img = $ad->cover_square;}
				if(empty($img)){$img = $ad->cover;}
				if(!in_str('/', $img)){ 
					$img=pb_db("SELECT string FROM pb_safe_image WHERE uid='$img'", true)->string; 
				}
				if(!in_array($ad->id, pb_page_code($code_previx, true) )){
				    array_push($_SESSION[$code_previx.PAGE_LOAD_CODE], $ad->id);
					print '<a class="pb_ad transition-300" href="/pb_doubleclick?path='.$ad->link.'&pg='.PAGE_LOAD_CODE.'&source='.$location.'&session='.$code_previx.'&marketplace=user_ad&id='.$ad->id.'"';
					print 'style="background:no-repeat center url('.$img.');background-size:cover;'.$_SESSION['pb_ad_style'].'">';
					if(!empty($ad->cta) && e($_SESSION['pb_ad_cap']) ){ print '<div class="transition-300">'.$ad->cta.'</div>'; }
					print '</a>';
				}	
			}
		$adCount++;	
		}
	}
	
	function pb_is_mine($table, $id, $itemType, $user_id){
		if(isset($_SESSION['user_id'])){ $user_id=$_SESSION['user_id']; }
		$result = pb_db("SELECT * FROM $table WHERE $itemType='$id' LIMIT 1");
		if ($result->num_rows > 0) { 
			return true; 
		}
	}
	
	
	function pb_delete_this(){
		if(isset($_GET['edit'])){
			if( pb_is_mine('pb_post', $_GET['id'], 'product_id', pb_user()->user_id) ){
				print '<a href="/graph/edit.php?id='.$_GET['id'].'&action=delete" style="float: left;margin: 5px;color: #e74c3c">Permanently delete this item </a>';
			}
			
		}
	}
	
	
?>