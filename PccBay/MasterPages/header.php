<?php
	if(!isset($include_cmd)){$include_cmd='';} 
	if($include_cmd!=='noAdmin'){
		//pb_include('/MasterPages/admin-header');
	}
?>
<div class="row">
		
	<div class="col-md-3">
		<a href="/"><img src="/images/favicon/pccBay-icon.svg" height="40px" alt="PccBay" /></a>
	</div>	
	
	<div class="col-md-2 col-md-offset-3" id="headerBtns">
		<?php 
			if(!CHROME_APP){
				print '
					<a href="#" class="transition-300 pb-flat-btn" id="MobMenu"><span></span></a>
					<a href="#" class="transition-300 pb-flat-btn" id="SearchBtn"><i class="glyphicon glyphicon-search"></i></a>
				';
				pb_isset(
					pb_isset_session('user_id'),
					'
						<a href="#" class="transition-300 pb-flat-btn" id="MyCardbtn" data-overHead="#MyCardBox"><i class="zmdi zmdi-card"></i></a>
						<a href="#" id="NewProductbtn" class="transition-300 pb-flat-btn" data-overHead="#NewProductBox"><i class="zmdi zmdi-plus-square"></i></a>
					'
				); 
			}
		?>	
	</div>
	
	<div class="col-md-4">
	    <?php 
		    $siteTitle = domain('title');
			pb_isset(
				pb_isset_session('user_id'),
				'
				<div class="input-group MainSearchBox transition-300">
			      <input type="text" class="form-control" placeholder="Search '.$siteTitle.'" id="headerSearch">
			      <span class="input-group-btn">
			        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
			      </span>
			    </div>
				', 
				'
				<a href="/includes/php/fbapp/login.php?inicode='.PAGE_LOAD_CODE.'&ext=true&redirect_on_login=/" class="transition-300 pb-flat-btn" id="LogOnBtn"><i class="fa fa-facebook"></i> <b>Login with Facebook</b></a>
				<div class="input-group MainSearchBox transition-300">
			      <input type="text" class="form-control" placeholder="Search '.$siteTitle.'" id="headerSearch">
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