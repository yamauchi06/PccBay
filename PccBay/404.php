<?php include_once('MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | The eBay for PCC</title>
		<?php pb_include('/MasterPages/head.php'); ?>
		<style>
		.Oldman{
			background-image: url('/images/interior-images/404-oldman.png');
			background-size: contain;
			background-repeat: no-repeat;
			background-position: left center;
			padding: 150px;
			margin-top: 50px;
			vertical-align: top;
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
			      <input type="text" class="form-control" placeholder="Search <?php print domain('title'); ?>" id="headerSearch">
			      <span class="input-group-btn">
			        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
			      </span>
			    </div>
			    <div class="autocomplete-wrapper">
					<div class="autocomplete-suggestions col-md-12"></div>
				</div>
			</div>
		</div>
	</header>
	
	<!-- Begin Content -->
	<div class="Oldman"></div>
<?php pb_include('/MasterPages/footer.php'); ?>
<script>
$(document).ready(function(){
	$('.Oldman').css({
		width: $(window).width(),
		height: $(window).height()-70
	});
});
$(window).resize(function(){
	$('.Oldman').css({
		width: $(window).width(),
		height: $(window).height()-70
	});
});

</script>
</body>
</html>