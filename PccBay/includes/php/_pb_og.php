<?php
	function pb_og_fgc($call,$query){
		return file_get_contents('http://'.domain().'/graph/'.$call.'?accessToken='.pb_og('token', OG_APPID.':'.OG_APPSECRET).'&'.$query);
	}
	function pb_og($call=null, $data=null){
		$openGraphPages=array(
		'feed',
		'products',
		'questions',
		'discussions',
		'comments',
		'tags',
		'users',
		'images',
		'notify',
		'smartsearch'
		);
		$return=null;
		if($call=='token'){
			$data=explode(':',$data);
			$return = pb_graph_token($data[0], $data[1]);
		}
		if($call=='site'){
			$return=domain($data);
		}
		if(in_array($call, $openGraphPages)){
			$return=pb_og_fgc($call,'q='.$data); 
		}
		return $return;
	}
?>