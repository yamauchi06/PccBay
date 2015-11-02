(function ( $ ) {
	$.fn.pbcomments = function( options ) {
		
		// Set Default Variables
	    var defaults = $.extend({
			parent_id: null,
			uploads: true,
			form: true
	    }, options );
	    
	    var that = $(this);
	    if(defaults.form){
		    var form = that.data('form');
			defaults.parent_id = $(form).find('[name="id"]').val();
	    }else{
		    defaults.parent_id = that.data('id');
	    }
	    
	    //check if allow files
	    if(defaults.uploads){
		    var file = $(form).find('[type="file"]');
		    file.wrap('<div class="pb-comments-file-btn">');
		    $('body').on('click', '.pb-comments-file-btn', function(){
			    $('.pb-comments-file-btn input').trigger('click');
		    });
	    }

	    function loadedComments(){
		$.ajax({
		    url: '/graph/comments?q='+defaults.parent_id+'&timeago=true',
		    dataType: 'json',
		    type: 'GET',
		    error: function(xhr, error){
			    console.debug(xhr); console.debug(error); console.log('Craw URL:', jsonURL);
			},
		    success: function(data) {
			    $('#product_comemnts').empty();
			    $('.pb-comment-form').show();
				$.each(data, function(i,json) {
					var sql = "SELECT * FROM pb_users WHERE user_id="+json.author;
					$.getJSON( "/includes/json/crawdb.php?get=user_data&sql="+sql, function( user_data ) {
						$('#product_comemnts').append(
						'<div class="col-md-12 pb-post pb-comment">'+
					    	'<div class="pb-post-block">'+
					            '<div class="pb-post-head">'+
					            	'<div class="pb-menu-icon"><i class="zmdi zmdi-chevron-down"></i></div>'+
					                '<img class="pb-post-avatar" src="'+user_data[0].avatar+'">'+
					                '<div class="pb-post-author">'+
					                   ' <strong><a href="/@'+user_data[0].username+'">'+user_data[0].name+'</a></strong><br>'+
					                    '<span class="pb-post-timestamp"><i class="pb-post-timestamp-o">'+data[i].date+'</i></span>'+
					                '</div>'+
					            '</div>'+
					            '<div class="pb-post-content">'+
									''+data[i].comment+''+
					            '</div>'+
					        '</div>'+
					   ' </div>'
					   );	
					});//end user get
				});//end each
		    }//end success
		});// end agax
	}
	$(document).ready(function(){
		$('#product_comemnts').append('<br /><img class="pb-center-image" style="opacity:0.3;width:40px" src="/images/interior-images/innerlaced-loader.gif" />');
		$('body').on('click', '.pb-comment-area', function(event){
			event.stopPropagation();
			var commenter = $(this).find('textarea');
			commenter.removeClass('fixedHeight').attr('pos', 'open').next('.pb-comment-area-lower').show(200);
		});
		$('body').on('click', function(){
			var commenter = $('.pb-comment-area textarea');
			if( commenter.attr('pos')=='open' ){
				commenter.addClass('fixedHeight').attr('pos', 'closed').next('.pb-comment-area-lower').hide(400);
			}
		});
		
		$('body').on('click', '[name="add_comment"]', function(event){
			event.preventDefault();
			var textarea=$('.pb-comment-area textarea')
			var comment = textarea.val().replace(/'/, '&#39;').replace(/"/, '&#34;').replace(/&/, '&#38;').replace(/\?/, '&#63;');
			$.ajax({
			  type: "POST",
			  url: '/includes/php/async.php?function=pb_add_comment',
			  data: "comment="+comment+'&post_id='+defaults.parent_id,
				success: function(data, textStatus, jqXHR)
			    {
				    textarea.val('');
				    $('body').trigger('click');
			        loadedComments();
			    },
			    error: function (jqXHR, textStatus, errorThrown)
			    {
					console.log(jqXHR, textStatus, errorThrown);
			    }
			});
		});
	});
	$(window).load(function () { loadedComments(); });
	
	
	};
}( jQuery ));  