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
	
	
	function include_root($Fullpath){
		$path = $_SERVER['DOCUMENT_ROOT'].$Fullpath;
		include($path);
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
			        print '<img src="'.$row['string'].'" data-original="'.$row['string'].'" alt="'.$row['alt'].'" title="'.$row['title'].'" '.$attr.' />';
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
	
	function sessionSet($session='', $isset='', $unset=''){
		if(isset($_SESSION[$session])){ print $isset; }else{ print $unset; }
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
			$sql = "SELECT * FROM pb_post Where status='open'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($val = $result->fetch_assoc()) {
					$entity = array(
						'id' => $val['id'],
						'uid' => $val['uid'],
						'type' => $val['type'],
						'author_id' => $val['author_id'],
						'author_name' => $val['author_name'],
						'author_avatar' => $val['author_avatar'],
						'title' => $val['title'],
						'description' => $val['description'],
						'price' => $val['price'],
						'allow_bids' => $val['allow_bids'],
						'bids' => $val['bids'],
						'categories' => $val['categories'],
						'images' => $val['images'],
						'date' => $val['date'],
						'status' => $val['status']
					);
					array_push($mainJson, $entity);
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
			    ?>
			    <div class="col-md-<?php if(isset($_SESSION['userLogged'])){ print '4'; }else{ print '3'; } ?> pb-post grid-item" id="pb_post_<?php print $val['id']; ?>">
					<div class="pb-post-block">
						<div class="pb-post-head">
							<img src="<?php print $val['author_avatar']; ?>" class="pb-post-avatar" />
							<div class="pb-post-author">
								<strong><a href="profile/<?php print $val['author_name']; ?>"><?php print $val['author_name']; ?></a></strong><br />
								<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">
								<?php  print time_ago( strtotime($val['date']) ); ?>
								</i></span>
							</div>
							<div class="pb-post-price">$<?php print $val['price']; ?>.00</div>
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
												//print '[safe_image]';
												safe_image($imgID, 'image-lazy', 'class="pb-post-product lazy" data-overHead="#postViewer" data-overHead-temp="open-veiw-trans"');
											print '</li>';
											$imgIDCount++;
										}
									}
									?>
							  </ul>
							</div>
							<p>
								<ul class="no-bullet" style="padding-left: 10px;">
									<li><strong><i class="zmdi zmdi-money"></i> price</strong> <?php print $val['price']; ?>.00</li>
									<li><strong><i class="zmdi zmdi-plaster"></i> Condition</strong> <span class="pb-theme-green">Excellent</span></li>
									<li><strong class="pb-theme-green"><i class="zmdi zmdi-star"></i> Open to bids</strong></li>
								</ul>
<!-- 								<?php print strip_tags( implode(' ', array_slice(explode(' ', preg_replace("/<img[^>]+\>/i", "", $val['description'])), 0, 20)) ); ?> -->
							</p>
							
							<div class="pb-post-tags">
								<ul>
									<?php
									$cats = json_decode($val['categories']);
									foreach ($cats as $index => $category) {
										print '<li><a href="/category/'.str_replace(' ', '+', $category).'">'.$category.'</a></li>';
									}
									?>
								</ul>
							</div>
						</div>
						<div class="pb-post-foot">
							
							<div class="row">
								<div class="col-xs-6 pb-va-rule text-center">
								  <a href="#" class="feed-post-tab-link transition-300">
								    <span class="feed-post-tab"><i class="zmdi zmdi-format-valign-bottom"></i> Place bid</span>
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
	
	
?>