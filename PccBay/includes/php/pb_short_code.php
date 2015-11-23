<?php

function short($code, $return=false){
	function attr($attr, $place){ if(!empty($attr[$place])){ return $attr[$place]; } }

	preg_match_all("/\((?:[^()]|(?R))+\)|'[^']*'|[^(),\s]+/", $code, $matches);
	$attr=$matches[0];
	$attr[1] = str_replace('(','',$attr[1]);$attr[1] = str_replace(')','',$attr[1]);

	$shorts=array(
		'image'   => '<img src="'.attr($attr, 1).'" width="'.attr($attr, 2).'" height="'.attr($attr, 3).'" />',
		'bold'    => '<b>'.attr($attr, 1).'</b>',
		'div'     => '<div>'.attr($attr, 1).'</div>',
		'italic'  => '<i>'.attr($attr, 1).'</i>',
		'paragraph'  => '<p>'.attr($attr, 1).'</p>',
	);
	if($return==false){return $shorts[ $attr[0] ];}
	if($return==true) {print $shorts[ $attr[0] ]; }
}	
	
?>