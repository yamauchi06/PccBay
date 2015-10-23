<?php  
$user_data = json_decode(pb_user_data($_SESSION['userLogged'], 'user_data'), true);
$contact_info = json_decode(pb_user_data($_SESSION['userLogged'], 'contact_info'), true);
foreach($user_data as $data){
	$pb_user['theme']=$data['theme'];
	$pb_user['interest']=$data['interest'];
} 
foreach($contact_info as $data){
	$pb_user['email']=$data['email'];
	$pb_user['phone']=$data['phone'];
	$pb_user['building']=$data['building'];
	$pb_user['room']=$data['room'];
} 
?>
<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below">My Account</h3>
	
	<form method="post">
		
		<fieldset class="pb-rule-around">
			<legend>Contact Info</legend>
			<div class="row">
				<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Email</div>
				<div class="col-md-5"><input class="form-control pb-rule-below" rows="3" name="account_email" placeholder="Email" value="<?php print $pb_user['email']; ?>"></div>
			</div>
			
			<div class="row">
				<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Phone</div>
				<div class="col-md-5"><input class="form-control pb-rule-below" rows="3" name="account_phone" placeholder="Phone" value="<?php print $pb_user['phone']; ?>"></div>
			</div>
		</fieldset>
		
		<br />

		<fieldset class="pb-rule-around">
			<legend>Residence Info</legend>
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Dorm Student?</div>
				<div class="col-md-3"><input type="checkbox" name="account_residence" data-on-text="YES"data-off-text="NO" data-toggleswitch checked data-on-color="warning"></div>
			</div>
			<div id="account_resedence_op">
				<div class="row">
					<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Building</div>
					<div class="col-md-5"><input class="form-control pb-rule-below" rows="3" name="account_building" placeholder="Building" value="<?php print $pb_user['building']; ?>"></div>
				</div>
				
				<div class="row">
					<div class="col-md-2" style="padding-top:6px;margin-left:7px;">Room</div>
					<div class="col-md-5"><input class="form-control pb-rule-below" rows="3" name="account_room" placeholder="Room #" value="<?php print $pb_user['room']; ?>"></div>
				</div>
			</div>
		</fieldset>
		
		<br />
		
		<fieldset class="pb-rule-around">
			<legend>Notifications</legend>
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Desktop Notifications?</div>
				<div class="col-md-3"><input type="checkbox" name="account_resedence" data-toggleswitch checked data-on-color="warning"></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4" style="padding-top:6px;margin-left:7px;">Mobile Notifications?</div>
				<div class="col-md-3"><input type="checkbox" name="account_resedence" data-toggleswitch checked data-on-color="warning"></div>
			</div>
		</fieldset>

		<br />

		<input class="form-control tags" rows="3" placeholder="things I’m interested in" value="<?php print $pb_user['interest']; ?>">
		
		<div class="pb-full-rule"></div>

		
		<div style="text-align: right;width: 100%;">
			<input type="submit" class="btn btn-default" value="Save">
			<a href="#" style="float: left;margin: 5px;">Privacy Policy</a>
		</div>
		
	</form>
		
	
	
</div>




<!--
[{
	"ID": 100006044469574, 	
	"username": "JoshFerguson", 	
	"name": "Josh Ferguson", 
	"avatar": "https://scontent-atl3-1.xx.fbcdn.net/hphotos-xpl1/t31.0-8/11228039_1686546648223468_7048846777877974576_o.jpg", 	
	"registered": "10/20/2015", 	
	"permissions": "100", 	
	"theme": "default",
	"interest": ["tech", "Art"] 
}]


[{ 	
	"resident": false, 	
	"building": "null", 	
	"room": "null", 	
	"phone": "850 281-9161",
	"email": "josh@inspirosity.net" 
}]

-->