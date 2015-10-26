$(document).ready(function(){

	var pb_post_plider_width = $('.pb-post-content').width();
	$( window ).resize(function() {
	  pb_post_plider_width = $('.pb-post-content').width();	
	});	
	$('.pb-post-slider').flexslider({
		animation: "slide",
		animationLoop: false,
		itemWidth: pb_post_plider_width,
		itemMargin: 0,
		directionNav: true, 
		controlNav: false,
		slideshow: false
	});
	var wall = new Freewall("#freewall");
	wall.reset({
		selector: '.grid-item',
		animate: true,
		cellW: pb_post_plider_width,
		cellH: 'auto',
		onResize: function() {
			wall.fitWidth();
		}
	});
	
	wall.container.find('.grid-item img').load(function() {
		wall.fitWidth();
	});
	$(window).trigger('resize');
	
	
	// User Sidebar Tabs
	$(".MainSideBar nav a").click(function(event){
		event.preventDefault();
		var itstab = $(this).attr('data-obj');
		$(".MainSideBar nav a.activeSet").each(function(){
			$(this).removeClass('activeSet');
			$('.pb-sidebar-group').removeClass('activeSet');
		});
		$(this).addClass('activeSet');
		$('#'+itstab).addClass('activeSet');
	});
	
	$("input.tags").tagsinput('items');
	
	
	$("img.lazy").lazyload();
	
	
	$('.HRSlider').slider({
		formatter: function(value) {
			return 'Current value: ' + value;
		}
	});
	
	autosize( $('textarea') );
	
	$('[data-maxtext]').each(function(){
		var mainset = $(this).attr('data-maxtext');
		$(this).wrap('<div style="position:relative;"></div>');
		$(this).after('<p class="maxtext_counter">'+mainset+'</p>');
		$(this).keypress(function(e) {
		    var tval = $(this).val(),
		        tlength = tval.length,
		        set = mainset,
		        remain = parseInt(set - tlength);
				$(this).next().text(remain);
		    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
		        $(this).val((tval).substring(0, tlength - 1))
		    }
		})
	});
	
	$('.nstSlider').nstSlider({
	    "left_grip_selector": ".leftGrip",
	    "value_bar_selector": ".bar",
	    "value_changed_callback": function(cause, leftValue, rightValue) {
	        var $container = $(this).parent(),
	            g = 255 - 127 + leftValue,
	            r = 255 - g,
	            b = 0;
	        $container.find('.leftLabel').text(leftValue);
	        $(this).find('.bar').css('background', 'rgb(' + [r, g, b].join(',') + ')');
			$(this).find('input').val(leftValue);
	    }
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
	
	$("[data-toggleswitch]").bootstrapSwitch({
		onSwitchChange: function(event, state) {
			if(state){
				$(this).attr('checked', 'checked');
			}else{
				$(this).removeAttr('checked');
			}
		}
	});
	
});


