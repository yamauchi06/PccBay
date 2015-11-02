<?php
$accessToken .= $app_id.date("F j, Y, g:a F").$val['user'].$val['user_data'];
$accessToken .= date("F j, Y, g:a F j, Y, F").$app_id.$val['user_data'];
$accessToken = md5(md5($accessToken));
$accessToken .= sha1($accessToken);
$accessToken .= md5($accessToken);
$accessToken = str_replace('a', '-', $accessToken);
$accessToken = str_replace('8', ')', $accessToken);
$accessToken = str_replace('h', '_', $accessToken);



//Final Output
$accessToken = md5($accessToken).':'.sha1(md5($accessToken));	
?>