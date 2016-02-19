//Defaut variables
var lazyFeed = {
	load: {
		start: 0,
		end: 5
	},
	offset: '150%', 
	animate: 100,
	delay: 500,
	filter: thispage()
};
//Defaut variables

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

$(document).ready(function(){
	
	
    $(function() {
        var indexCount, loadData, postWatcher, lastin=quantity, limit=0, post_size="col-md-3";
        var fin, lin, quantity = lazyFeed.load.end;
        indexCount = 0;
        
        loadData = function(offset, max) {
	        max = parseInt(max)-1;
	        fin = max-quantity;
	        if( $('#freewall').hasClass('logging_in') ){ post_size="col-md-4"; }
            $('#freewall').append('<div class=post id="lj-loader"></div>');
            
            for(var lbl=0; lbl<=quantity; lbl++){
	            $('#freewall').append('<div class="pb-post grid-item pb-post-clear pb-post-placeholder '+post_size+'"><div class="pb-post-block pb-post-clear"><img src="http://pccbay.localhost/images/interior-images/postPlaceholder.gif" width="100%" /></div></div>');
            }
            
            var graph_uri = "?limit="+fin+"&offset="+max+"&callback=";
            if(lazyFeed.filter.length > 0){
	            graph_uri = "?filter="+lazyFeed.filter+"&callback=";
            }
            
            return $.getJSON('/graph/f/' + (graph_uri), function(data) {
                if (data.length) {
	                return $('#lj-loader').fadeOut(lazyFeed.animate, function() {
	                    var html, i, index, item, len, ref;
	                    $(this).remove();
	                    $('.pb-post-placeholder').remove();
	                    html = '';
	                    for (index = i = 0, len = data.length; i < len; index = ++i) {
	                        item = data[index];
	                        if( $('#pb_post_'+item.id).length === 0 ){
	                            html += '<div class="pb-post grid-item '+post_size+'">'+
											'<div class="pb-post-block" id="pb_post_'+item.id+'">'+
												'<div class="pb-post-head">'+
													'<img src="'+item.user.avatar+'" class="pb-post-avatar" />'+
													'<div class="pb-post-author">'+
														'<strong><a href="/@'+item.user.id+'">'+item.user.name+'</a></strong><br />'+
														'<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">'+
														''+item.timestamp.laps+
														'</i></span>'+
													'</div>'+
													'<div class="pb-post-price">'+
														'<span class="pbPPHead"'+
														'data-type="'+item.type+'"'+
														'data-price="'+item.product_info.price+'"'+
														'data-user-id="'+item.user.id+'"'+
														'data-done="false"></span>'+
													'</div>'+
												'</div>'+
												'<div class="pb-post-content">'+
													'<a href="/item?id='+item.id+'" class="tempFI_height">'+
													'<img src="'+item.images.featured+'" class="pb-post-product lazy"></a>'+
													'<h4>'+item.product_info.title+'</h4>'+
													'<div class="pb_Pdesc"><p>'+item.product_info.desc+'</p></div>'+
													'<div class="pb-post-tags" data-tags="'+item.product_info.tags+'"><ul></ul></div>'+
												'</div>'+
											'</div>'+
										'</div>';
	                        }
	                    }
	                    $('#freewall').append(html);
	                    
	                    lastin = lastin + quantity;
	                    limit = limit + quantity;
	                    if(data.length >= lazyFeed.load.end-1){
		                    indexCount++;
	                    }
	                    setTimeout(function(){
		                    ini_grid(indexCount);
	                    }, lazyFeed.delay)
	                    return postWatcher();
	                });
                } else {
	                $('.pb-post-placeholder').remove();
                    return $('#lj-loader').html('<h3 id="lj-noresponse">No More Posts</h3>');
                }
            });
        };
        postWatcher = function(done) {
	        $('#load-more').remove();
            $('#freewall').after('<div id="load-more"></div>');
            return $('#load-more').waypoint(function(direction) {
                if(indexCount>=1){
	                loadData(indexCount, fin);
                }
                return this.destroy();
            }, {
                offset: lazyFeed.offset
            });
        };
        return $.getJSON('/graph/f/?row_count', function(d) { loadData(lazyFeed.load.start, d.rows); });
    });
});