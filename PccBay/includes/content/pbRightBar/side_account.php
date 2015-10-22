<?php  
$user_data = json_decode(pb_user_data($_SESSION['userLogged'], 'user_data'), true);
foreach($user_data as $data){
	$pb_user['name']=$data['name'];
	$pb_user['avatar']=$data['avatar'];
	$pb_user['registered']=date("F d, Y", strtotime($data['registered']));
} 
?>
<div class="pb-page-divider">
	<a href="#" data-overHead="#accSettingsBox" id="accSettings"><i class="zmdi zmdi-settings-square"></i></a>
	
	<a href="/?sessionUnSet=userLogged" id="accSettings" style="float: left;"><i class="zmdi zmdi-minus-square"></i></a>
</div>
<div class="pb-center">
	<img src="<?php print $pb_user['avatar']; ?>">
</div>
<div class="text-center">
	<h3 class="pb-rule-below">
		<?php print $pb_user['name']; ?><br />
		<span style="font-size: 14px;" class="pb-theme-black"><?php print $pb_user['registered']; ?></span>
	</h3>
	
	<strong><i class="zmdi zmdi-home"></i> Town</strong>
	<hr />
</div>

