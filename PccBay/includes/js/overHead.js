$(document).ready(function(){
	
	$( ".overHeadPullout" ).css({
		height: $(window).height()-$('header').height(),
		marginBottom: -$(window).height()
	});
	
	$('body').on('click', '[data-overHead]', function(event){
		event.preventDefault();
		var temp = $(this).attr('data-overHead-temp');
		if(!temp){temp='open-veiw';}
		overHead(this, false, temp );
	});
	
	$('body').on('click', '.overHead-close', function(event){
		overHead(this, true);
	});
/*
	$('.MainSideBar').click(function(event){
		overHead(this, true);
	});
*/
});

function overHead(that, just_close, temp){
	var state = $(that).attr('data-overHead_state');
	var inner = $(that).attr('data-overHead');
	var header = $('header').height();
	var docsize = $(window).height();
	
	
	$('#HiddenFrames .HiddenFrame').each(function(){
    	if( $(this).attr('id') != inner){
	    	$(this).hide();
    	}
	});
	
	
	$( window ).resize(function() {
		   if(state=='open'){
			   $( ".overHeadPullout" ).css({
					height: $(window).height()-$('header').height(),
					marginBottom: -$(window).height()
				});
		   }
	});	
		
	

	if(temp == 'open-veiw-trans'){
		$( ".overHeadPullout" ).css('background', 'rgba(232,235,238,0.90)');
	}else{
		$( ".overHeadPullout" ).css('background', '#E6E9ED');
	}
	if(just_close){
		$('.overHead-close').hide();
		$( ".overHeadPullout" ).animate({
	    	marginBottom: -docsize,
	    	opacity: 0
	  	}, 300, function() {
	    	$('#HiddenFrames .HiddenFrame').each(function(){
		    	if( $(this).attr('id') != inner){
			    	$(this).hide();
		    	}
	    	});
	  	});
	  	$('body').removeClass('noScroll');
		$(that).attr('data-overHead_state', 'close');
	}else{
		if( parseInt($('.overHeadPullout').css('margin-bottom')) <= 0 ){
			$(inner).show();
			$( ".overHeadPullout" ).animate({
		    	marginBottom: 0,
		    	opacity: 1
		  	}, 300, function() {
			  	$('.overHead-close').show();
			  	$(inner).show();
		  	});
			$(that).attr('data-overHead_state', 'open');
			$('body').addClass('noScroll');
		}
	}
}
