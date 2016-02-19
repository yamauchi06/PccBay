<html>
<body>
	<head>
		<script src="/includes/js/jquery.js"></script>
		<script src="/includes/js/jquery.waypoints.js"></script>
		<script src="/includes/js/moment.js"></script>
		<style>
		h1 {
		  text-align: center;
		}
		.posts {
		  max-width: 40rem;
		  margin-left: auto;
		  margin-right: auto;
		}
		.post {
		  margin-bottom: 0.25rem;
		  padding-bottom: 0.5rem;
		  padding-sides: 3%;
		  background: #d9f2fd;
		  opacity: 0;
		  animation: fade-in-up 150ms ease-in;
		  animation-fill-mode: both;
		}
		.post:last-child {
		  margin-bottom: 0;
		}
		.post time {
		  font-variant-numeric: oldstyle-nums;
		  font-feature-settings: "onum";
		}
		@keyframes fade-in-up {
		  0% {
		    opacity: 0;
		    transform: translateY(2rem);
		  }
		  100% {
		    opacity: 1;
		    transform: translateY(0);
		  }
		}	
		</style>
	</head>	
	

<div class="page">
    <h1>Stellar News</h1>
    <div class="posts" id="posts"></div>
</div>	


<script>
	//'//www.stellarbiotechnologies.com/media/press-releases/json' + ("?limit=" + quantity + "&offset=" + (offset * quantity) + "&callback=")
(function() {
    $(function() {
        var indexCount, loadData, postWatcher, quantity = 4, lastin=quantity, limit=0;
        indexCount = 0;
        loadData = function(offset) {
            $('#posts').append('<div class=post id=loading-message>Loading...</div>');
            return $.getJSON('/graph/f/' + ("?limit="+limit+"&offset="+lastin+"&callback="), function(data) {
                if (data.length) {
                    return $('#loading-message').fadeOut(100, function() {
                        var html, i, index, item, len, ref;
                        $(this).remove();
                        html = '';
                        for (index = i = 0, len = data.length; i < len; index = ++i) {
                            item = data[index];
                            if( $('[data-pid="'+item.id+'"]').length == 0 ){
	                            html += "<article data-pid='"+item.id+"' style='animation-delay: " + ((index + 1) * 100) + "ms' class='post'>\n  <h2>" + item.product_info.title + "</h2>\n</article>";
                            }
                        }
                        $('#posts').append(html);
                        
                        lastin = lastin + quantity;
                        limit = limit + quantity;
                        
                        indexCount++;
                        return postWatcher();
                    });
                } else {
                    return $('#loading-message').text('All posts have been loaded');
                }
            });
            
        };
        postWatcher = function(done) {
            $('#posts').after('<div id="load-more"></div>');
            return $('#load-more').waypoint(function(direction) {
                loadData(indexCount);
                return this.destroy();
            }, {
                offset: '120%'
            });
        };
        return loadData(0);
    });

}).call(this);	
//http://abstracthat.com/blog/lazy-load-infinite-scroll-json/
</script>	
</body>
</html>