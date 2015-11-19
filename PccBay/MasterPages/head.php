<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
<!-- Icon Base-->
<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#e67e22">
<!-- Latest compiled and minified -->
<link rel="stylesheet" href="/includes/css/bootstrap.min.css">
<link rel="stylesheet" href="/includes/css/bootstrap-tagsinput.css">
<link rel="stylesheet" href="/includes/fonts/font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/includes/fonts/Material-Design-Iconic-Font/css/material-design-iconic-font.css">
<link rel="stylesheet" href="/includes/plugins/flexslider/flexslider.css">
<link rel="stylesheet" href="/includes/css/overHead.css">
<link rel="stylesheet" href="/includes/css/bootstrap-slider.css">
<link rel="stylesheet" href="/includes/css/awesome-bootstrap-checkbox.css">

<link rel="stylesheet" href="/includes/plugins/nstSlider/jquery.nstSlider.min.css" type="text/css" />
<link href="/includes/css/bootstrap-switch.css" rel="stylesheet">
<link href="/includes/css/bootstrap-social.css" rel="stylesheet">
<link rel="stylesheet" href="/includes/plugins/dropzone/dropzone.css" type="text/css" />

<link rel="stylesheet" href="/includes/plugins/bootstrap-wysiwyg/bootstrap-wysihtml5.css" type="text/css" />

<link rel="stylesheet" href="/includes/css/css3-buttons.css" type="text/css" />


<!-- Main Styles and jQuery -->
<link rel="stylesheet" href="/includes/css/PccBay.css" type="text/css" >
<script src="/includes/js/jquery.js"></script>
<?php
pb_include('/includes/php/ext_forms.php');
$pb_user['theme'] = 'darkblue';
if(isset($_SESSION['user_id'])){
	$user_data = json_decode(pb_user_data($_SESSION['user_id'], 'user_data'), true);
	if($user_data){
		foreach($user_data as $data){
			if(!empty($pb_user['theme']))$pb_user['theme']=$data['theme'];
		}  
	}
}
print '<link id="userThemeCSS" rel="stylesheet" href="/includes/css/themes/?t='.$pb_user['theme'].'" type="text/css" >';
?>