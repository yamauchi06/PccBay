<?php
	if(!isset($include_cmd)){$include_cmd='col-md-9';} 
	if($include_cmd=='col-md-12'){
		pb_include('/MasterPages/footer-fullWidth.php');
	}else{
		pb_include('/MasterPages/footer-partWidth.php');
	}
?>



<script src="/includes/js/bootstrap.min.js"></script>
<script src="/includes/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="/includes/js/bootstrap-tagsinput.min.js"></script>
<!-- <script src="/includes/plugins/flexslider/jquery.flexslider-min.js"></script> -->
<script src="/includes/js/overHead.js"></script>
<!-- <script src="/includes/js/lazyload.js"></script> -->
<script src="/includes/js/bootstrap-slider.js"></script>
<script src="/includes/plugins/dropzone/dropzone.js"></script>	
<script src="/includes/js/autosize.js"></script>	
<script src="/includes/plugins/nstSlider/jquery.nstSlider.min.js"></script>	
<script src="/includes/js/bootstrap-switch.min.js"></script>
<script src="/includes/plugins/formatter/jquery.number.min.js"></script>


<script src="/includes/plugins/bootstrap-wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="/includes/plugins/bootstrap-wysiwyg/prettify.js"></script>
<script src="/includes/plugins/bootstrap-wysiwyg/bootstrap-wysihtml5.js"></script>

<script src="/includes/plugins/devbridgeAutocomplete/jquery.autocomplete.js"></script>

<?php
if($include_cmd !== 'nolazyjson'){
	?>
	<script src="/includes/plugins/freewall/freewall.js"></script>
	<!-- <script src="/includes/plugins/Masonry/masonry.min.js"></script> -->
	<script src="/includes/plugins/lazyLoad/jquery.lazyjson.js"></script>
	<?php
}	
?>


<!-- All included scripts go above here -->
<script src="/includes/js/menu.js"></script>
<script src="/includes/js/_commonScripts.js"></script>