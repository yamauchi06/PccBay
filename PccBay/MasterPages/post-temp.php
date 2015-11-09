<div class="<?php if(!isset($_SESSION['user_id'])){print 'col-md-3';}else{print 'col-md-4';} ?> 
	pb-post grid-item" id="template-freewall">
	<div class="pb-post-block">
		<div class="pb-post-head">
			<img src="{{user.avatar}}" class="pb-post-avatar" />
			<div class="pb-post-author">
				<strong><a href="/@{{user.username}}">{{user.name}}</a></strong><br />
				<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">
				{{timestamp.laps}}
				</i></span>
			</div>
			<div class="pb-post-price">
				<span 
				class="pbPPHead"
				data-type="{{type}}"
				data-price="{{product_info.price}}"
				data-comment-count="{{comments.count}}"
				data-done="false"
				></span>
			</div>
		</div>
		<div class="pb-post-content">
			<h4>{{product_info.title}}</h4>
			
			<div class="pb_Pdesc"><p>{{product_info.desc}} </p></div>
			
			<a href="/item?id={{id}}"><img src="{{images.featured}}" class="pb-post-product lazy"></a>
						
			<div class="pb-post-tags" data-tags="{{product_info.tags}}"><ul></ul></div>
		</div>
		<div class="pb-post-foot-fill" data-post-id="{{id}}"></div>
	</div>
</div>