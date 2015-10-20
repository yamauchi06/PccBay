<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below">New Product</h3>
	
	<form class="pb-rule-below-thick" method="post">
		
		<input class="form-control" rows="3" placeholder="What is is?">
		
		<input class="form-control" rows="3" placeholder="Price.">
			
		<textarea class="form-control no-resize" rows="3" data-maxtext="200" placeholder="Tell us about it."></textarea>

		<input class="form-control tags" rows="3" placeholder="Tag it.">
		<br />
		<span style="margin-left: 10px;">Condition</span>
		<input id="ex1" data-slider-id='ex1Slider' class="HRSlider" type="text" data-slider-min="0" data-slider-max="6" data-slider-step="1" data-slider-value="6"/>
		
		<div class="checkbox" style="margin-left: 10px;">
            <input id="checkbox1" class="styled" type="checkbox" checked>
            <label for="checkbox1">
                Allow Bidding <sup><a href="#"><i class="zmdi zmdi-help-outline"></i></a></sup>
            </label>
        </div>
        
        <div class="checkbox" style="margin-left: 10px;">
            <input id="checkbox2" class="styled" type="checkbox" checked>
            <label for="checkbox2">
                Lock my images <sup><a href="#"><i class="zmdi zmdi-help-outline"></i></a></sup>
            </label>
        </div>
		
		
		<div class="uploadBlock pb-rule-above-thick">
			
			<form id="myAwesomeDropzone" action="includes/plugins/dropzone/postFile.php" class="dropzone">
				<div class="dz-message">
					<br />
					<i class="zmdi zmdi-image-o" style="font-size: 50px;color: #3498DB"></i><br />
					Drop photos here or click to upload
				</div>
<!--
				
				<div class="fallback">
					<input name="file" type="file" multiple />
			    </div>
-->
			</form>
	
		
			
		</div>

		
		<div style="text-align: right;width: 100%;">
			<input type="submit" class="btn btn-primary" value="Post it!">
		</div>
		
	</form>
	
	
</div>
