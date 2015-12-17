<?php if(!CHROME_APP){ if( pb_is_allowed(50) ){ ?>
<link rel="stylesheet" href="/includes/css/pb-admin-styles.css" type="text/css" />
<div class="row pb-admin-header">
	
	<ul class="nav nav-left">
		<?php if( pb_is_allowed(50) ){ ?><li> <a href="/admin/pb/" class="pb-admin-link"><i class="icon zmdi zmdi-view-quilt"></i> Dashboard</a> </li><?php } ?>
		
		<?php if( pb_is_allowed(75) ){ ?><li> <a href="/admin/pb/analytics" class="pb-admin-link"><i class="icon zmdi zmdi-chart"></i> Analytics</a> </li><?php } ?>
		
		<?php if( pb_is_allowed(50) ){ ?><li> <a href="/admin/pb/tasks" class="pb-admin-link"><i class="icon zmdi zmdi-assignment"></i> Tasks <div class="pb-nav-bub">3</div></a> </li><?php } ?>
		
		<?php if( pb_is_allowed(50) ){ ?><li> <a href="/admin/pb/feedback" class="pb-admin-link"><i class="icon zmdi zmdi-mood"></i> Feedback</a> </li><?php } ?>
	</ul>
	
	
	<ul class="nav nav-right">
		<li> 
			<a href="#" class="pb-admin-link">
			<?php	
				print '<img src="'.pb_user()->avatar.'" />';
				print pb_user()->name;
			?>
			</a> 
		</li>
	</ul>
	
</div>
<?php } }	?>