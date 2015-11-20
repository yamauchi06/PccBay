<?php
    header("Content-type: text/css; charset: UTF-8");
	include('colors/'.$_GET['t'].'.php');
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