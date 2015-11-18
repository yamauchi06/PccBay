<?php  
	include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Services</title>
		<?php pb_include('/MasterPages/head.php'); ?>
		<style>
			fieldset{
				border: 1px solid #E6E9ED;
				border-radius: 2px;
				padding: 10px;
				margin-bottom: 10px;
			}	
			legend{
				margin-left: 10px;
				padding: 5px 30px;
				display: block;
				width: 200px;
				text-align: left;
			}
			.pb-page-block input[type="text"], textarea{
				width: 300px;
				border-radius: 1px;
				border: 1px solid #d6d9dc;
				font-size: 15px;
				height: 35px;
				font-weight: 300;
				font-family: sans-serif;
				padding: 3px;
				resize: none;
				position: relative;
			}
			textarea{
				width: 606px;
				height: 120px;
			}
			@media (max-width: 678px) {
				textarea{
					width: 300px;
				}
			}
			.pb-page-block input[type="text"]:active,.pb-page-block input[type="text"]:focus,textarea:focus{
				outline: none;
			}
			label{
				font-weight: 400;
				font-size: 15px;
				margin-left: 3px;
			}
		</style>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain.php'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu.php'); ?>
	
	<!-- Begin Content -->
	<div class="container">
		<div class="row">
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="background: no-repeat center url('/images/interior-images/students/coffee1.jpg');background-size:cover;height: 190px;padding: 0px;">
				<div class="pb-grade-lr-blue col-lg-12">
					
					<div class="col-md-6 pb-page-block-highlight" style="margin-top: 20px;">
						<h1>Join Forces Today</h1>
						<p>Word of mouth works, but this is better!</p>
						<a href="/services/" style="color:#ffffff;">Services Home Page</a>
					</div>
					
					<div class="col-md-2 pb-page-block-highlight" style="float: right;margin-right: 220px;">
						<img src="/images/interior-images/graph.svg" style="opacity:0.5;margin-top: -15px" />
					</div>
					
				</div>
			</div>
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="min-height:250px;">
				
				<form action="/services/join.php?ref=myService" method="post">
					
					<fieldset>
						<legend>About Your Service</legend>
						
						<div class="col-md-9">
							
							<label>
								Service Category<br />
								<input type="text" name="category" autocomplete="off">
							</label>
							
							<label>
								Name of Service<br />
								<input type="text" name="title">
							</label>

							<br /><br />
							
							<label>
								Cost of Service <small>($ USD)</small><br />
								<input type="text" name="cost">
							</label>
							
							<label>
								Location <small>(if any)</small><br />
								<input type="text" name="location">
							</label>
							
							<br /><br />
							
							<label>
								About your Service<br />
								<textarea name="about"></textarea>
							</label>
							
						</div>
						
						<div class="col-md-3">
							
							<h4>Give it a look</h4>
							
							<div class="pb-upload-file pb-dropzone" id="dz_profile_logo">
								<div class="dz-message">
									<i class="zmdi zmdi-mood icon"></i><br /><span class="text">Logo</span>
									<input type="hidden" name="profile_img">
								</div>
							</div>
							
							
							<div class="pb-upload-file pb-dropzone" id="dz_profile_opt">
								<div class="dz-message">
									<i class="fa fa-picture-o icon"></i><br /><span class="text">Optional image</span>
									<input type="hidden" name="profile_logo">
								</div>
							</div>
							

							<br /><br />
							<div class="pb-upload-file pb-upload-file-long pb-dropzone" id="dz_profile_cover">
								<div class="dz-message">
									<i class="fa fa-picture-o icon"></i><br /><span class="text">Cover</span>
									<input type="hidden" name="profile_cover">
								</div>
							</div>
							
							
						</div>
						

						<input type="submit" name="add_servise" class="pb-page-button" style="margin: 15px;float: right" value="Continue">	
						
					</fieldset>
					
				</form>
				
			</div>
			
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
<script src="/includes/plugins/typeahead/jquery.typeahead.min.js"></script>
<script src="/includes/js/pb-suggest.js"></script>
<script>	
$(document).ready(function(){
	$("div.pb-dropzone").dropzone({ 
		url: "/includes/plugins/dropzone/postFile.php",
		success: function(file, response){
			var thisInput = $( '#'+$(this)[0].element.id  ).find('input[type="hidden"]');
			var currImg = thisInput.val();
			if(currImg){ pb_remove_img(currImg, 'text'); }
			file['newname'] = response.replace(/"/, '').replace(/ /, '');
            thisInput.val(file['newname']);
        }
	});
	pb_suggest('[name="category"]',{
		minchar: 1,
		results: ["Hair Care","Cleaning","White Glove","Food Services","Ride Share","Design","Development","Tutor","Lifestyle","Personal Assistent"]
	});
	pb_suggest('[name="location"]',{
		minchar: 1,
		results: ["Ballard","Bradley Tower","Coberly","Dixon Tower","Griffith Tower","Young Tower"]
	});
});
</script>
</body>
</html>