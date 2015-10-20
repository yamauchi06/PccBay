$(document).ready(function(){
	
	$('body').on('click', '[data-overHead]', function(event){
		event.preventDefault();
		var temp = $(this).attr('data-overHead-temp');
		if(!temp){temp='open-veiw';}
		overHead(this, false, temp );
	});
	$('body').on('click', '.overHead-close', function(event){
		overHead(this, true);
	});
	$('.MainSideBar').click(function(event){
		overHead(this, true);
	});
});

function overHead(that, just_close, temp){
	var state = $(that).attr('data-overHead_state');
	var inner = $(that).attr('data-overHead');
	var header = $('header').height();
	var docsize = $('.MainSideBar').height()+5;
	
	if(temp=='open-veiw' || temp == 'open-veiw-trans'){
		if($(document).width() < 992){
			$( ".overHeadPullout" ).width( $(document).width() );
		}else{
			$( ".overHeadPullout" ).width( $(document).width()-$('.MainSideBar').width() );
			$( window ).resize(function() {
			  $( ".overHeadPullout" ).width( $(document).width()-$('.MainSideBar').width() ).height( $('.MainSideBar').height() );
			});	
		}
	}
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
	    	$('#HiddenFrames .HiddenFrame').hide();
	    	$( ".overHeadPullout" ).css({marginBottom:0, height: 0});
	  	});
	  	
		$(that).attr('data-overHead_state', 'close');
	}else{
		if( $('.overHeadPullout').height() == 0 ){
			$(inner).show();
			$( ".overHeadPullout" ).animate({
		    	height: docsize,
		    	opacity: 1
		  	}, 300, function() {
			  	$('.overHead-close').show();
		    	
		  	});
			$(that).attr('data-overHead_state', 'open');
		}
	}
}
