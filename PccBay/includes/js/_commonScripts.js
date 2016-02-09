$(document).ready(function(){
	
	var API_Assess_Token = pb_graph_token('9827354187582375129873', '712638715312875');
	
	
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
	
	$('.HRSlider').slider({
		formatter: function(value) {
			return 'Current value: ' + value;
		}
	});
	
	autosize( $('textarea.autosize') );
	$('textarea.wysihtml5').wysihtml5();
	
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
	
	
	pb_delay(1000, function(){
		$('#headerSearch').devbridgeAutocomplete({
		    serviceUrl: '/graph/smartsearch?accessToken=rootbypass_9827354187582375129873',
		    paramName: 'q',
		    groupBy: 'category',
		    onSelect: function (suggestion) {
		       var type=suggestion.data.category,id=suggestion.data.id,title=suggestion.value;
		       if(type=="product"){ href('/item?id='+id); }
		       if(type=="user"){ href('/@'+id); }
		       if(type=="tag"){ href('/s/'+title); }
		       if(type=="service"){ href('/services/list#'+id); }
		    },
			onSearchComplete: function (query, suggestions) {
				if(suggestions){
					$('.autocomplete-suggestions').show();
				}else{
					$('.autocomplete-suggestions').hide();
				}
			}
		});
		
	})
	
	
	$(".codeSelect").click(function(event){
		
	});
	
	pb_stars('.pb-stars', true, true, '17px', '#E7711B');
	
	$('img').on('onerror', function(){
		$(this).replaceWith('<i style="width:'+$(this).width()+';height:'+$(this).height()+'" class="zmdi zmdi-broken-image"></i>');
	});
	
	MainSearch();
	
	$('.match-window-height').each(function(){
		$(this).css('min-height', $(window).height() + 'px');
	});
	
	
});//END READY


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

/*
$(window).load(function () {
	pb_delay(1000, function(){
		$('.Collage').montage({
			fillLastRow				: false,
			alternateHeight			: true,
			alternateHeightRange	: {
				min	: 90,
				max	: 240
			}
		});
	});
});
*/


function thispage(action){
	var page = window.location.href.split('/');
	if(action){
		if(action=='dir'){
			return page[page.length-2];
		}
	}else{
		return page[page.length-1];
	}
	
}

