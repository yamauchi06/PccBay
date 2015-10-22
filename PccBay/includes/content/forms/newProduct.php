<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below">New Product</h3>
	
	<form class="pb-rule-below-thick" method="post">
		
		<input class="form-control" rows="3" name="product_title" placeholder="What is is?">
		
		<input class="form-control" rows="3" name="product_price" placeholder="Price.">
			
		<textarea class="form-control no-resize" rows="3" data-maxtext="200" name="product_desc" placeholder="Tell us about it."></textarea>

		<input class="form-control tags" rows="3" placeholder="Tag it.">
		<br />
		<table style="margin-left: 10px;" >
			<tr>
				<td>
					<span>Condition</span>
				</td>
				<td>
					<div style="margin-left: 10px;" class="nstSlider" data-range_min="-100" data-range_max="100" data-cur_min="100" data-cur_max="0" name="condition">	
						<div class="highlightPanel"></div>
						<div class="bar"></div>
						<div class="leftGrip"></div>
					</div>
				</td>
			</tr>
		</table>

		<div class="checkbox" style="margin-left: 10px;">
            <input id="checkbox1" class="styled" type="checkbox" checked>
            <label for="checkbox1">
                Allow Bidding <sup><a href="#" data-toggle="tooltip" title="Allow people to place bids on your item"><i class="zmdi zmdi-help-outline"></i></a></sup>
            </label>
        </div>
        
        <div class="checkbox" style="margin-left: 10px;">
            <input id="checkbox2" class="styled" type="checkbox" checked>
            <label for="checkbox2">
                Lock my images <sup><a href="#"data-toggle="tooltip" title="Helps  prevent people from saving your images."><i class="zmdi zmdi-help-outline"></i></a></sup>
            </label>
        </div>
		
		
		<div class="uploadBlock pb-rule-above-thick">
			
			<form id="myAwesomeDropzone" action="includes/plugins/dropzone/postFile.php" class="dropzone">
				<div class="dz-message">
					<br />
					<i class="zmdi zmdi-image-o"></i><br />
					Click or Drop photos here!
				</div>
<!--
				
				<div class="fallback">
					<input name="file" type="file" multiple />
			    </div>
-->
			</form>
	
		
			
		</div>

		
		<div style="text-align: right;width: 100%;">
			<input type="submit" class="btn btn-default" value="Post it!">
			<a href="#" style="float: left;margin: 5px;">Privacy Policy </a>
		</div>
		
	
	
</div>
