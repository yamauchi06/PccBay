<h3 class="pb-rule-below">Popular Tags</h3>
<div class="pb-post-tags">
	<ul>
		<?php topTags(20); ?>
	</ul>
</div>


<div id="FilterPriceRange"></div>
<script>
	$(document).ready(function(){
		pb_range(
			'#FilterPriceRange', 
			'Price Range', 
			10,0, 
			['All items', '$0-10', '$10-20', '$20-30', '$30-40', '$40-50', '$50-60', '$60-70', '$70-80', '$80-90', '$90-100+'], 
			function(ui, value, step){ 
				//Do somthing on change
			}
		);	
	});
</script>


<h5 style="text-align: left;margin: 0px;padding: 3px">You may be interested</h5>
<?php 
	pb_ad(["style"=>"width:100%;"]);
	
	pb_ad(["style"=>"width:100%;", "id"=>"free"]);
?>