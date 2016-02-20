<?php include_once('MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Privacy Policy</title>
		<?php pb_include('/MasterPages/head.php'); ?>
		<style>
		.help-img{
			max-width: 500px;
		}	
		.faq-category{
			padding-left: 10px;
		}
		</style>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain.php'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu.php'); ?>
	
	<!-- Begin Content -->
	<div class="container  match-window-height">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1" style="position: relative">
				
				
				<div class="col-md-3" style="padding: 0px">
					<div class="sticky-sidebar">
						<div class="pb-page-block">
							<ul class="faq-links">
								<li><a href="" class="active">Basic</a></li>
								<li><a href="">Posts</a></li>
								<li><a href="">Search</a></li>
							<li><div></div></li>
								<li><a href="">Account</a></li>
							<li><div></div></li>
								<li><a href="">Mobile</a></li>
								<li><a href="">Chrome Plugin</a></li>
							</ul>
						</div>
						<a href="#" style="padding: 10px;">Can't find what your looking for?</a>
					</div>
				</div>
				
				<div class="col-md-9 pb-page-block" style="padding: 0px">
					<ul class="ul-faq">
						<?php
							pb_db("SELECT * FROM pb_faq ORDER BY category ASC", function($row){
								print '<li data-category="'.$row['category'].'">';
								print 	'<h3>'.$row['question'].'</h3>';
								print 	'<div class="a"><div class="a-inner">'.$row['answer'].'</div></div>';
								print '</li>';
							});	
						?>
					</ul>
				</div>
				
				
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
<script>
$(document).ready(function(){
	$('.ul-faq').find('li').on('click', function(){
		var li=$(this);
		var h3=li.find('h3');
		h3.next('.a').animate({height: ['toggle', 'swing']});
		li.toggleClass('active');
	});
	
	$('.faq-links').find('a').on('click', function(e){
		e.preventDefault();
		$('.faq-links a').removeClass('active');
		$(this).toggleClass('active');
		var go_to=$(this).text().toLowerCase();
		var topcat = $("[data-category="+go_to+"]").first();
		$('html, body').animate({
	        scrollTop: topcat.offset().top-60
	    }, 1000);
	});
	
/*
	var categories=[];
	$("[data-category]").each(function(){
		var category=$(this);
		var text=category.data('category');
		if(jQuery.inArray(text, categories) !== -1){}else{
			categories.push(text);
			category.before('<span class="faq-category">'+text+'</span>')
		}
	});
*/
	
	var stickySidebar=$(".sticky-sidebar");
	function fixDiv() {
		if($(window).width() > 901){
		    stickySidebar.css({
			   position: 'absolute',
			   top: $(window).scrollTop()
		    });
	    }else{
		    stickySidebar.css({
			   position: 'relitive',
			   top: 'auto'
		    });
	    }
	  }
	$(window).scroll(fixDiv);
	
});	
</script>
</body>
</html>
