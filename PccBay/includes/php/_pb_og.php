<?php
	function pb_og_fgc($call,$query){
		return file_get_contents('http://'.domain().'/graph/'.$call.'?accessToken='.pb_og('token').'&'.$query);
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
			if($data===null){ $data=OG_APP; }
			$data=explode(':',$data);
			$return = pb_graph_token($data[0], $data[1]);
		}
		if($call=='access_token'){
			$data=explode(':',$data);
			$token = pb_time('token:'.$data[0], array('expire'=>$data[1], 'key'=>md5($data[1])));
			$return = array(
				'token'  => $token,
				'expire' => $data[1],
				'key'    => md5($data[1])
			);
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