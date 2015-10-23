<div class="row">
		
<div class="col-md-3">
	<a href="/"><img src="/images/favicon/pccBay-logo.svg" height="40px" alt="PccBay" /></a>
</div>	
	<div class="col-md-2 col-md-offset-3" id="headerBtns">
	<?php 
		pb_isset(
			$_SESSION['user_id'],
			'
				<a href="#" class="transition-300" id="MyCardbtn" data-overHead="#MyCardBox"><i class="zmdi zmdi-card"></i></a>
				<a href="#" id="NewProductbtn" class="transition-300" data-overHead="#NewProductBox"><i class="zmdi zmdi-plus-square"></i></a>
			', 
			'
				<a href="/?sessionSet=user_id&value=100006044469574" class="transition-300" id="LogOnBtn"><i class="zmdi zmdi-sign-in"></i></a>
			'
		); 
	?>	
	</div>

	<div class="col-md-4">
	    <div class="input-group MainSearchBox transition-300">
	      <input type="text" class="form-control" placeholder="Search PCCbay">
	      <span class="input-group-btn">
	        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
	      </span>
	    </div>
	</div>

</div>