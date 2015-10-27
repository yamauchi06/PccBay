<?php
	include_once('_db-config.php');
	
	if(!empty($_GET['sessionSet'])){ $_SESSION[$_GET['sessionSet']] = $_GET['value']; }
	if(!empty($_GET['sessionUnSet'])){ unset( $_SESSION[$_GET['sessionUnSet']] ); }
	
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
	
	function get_words($sentence, $count = 8) {
	  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
	  return $matches[0];
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
	
	function safe_image($unique_id, $method='image', $attr=''){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM pb_safe_image Where uid='$unique_id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
			    $size=explode(':', $row['size']);
		        if($method=='base64'){ print $row['string']; }
		        if($method=='image'){  print '<img src="'.$row['string'].'" alt="'.$row['alt'].'" title="'.$row['title'].'" '.$attr.' />';}
		        if($method=='image-lazy'){
			        print '<img src="'.$row['string'].'" data-original="'.$row['string'].'" '.$attr.' />';
		        }
		    }
		}
		$conn->close();
	}
	
	function pb_include($include, $root=true, $includeTimes=''){	
		if($root){ $include = $_SERVER['DOCUMENT_ROOT'].$include; }
		if(file_exists($include)){
			if($includeTimes == 'once'){
				include_once($include); }else{
				include($include); }
		}else{
			print 'path [ '.$include.' ] not found';	
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
	
	
	function pb_json_feed($retrieve='*', $loop=0){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		$mainJson = array();
		$l=0;
		while($l <= $loop){
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT * FROM pb_post Where status='open' ORDER BY product_id DESC";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($val = $result->fetch_assoc()) {
					$entity = array(
						'id' => $val['product_id'],
						'type' => $val['type'],
						'author_id' => $val['user_id'],
						'product_info' => $val['product_info'],
						'trans_info' => $val['trans_info'],
						'status' => $val['status']
					);
					array_push($mainJson, $entity);
					
					$product_info = json_decode($val['product_info']);
					$trans_info = json_decode($val['trans_info']);
			    }
			}
			$conn->close();
		$l++;	
		}//end
		
		return json_encode($mainJson);
		
	}
		
	

	function pb_feed($loop=1, $retrieve='*'){
		$json = pb_json_feed();
		$jsonIterator = json_decode($json, TRUE);
		$i=1;
		while($i<=$loop){
			foreach ($jsonIterator as $key => $val) {
				$product_info = json_decode($val['product_info']);
				foreach($product_info as $entity){
					$val['price'] = $entity->price;
					$val['Condition'] = $entity->condition;
					$val['categories'] = $entity->tags;
					$val['images'] = $entity->images;
					$val['date'] = $entity->timestamp;
					$val['title'] = $entity->title;
					$val['desc'] = $entity->desc;
				}
				$user_data = json_decode(pb_user_data($val['author_id'], 'user_data'), true);
				foreach($user_data as $data){
					$pb_user['name']=$data['name'];
					$pb_user['avatar']=$data['avatar'];
					$pb_user['registered']=date("F d, Y", strtotime($data['registered']));
					$pb_user['theme']=$data['theme'];
				} 
				
			    ?>
			    <div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-4', 'col-md-3') ?> pb-post grid-item" id="pb_post_<?php print $val['id']; ?>">
					<div class="pb-post-block">
						<div class="pb-post-head">
							<img src="<?php print $pb_user['avatar']; ?>" class="pb-post-avatar" />
							<div class="pb-post-author">
								<strong><a href="profile/<?php print $pb_user['avatar']; ?>"><?php print $pb_user['name']; ?></a></strong><br />
								<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">
								<?php  print time_ago( strtotime($val['date']) ); ?>
								</i></span>
							</div>
							<div class="pb-post-price">
								<?php 
									if($val['type']=='product'){ 
										print '$ '.$val['price'];
									}
									else if($val['type']=='question'){
										print '<i class="zmdi zmdi-pin-help" style="font-size:30px"></i>';
									}
									else if($val['type']=='discussion'){
										print '<i class="zmdi zmdi-comment-text-alt" style="font-size:30px"></i>';
									}
								?>
							</div>
						</div>
						<div class="pb-post-content">
							<div class="pb-post-slider flexslider">
							  <ul class="slides">
								  <?php
									$imgIDCount=0;
									$imgArr = explode(',', $val['images']); 
									foreach ($imgArr as $index => $imgID) {
										if($imgIDCount==0){
											print '<li>';
												safe_image($imgID, 'image-lazy', 'class="pb-post-product lazy" data-overHead="#postViewer" data-overHead-temp="open-veiw-trans"');
											print '</li>';
											$imgIDCount++;
										}
									}
									?>
							  </ul>
							</div>
							<p>
								<strong><?php print $val['title']; ?></strong> 
								<?php
								if($val['type']=='question' || $val['type']=='discussion'){
									print '<br />'.$val['desc'].'';
								}	
								?>
							</p>
							
							<div class="pb-post-tags">
								<ul>
									<?php
									$cats = explode(',', $val['categories']);
									if(count($cats) > 0){
										foreach ($cats as $index => $category) {
											print '<li><a href="/category/'.str_replace(' ', '+', $category).'">'.ucwords($category).'</a></li>';
										}
									}
									?>
								</ul>
							</div>
						</div>
						<div class="pb-post-foot">
							
							<div class="row">
								<div class="col-xs-6 pb-va-rule text-center">
								  <a href="#" class="feed-post-tab-link transition-300">
								    <span class="feed-post-tab"><i class="zmdi zmdi-comment-outline"></i> Comment</span>
								  </a>
								</div>
								<div class="col-xs-6 text-center">
								  <a href="#" class="feed-post-tab-link transition-300">
								    <span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> Get this</span>
								  </a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			    <?php
			}
		$i++;	
		}
		
	}
	
	function pb_user_data($user_id, $row){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM  pb_users Where user_id='$user_id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($sqlrow = $result->fetch_assoc()) {
				return $sqlrow[$row];
		    }
		}
		$conn->close();
	}
	
	function pb_add_product($user_id) {
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $_POST;
		$post_type = $_POST['post_type'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
			$product_info = array();
      		array_push($product_info, array(
      			"timestamp" => "".date("F j, Y, g:i a")."",
      			"title"     => "".$_POST['product_title']."",
      			"desc"      => "".$_POST['product_desc']."",
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
		$sql = "INSERT INTO pb_post (type, user_id, product_info, trans_info, status) VALUES ('$post_type', '$user_id','$product_info','$trans_info', 'open')";
		
		if ($conn->query($sql) === TRUE) {
			//print 'done';
		} else {
		    echo "Error updating record: " . $conn->error;
		}
   	
   	$conn->close();
	}
	
	
	
	
	function pb_update_account($user_id) {
		global $servername;
		global $username;
		global $password;
		global $dbname;
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
		
		$conn = new mysqli($servername, $username, $password, $dbname);
	   	// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "UPDATE pb_users SET contact_info='$contact_info', user_data='$user_data' WHERE user_id='$user_id'";

		if ($conn->query($sql) === TRUE) {
			print "<script>$('#userThemeCSS').attr('href', '/includes/css/themes/".$_POST['account_theme'].".css');</script>";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	
?>