function userUrl(user_id){
	$.ajax({
		url: '/graph/users?accessToken=rootbypass_9827354187582375129873&q='+user_id, 
		dataType: 'json',
		success: function(result){
			window.history.replaceState("@"+result[0].username, result[0].username, "/@"+result[0].username);
		},
	});
}

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
	}
	else if(hashName=='notify_keep'){
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

function ini_grid(ini_gridCount){
	var pb_post_plider_width = $('.pb-post-content').width();
	$( window ).resize(function() { pb_post_plider_width = $('.pb-post-content').width(); });
	var wall = new Freewall("#freewall");
	wall.reset({
		selector: '.grid-item',
		animate: false,
		cellW: pb_post_plider_width,
		cellH: 'auto',
		onResize: function() { wall.fitWidth(); },
	});
	wall.fitWidth();
}

function pb_graph_token(app_id, expire){
	$.ajax({
		url: '/graph/accessToken.php?app_id='+app_id, 
		dataType: 'text',
		success: function(result){
			return result;
		},
	});
}


function pb_delay(time, func, funcParam){
	setTimeout(
	  function() 
	  {
	    func(funcParam);
	  }, time);
}

function href(url){ window.location.href = url; }

function pb_remove_img(Image_ID, dataType, callback){
	 $.ajax({
        type: 'POST',
        url: '/includes/plugins/dropzone/delete.php',
        data: "id="+Image_ID,
        dataType: dataType,
        success: function(data) {  if(callback){ callback(data); }  }
    });
}

function isInt(n){
    return Number(n) === n && n % 1 === 0;
}

function isFloat(n){
    return n === Number(n) && n % 1 !== 0;
}

function pb_stars(selector, show_stars, show_numbers, size, color){
	$(selector).each(function(){
		var types={'empty':'<i class="zmdi zmdi-star-outline"></i>','half':'<i class="zmdi zmdi-star-half"></i>','full':'<i class="zmdi zmdi-star"></i>'}
		var stars = $(this).data('stars');
		var text = $(this).data('post-text');
		var stkind;
		var starArr=[];
		var i=0;
		while(i <= 5){
			if(i < stars){
				stkind='full';
			}
			if(i==stars){
				stkind='half';
			}
			if(i>stars){
				stkind='empty';
			}
			starArr.push(stkind);
			i=i+.5;
		}
		if(show_numbers){
			if(stars){
				$(this).append('<span>'+parseFloat(stars).toFixed(1)+' </span>');
			}
		}
		if(show_stars){
			for(i = 1; i < starArr.length; i += 2) {
			   $(this).append(types[ starArr[i] ]);
			}
		}
		if(text){
			m='';
			if(text>1){m='(s)';}
			$(this).append('<span> '+text+' review<sup>'+m+'</sup></span>');
		}
		$(this).css({
			'font-size': size,
			'color': color
		});
	});
}

function hexToRgba(hex,opacity){
    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}

function highlighBlock(id, classOrColor, ini1, ini2, speed){
	if(classOrColor=='color'){
		$(id).animate({
			backgroundColor: ini1
		}, speed);
		$(id).animate({
			backgroundColor: ini2
		}, speed);
	}
	if(classOrColor=='class'){
		$(id).addClass(ini1, {duration:speed});
		$(id).removeClass(ini1, {duration:speed});
	}
}

function pb_magnify(that, native_width, native_height, e){
	if(!native_width && !native_height)
	{
		var image_object = new Image();
		image_object.src = $(".small").attr("data-src");

		native_width = image_object.width;
		native_height = image_object.height;
	}
	else
	{
		var magnify_offset = $(that).offset();
		var mx = e.pageX - magnify_offset.left;
		var my = e.pageY - magnify_offset.top;

		if(mx < $(that).width() && my < $(that).height() && mx > 0 && my > 0)
		{
			$(".large").fadeIn(100);
		}
		else
		{
			$(".large").fadeOut(100);
		}
		if($(".large").is(":visible"))
		{
			var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
			var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
			var bgp = rx + "px " + ry + "px";

			var px = mx - $(".large").width()/2;
			var py = my - $(".large").height()/2;

			$(".large").css({left: px, top: py, backgroundPosition: bgp});
		}
	}
}


function magniflier(){
	  var native_width = 0;
	  var native_height = 0;
	  var mouse = {x: 0, y: 0};
	  var magnify;
	  var cur_img;
	
	  var ui = {
	    magniflier: $('.magniflier')
	  };
	  if (ui.magniflier.length) {
	    var div = document.createElement('div');
	    div.setAttribute('class', 'magniflier_glass');
	    ui.glass = $(div);
	    $('body').append(div);
	  }
	
	  var mouseMove = function(e) {
	    var $el = $(this);
	    var magnify_offset = cur_img.offset();
	    mouse.x = e.pageX - magnify_offset.left;
	    mouse.y = e.pageY - magnify_offset.top;
	    if (
	      mouse.x < cur_img.width() &&
	      mouse.y < cur_img.height() &&
	      mouse.x > 0 &&
	      mouse.y > 0
	      ) {
	
	      magnify(e);
	    }
	    else {
	      ui.glass.fadeOut(100);
	    }
	
	    return;
	  };
	
	  var magnify = function(e) {
	    var rx = Math.round(mouse.x/cur_img.width()*native_width - ui.glass.width()/2)*-1;
	    var ry = Math.round(mouse.y/cur_img.height()*native_height - ui.glass.height()/2)*-1;
	    var bg_pos = rx + "px " + ry + "px";
	    var glass_left = e.pageX - ui.glass.width() / 2;
	    var glass_top  = e.pageY - ui.glass.height() / 2;
	    ui.glass.css({
	      left: glass_left,
	      top: glass_top,
	      backgroundPosition: bg_pos
	    });
	
	    return;
	  };
	
	  $('.magniflier').on('mousemove', function() {
	    ui.glass.fadeIn(100);
	    
	    cur_img = $(this);
	
	    var large_img_loaded = cur_img.data('large-img-loaded');
	    var src = cur_img.data('large') || cur_img.attr('src');
	    if (src) {
	      ui.glass.css({
	        'background-image': 'url(' + src + ')',
	        'background-repeat': 'no-repeat'
	      });
	    }
	      if (!cur_img.data('native_width')) {
	        var image_object = new Image();
	
	        image_object.onload = function() {
	          native_width = image_object.width;
	          native_height = image_object.height;
	
	          cur_img.data('native_width', native_width);
	          cur_img.data('native_height', native_height);
	          mouseMove.apply(this, arguments);
	
	          ui.glass.on('mousemove', mouseMove);
	        };
	
	
	        image_object.src = src;
	        
	        return;
	      } else {
	
	        native_width = cur_img.data('native_width');
	        native_height = cur_img.data('native_height');
	      }
	    mouseMove.apply(this, arguments);
	
	    ui.glass.on('mousemove', mouseMove);
	  });
	
	  ui.glass.on('mouseout', function() {
	    ui.glass.off('mousemove', mouseMove);
	  });
}

function pb_range(selector, title, steps, start, stArr, callback){
	var inStep=function(that){
		var inStep = Math.ceil( parseInt($(that).val()) / stArr.length );
		$('#'+mkId).text(stArr[inStep]);
	}
	var mkId = 'pb_range_'+title.replace(/ /g, '');
	$(selector).prepend('<label>'+title+'</label><input type="range" name="'+mkId+'" step="'+steps+'" value="'+start+'" /><div id="'+mkId+'"></div><br />');
	inStep('[name="'+mkId+'"]');
	$(selector).find('input[name="'+mkId+'"]').on('change', function(){ 
		inStep(this); 
		callback(this, $(this).val(), Math.ceil( parseInt($(this).val()) / stArr.length ) ); 
	});
	
}

function onDoneTyping(inputOBJ, callback, time){
	var typingTimer;                //timer identifier
	var doneTypingInterval = time;  //time in ms, 5 second for example
	var $input = inputOBJ;
	$input.on('keyup', function () {
	  clearTimeout(typingTimer);
	  typingTimer = setTimeout(callback, doneTypingInterval);
	});
	$input.on('keydown', function () {
	  clearTimeout(typingTimer);
	});
}

function MainSearch(){
	var form = $('.pb-main-search');
	var text = form.find('input[type="text"]');
	var submit = form.find('input[type="submit"]');
	var results = form.find('.pb-main-search-results');
	var token=null;
	var input;
	form.submit(function(e){ e.preventDefault(); });
	//get token
	$.get("/graph/?app_id=9827354187582375129873&secret=712638715312875",function(d){token=d.token;});
	
	//do search
	onDoneTyping(text, function(){
		results.empty();
		input=text.val();
		if(token!=null){
			$.get("/graph/smartsearch?q="+input+"&accessToken="+token+"",function(json){
				$.each(json.suggestions, function(index, data){
					if(data.value){
						var result ='<div class="pb-main-search-result">'+
								'<h4>'+data.value+'</h4>'+
								'<p></p>'+
							    '</div>';
						results.append(result);
					}
				});
			});
		}else{ alert('no token'); }
	}, 200);
}

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
