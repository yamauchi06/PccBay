

<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below">
		New Post
		
		<div class="oh-top-menu" id="NowPostMenu">
			<ul>
				<li><a href="#" data-form="New_Post_Product" class="active">Product</a></li>
				<li><a href="#" data-form="New_Post_Question">Question</a></li>
				<li><a href="#" data-form="New_Post_Discussion">Discussion</a></li>
			</ul>
		</div>
		
	</h3>
	
	<div id="New_Post_Product" class="not-hidden new-post-toggle">
		<form method="post" action="">
			
			<input class="form-control" rows="3" name="product_title" placeholder="What is is?">
			
			<input class="form-control" rows="3" name="product_price" placeholder="Price.">
				
			<textarea class="form-control no-resize" rows="3" data-maxtext="400" name="product_desc" placeholder="Tell us about it."></textarea>
	
			<input class="form-control tags" rows="3" name="product_tags" placeholder="Tag it.">
			<br />
			
			<div class="row">
				<div class="col-md-1" style="margin-left:7px;">
					<span>Condition</span>
				</div>
				<div class="col-md-3">
					<div style="margin-left: 10px;" class="nstSlider" data-range_min="-100" data-range_max="100" data-cur_min="50" data-cur_max="0">
						<div class="highlightPanel"></div>
						<div class="bar"></div>
						<div class="leftGrip"></div>
						<input type="hidden" name="product_condition" />
					</div>
				</div>
			</div>
			
			<br />
	
			<div class="uploadBlock pb-rule-above-thick pb-rule-below-thick pb-dropzone" id="Post_Upload_photos">
				<div class="dz-message">
					<br />
					<i class="zmdi zmdi-image-o"></i><br />
					Click or Drop photos here!
				</div>
			</div>
			<input type="hidden" name="product_images">
	
			<div style="text-align: right;width: 100%;">
				<input type="submit" class="btn btn-default" name="add_product" value="Post it!">
				<a href="#" style="float: left;margin: 5px;">Privacy Policy </a>
			</div>
			
		</form>
	</div>
	
	<div id="New_Post_Question" class="hidden new-post-toggle">
		Question
	</div>
	
	<div id="New_Post_Discussion" class="hidden new-post-toggle">
		Discussion
	</div>
	
		
	
	
</div>


<script>
$('body').on('click', '#NowPostMenu a', function(){
	$('#NowPostMenu a.active').removeClass('active');
	$('.new-post-toggle').hide();
	$(this).addClass('active');
	$( '#'+$(this).data('form') ).removeClass('hidden').show();
	
});	
$(document).ready(function(){
	var uploaded_images = [];
	$("div#Post_Upload_photos").dropzone({ 
		url: "/includes/plugins/dropzone/postFile.php",
		success: function(file, response){
            uploaded_images.push( response.replace(/"/, '').replace(/ /, '') );
            $('[name="product_images"]').val(uploaded_images);
        }
	});
	
	$('[name="product_price"]').number( true, 2 );
});
</script>