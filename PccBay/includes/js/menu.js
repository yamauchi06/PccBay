$('body').on('click', '#MobMenu', function(event){
	event.preventDefault();

	var speed = 100;
	
	var pos = $(this).data('menu-pos');
	
	if(pos=='close' || !pos){
		var ML = -350;
		var MR = 0;
		$(this).data('menu-pos', 'open').addClass('active');
		$(this).find('i').switchClass( "zmdi-menu", "zmdi-close", speed, "easeInOutQuad" );
	}else{
		var ML = 0;
		var MR = -350;
		$(this).data('menu-pos', 'close').removeClass('active');
		$(this).find('i').switchClass( "zmdi-close", "zmdi-menu", speed, "easeInOutQuad" );
	}
	
	
	$( ".MainFeed" ).animate({
	    marginLeft: ML,
	}, speed);
	
	$( ".MainSideBar" ).animate({
	    marginRight: MR,
	}, speed);
	
});