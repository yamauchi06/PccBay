<?php  include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | The eBay for PCC</title>
		<?php pb_include('/MasterPages/head.php'); ?>
		<style>
		.Oldman{
			background-image: url('/images/interior-images/404-oldman.png');
			background-size: contain;
			background-repeat: no-repeat;
			background-position: left center;
			padding: 150px;
			margin-top: 50px;
		}	
		.Oldman h1{
			font-size: 100px;
		}
		.Oldman p{
			font-size: 23px;
		}
		small{
			font-size: 16px;
		}
		footer{
			position: absolute !important;
			bottom: 0px;
			left: 0px;
			width: 100% !important;
		}
		</style>
	</head>	
<body>
	<header>		
		<div class="row">	
			<div class="col-md-3">
				<a href="/"><img src="/images/favicon/pccBay-icon.svg" height="40px" alt="PccBay" /></a>
			</div>	
			<div class="col-md-2 col-md-offset-3" id="headerBtns"></div>
			<div class="col-md-4">
			    <div class="input-group MainSearchBox transition-300">
			      <input type="text" class="form-control" placeholder="Search PCCbay">
			      <span class="input-group-btn">
			        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
			      </span>
			    </div>
			</div>
		</div>
	</header>
	
	<!-- Begin Content -->
	<div class="Oldman"></div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
<script>
$(document).ready(function(){
	$('.Oldman').css({
		width: $(window).width(),
		height: $(window).height()-50
	});
});
$(window).resize(function(){
	$('.Oldman').css({
		width: $(window).width(),
		height: $(window).height()-50
	});
});

</script>
</body>
</html>