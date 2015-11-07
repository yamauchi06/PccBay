<?php  
$user_data = json_decode(pb_user_data($_SESSION['user_id'], 'user_data'), true);
foreach($user_data as $data){
	$pb_user['name']=$data['name'];
	$pb_user['avatar']=$data['avatar'];
	$pb_user['registered']=date("F d, Y", strtotime($data['registered']));
	$pb_user['theme']=$data['theme'];
} 
$user_data = json_decode(pb_user_data($_SESSION['user_id'], 'contact_info'), true);
foreach($user_data as $data){
	$pb_user['resident']=$data['resident'];
	$pb_user['building']=$data['building'];
	$pb_user['room']=$data['room'];
	$pb_user['phone']=$data['phone'];
	$pb_user['email']=$data['email'];
} 
if($pb_user['resident']=='true'){
	$home = $pb_user['building'].': '.$pb_user['room'];
}else{
	$home = 'Town';
}
?>
<div class="pb-page-divider">
	<a href="#" data-overHead="#userAccountSettingBox" id="accSettings" class="pb-flat-btn"><i class="zmdi zmdi-settings-square"></i></a>
</div>
<div class="pb-center">
	<img src="<?php print $pb_user['avatar']; ?>">
</div>
<div class="text-center">
	<h3 class="pb-rule-below">
		<?php print $pb_user['name']; ?><br />
<!-- 		<span style="font-size: 14px;" class="pb-theme-black"><?php print $pb_user['registered']; ?></span> -->
	</h3>
	
	<?php
		print '<strong><i class="zmdi zmdi-home"></i> '.$home.'</strong><br />'.$pb_user['phone'].'<br />'.$pb_user['email'].'';	
	?>
	<hr />
</div>

