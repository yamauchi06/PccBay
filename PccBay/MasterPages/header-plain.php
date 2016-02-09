<?php //pb_include('/MasterPages/admin-header'); ?>
<div class="row">
		
	<div class="col-md-3">
		<a href="/"><img src="/images/favicon/pccBay-icon.svg" height="40px" alt="PccBay" /></a>
	</div>	
	
	<div class="col-md-2 col-md-offset-3" id="headerBtns">
		<a href="#" class="transition-300 pb-flat-btn" id="MobMenu"><span></span></a>
		<a href="#" class="transition-300 pb-flat-btn" id="SearchBtn"><i class="glyphicon glyphicon-search"></i></a>	
	</div>

	<div class="col-md-4">
	    <?php 
			pb_isset(
				pb_isset_session('user_id'),
				'
				<div class="input-group MainSearchBox transition-300">
			      <input type="text" class="form-control" placeholder="Search PCCbay" id="headerSearch">
			      <span class="input-group-btn">
			        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
			      </span>
			    </div>
				', 
				'
				<a href="/includes/php/fbapp/login.php?inicode='.PAGE_LOAD_CODE.'&ext=true&redirect_on_login=/" class="transition-300 pb-flat-btn" id="LogOnBtn"><i class="fa fa-facebook"></i> <b>Login with Facebook</b></a>
				<div class="input-group MainSearchBox transition-300">
			      <input type="text" class="form-control" placeholder="Search PCCbay" id="headerSearch">
			      <span class="input-group-btn">
			        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
			      </span>
			    </div>
				'
			); 
			pb_include('/MasterPages/header-search');
		?>
	</div>
	
		

</div>