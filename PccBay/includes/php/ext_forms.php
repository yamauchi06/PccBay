<?php
	//Add Product
	if(isset($_POST['add_product'])) {
		pb_add_product($_SESSION['user_id']);
	}  
	
	
	// Account settings
	if(isset($_POST['account_submit'])){
		pb_update_account($_SESSION['user_id']);
	}	
?>