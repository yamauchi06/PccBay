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
	
	autosize( $('textarea.autosize') );
	$('textarea.wysihtml5').wysihtml5();
	
/*
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
*/
	
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
	
	if(window.location.hash) {
		handleHash(window.location.hash);
	}
	$(window).on('hashchange',function(){ 
		handleHash(location.hash);
	});
	
	
});


$('img.svg').each(function(){
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');

        // Add replaced image's ID to the new SVG
        if(typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if(typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass+' replaced-svg');
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
        if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
        }

        // Replace image with new SVG
        $img.replaceWith($svg);

    }, 'xml');

});


function htmlentities(string){
	string
	.replace(/'/, '&#39;')
	.replace(/"/, '&#34;')
	.replace(/;/, '&#59;')
	.replace(/:/, '&#58;')
	.replace(/`/, '&#96;')
	return string;
}

function handleHash(hash){
	var hashName = hash.replace('#','');
	var hashSplit = hashName.split('=');
	hashName=hashSplit[0];
	hashValue=hashSplit[1];
	
	if(hashName=='notify'){
		$('#notify_'+hashValue).hide();
		$.post( '/includes/php/async.php?function=pb_update_notifications&params='+hashValue+',1', function( data ) {  });
	}else{
		$('.HiddenFrame').each(function(){
			if( this.id == hashName ){
				$('[data-overHead="'+hash+'"]').trigger('click');
			}
		});
	}
}


