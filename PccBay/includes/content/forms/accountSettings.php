<?php 
	
if(isset($_POST['account_submit'])){
	pb_update_account($_SESSION['user_id']);
}	
	
	 
$user_data = json_decode(pb_user_data($_SESSION['user_id'], 'user_data'), true);
$contact_info = json_decode(pb_user_data($_SESSION['user_id'], 'contact_info'), true);
foreach($user_data as $data){
	$pb_user['theme']=$data['theme'];
	$pb_user['interest']=$data['interest'];
	$pb_user['avatar']=$data['avatar'];
	$pb_user['username']=$data['username'];
	$pb_user['name']=$data['name'];
	$pb_user['registered']=$data['registered'];
	$pb_user['permissions']=$data['permissions'];
} 
foreach($contact_info as $data){
	$pb_user['email']=$data['email'];
	$pb_user['phone']=$data['phone'];
	$pb_user['building']=$data['building'];
	$pb_user['room']=$data['room'];
	$pb_user['resident']=$data['resident'];
	$pb_user['notify_d']=$data['notify_d'];
	$pb_user['notify_m']=$data['notify_m'];
}  
?>
<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below"><img src="<?php print $pb_user['avatar']; ?>" class="pb-post-avatar" /> My Account</h3>
	<form method="post" action="/">
		
		<div class="hide">
			<input type="hidden" name="account_ID" value="<?php print $_SESSION['user_id']; ?>">
			<input type="hidden" name="account_username" value="<?php print $pb_user['username']; ?>">
			<input type="hidden" name="account_name" value="<?php print $pb_user['name']; ?>">
			<input type="hidden" name="account_avatar" value="<?php print $pb_user['avatar']; ?>">
			<input type="hidden" name="account_registered" value="<?php print $pb_user['registered']; ?>">
			<input type="hidden" name="account_permissions" value="<?php print $pb_user['permissions']; ?>">
		</div>
			
		<fieldset class="pb-rule-around">
			<legend>Contact Info</legend>
			<div class="row">
				<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Email</div>
				<div class="col-md-5"><input class="form-control border-bottom-input" rows="3" name="account_email" placeholder="Email" value="<?php print $pb_user['email']; ?>"></div>
			</div>
			
			<div class="row">
				<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Phone</div>
				<div class="col-md-5"><input class="form-control border-bottom-input" rows="3" name="account_phone" placeholder="Phone" value="<?php print $pb_user['phone']; ?>"></div>
			</div>
		</fieldset>
		
		<br />

		<fieldset class="pb-rule-around">
			<legend>Residence Info</legend>
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Dorm Student?</div>
				<div class="col-md-3"><input type="checkbox" name="account_residence" value="true" data-on-text="YES"data-off-text="NO" data-toggleswitch <?php if($pb_user['resident']=='true') print 'checked' ?> data-on-color="theme"></div>
			</div>
			<div id="account_resedence_op">
				<div class="row">
					<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Building</div>
					<div class="col-md-5"><input class="form-control border-bottom-input" rows="3" name="account_building" placeholder="Building" value="<?php print $pb_user['building']; ?>"></div>
				</div>
				
				<div class="row">
					<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Room</div>
					<div class="col-md-5"><input class="form-control border-bottom-input" rows="3" name="account_room" placeholder="Room #" value="<?php print $pb_user['room']; ?>"></div>
				</div>
			</div>
		</fieldset>
		
		<br />
		
		<fieldset class="pb-rule-around">
			<legend>Notifications</legend>
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Desktop Notifications?</div>
				<div class="col-md-3"><input type="checkbox" name="account_note_desktop" value="true" data-toggleswitch <?php if($pb_user['notify_d']=='true') print 'checked' ?> data-on-color="theme"></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Mobile Notifications?</div>
				<div class="col-md-3"><input type="checkbox" name="account_note_mobile" value="true" data-toggleswitch <?php if($pb_user['notify_m']=='true') print 'checked' ?> data-on-color="theme"></div>
			</div>
		</fieldset>

		<br />

		<input class="form-control tags" rows="3" placeholder="things I’m interested in" name="account_interest" value="<?php print $pb_user['interest']; ?>">
		
		<div class="pb-full-rule"></div>
		
		<div style="text-align: right;width: 100%;">
			<div style="float:left;margin:5px;padding-top: 5px;">Themes</div>
			<div style="float:left;margin:5px;">
				<input type="hidden" name="account_theme" value="<?php print $pb_user['theme']; ?>">
				<span class="transition-200 themeOption  <?php if($pb_user['theme']=='default') print 'active' ?>" data-theme="default"></span>
				<span class="transition-200 themeOption <?php if($pb_user['theme']=='blue') print 'active' ?>" data-theme="blue"></span>
				<span class="transition-200 themeOption <?php if($pb_user['theme']=='dark') print 'active' ?>" data-theme="dark"></span>
				<span class="transition-200 themeOption <?php if($pb_user['theme']=='green') print 'active' ?>" data-theme="green"></span>
				<span class="transition-200 themeOption <?php if($pb_user['theme']=='purple') print 'active' ?>" data-theme="purple"></span>
			</div>
			<input type="submit" name="account_submit" class="btn btn-default" value="Save">
		</div>
		
	</form>
		
</div>
<script>
// Sets theme value and show the user a live preview	
$('body').on('click', '.themeOption', function(){
	$('.themeOption.active').removeClass('active');
	$(this).addClass('active');
	$('[name="account_theme"]').val( $(this).data('theme') );
	$('#userThemeCSS').attr('href', '/includes/css/themes/'+$(this).data('theme')+'.css');
});
</script>
