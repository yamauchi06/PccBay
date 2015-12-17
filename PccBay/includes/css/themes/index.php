<?php
    header("Content-type: text/css; charset: UTF-8");
	include('colors/'.$_GET['t'].'.php');
	function rgba($color, $opacity = false) {
		$default = 'rgb(0,0,0)';
		if(empty($color))
	          return $default;  
	        if ($color[0] == '#' ) {
	        	$color = substr( $color, 1 );
	        }
	        if (strlen($color) == 6) {
	                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	        } elseif ( strlen( $color ) == 3 ) {
	                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	        } else {
	                return $default;
	        }
	        $rgb =  array_map('hexdec', $hex);
	        if($opacity){
	        	if(abs($opacity) > 1)
	        		$opacity = 1.0;
	        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	        } else {
	        	$output = 'rgb('.implode(",",$rgb).')';
	        }
	        return $output;
	}
?>
header{
	background-color: <?php echo $brandColor; ?>;
	border-bottom: 2px <?php echo $brandColor_dark; ?> solid;
	box-shadow: 1px 0px 6px <?php echo $brandColor_dark; ?>;
}

a {
    color: <?php echo $linkColor; ?>;
}
a:hover {
    color: <?php echo $linkColor_hover; ?>;
}

.themeBG{
	background: <?php echo $brandColor; ?>;
}
.themeBG-dark{
	background: <?php echo $brandColor_dark; ?>;
}
.themeColor{
	color: <?php echo $brandColor; ?>;
}

.themeBG-80{
	background: <?php echo rgba($brandColor, 0.8); ?>;
}
.themeBG-60{
	background: <?php echo rgba($brandColor, 0.6); ?>;
}
.themeBG-50{
	background: <?php echo rgba($brandColor, 0.5); ?>;
}
.themeBG-20{
	background: <?php echo rgba($brandColor, 0.2); ?>;
}

.MainSideBar nav a:hover{
	color: <?php echo $brandColor; ?>;
}
.MainSideBar nav a.activeSet{
	color: <?php echo $brandColor; ?>;
	border-bottom: 2px <?php echo $brandColor; ?> solid;
}

.btn-default{
	color: #ffffff;
	background-color: <?php echo $brandColor_dark; ?>;
	border-color: <?php echo $brandColor_dark; ?>;
}
.btn-default:hover{
	color: #ffffff;
	background-color: <?php echo $brandColor_dark; ?>;
	border-color: <?php echo $brandColor_dark; ?>;
}


.pb-page-divider{
	background: <?php echo $brandColor; ?>;
}


.pb-post-author{
	color: <?php echo $brandColor; ?>;
}

.pb-post-timestamp .zmdi{
	color: <?php echo $brandColor; ?>;
}

.pb-post-tag{
	background: <?php echo $brandColor; ?>;
	border-bottom: 2px <?php echo $brandColor; ?> solid;
}
.feed-post-tab-link{
	border-color: <?php echo $brandColor; ?>;
}
.feed-post-tab-link:hover, .feed-post-tab-link-Cancel:hover, .feed-post-tab-link-Accept:hover{
	color: #ffffff;
	background: <?php echo $brandColor; ?>;
	border-color: <?php echo $brandColor; ?>;
}

.pb-post-flash{
	background: <?php echo $brandColor; ?>;
}
 
.pb-sidebar-group::-webkit-scrollbar-thumb {
  background-color: <?php echo $brandColor; ?>
}

.pb-sidebar-group h3{
	color: <?php echo $brandColor; ?>;
}

.pb-sticky-btn.feedback{
	background: <?php echo $brandColor; ?>;
}



/* overHead */
.overHeadPullout{
	background: <?php echo $brandColor; ?>;
}
.oh-section h3{
	color: <?php echo $brandColor; ?>;
}

#ex1Slider .slider-selection {
	background: <?php echo $brandColor; ?>;
}

.dz-message i{
	color: <?php echo $brandColor; ?>
}

/* Toggle Buttons */
.bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-theme,
.bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-theme {
  color: #ffffff;
  background: <?php echo $brandColor; ?>;
}


.oh-top-menu li a:hover, .oh-top-menu li a.active{ background: <?php echo $brandColor; ?>; }



.pb-myComm{
	border-left: 2px <?php echo $brandColor; ?> solid;
}

.autocomplete-suggestion strong{
	border-color:<?php echo $brandColor; ?>;
}


.pb-grade-lr-theme{
	background: -webkit-linear-gradient(left, <?php echo $brandColor; ?>, <?php echo rgba($brandColor, 0.4); ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(right, <?php echo $brandColor; ?>, <?php echo rgba($brandColor, 0.4); ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(right, <?php echo $brandColor; ?>, <?php echo rgba($brandColor, 0.4); ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to right, <?php echo $brandColor; ?>, <?php echo rgba($brandColor, 0.4); ?>); /* Standard syntax (must be last) */
}

.pb-item-button{
	border: 2px <?php echo $brandColor; ?> solid;
}
.pb-item-button:hover{
	background: <?php echo $brandColor; ?>;
}

.figureOptions li.active{
	border: 2px <?php echo $brandColor; ?> solid;
}

.corner-text{
	background-color: <?php echo $brandColor; ?>;
}

input[type=range]:focus::-ms-fill-lower {
  background: <?php echo $brandColor; ?>;
}
input[type=range]:focus::-ms-fill-upper {
  background: <?php echo $brandColor; ?>;
}
input[type=range]::-ms-fill-lower {
  background: <?php echo $brandColor; ?>;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: <?php echo $brandColor; ?>;
}
input[type=range]::-webkit-slider-runnable-track {
  background: <?php echo $brandColor; ?>;
}

.pb-page-block-highlight .pb-page-button-theme{
	color: <?php echo $brandColor; ?>;
	border-color: <?php echo $brandColor; ?>;
	font-size: 19px;
}.pb-page-block-highlight .pb-page-button-theme:hover{
	background: <?php echo $brandColor; ?>;
	color: #ffffff;
}
