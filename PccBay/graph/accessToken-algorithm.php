<?php
$lifeSpans    = array('seconds'=>'s','minutes'=>'i','hours'=>'g','days'=>'j','months'=>'F','years'=>'Y');
$timespan     = $lifeSpans['days'];
$accessToken .= $app_id.date($timespan).$val['user'].$val['user_data'];
$accessToken .= date($timespan).$app_id.$val['user_data'];
$accessToken  = str_rot13($accessToken);
$accessToken  = strtolower($accessToken);
$accessToken  = str_replace(' ', '0', $accessToken);
$accessToken  = str_replace('a', '0', $accessToken);
$accessToken  = str_replace('b', '1', $accessToken);
$accessToken  = str_replace('c', '2', $accessToken);
$accessToken  = str_replace('d', '3', $accessToken);
$accessToken  = str_replace('e', '4', $accessToken);
$accessToken  = str_replace('f', '5', $accessToken);
$accessToken  = str_replace('g', '6', $accessToken);
$accessToken  = str_replace('h', '7', $accessToken);
$accessToken  = str_replace('i', '8', $accessToken);
$accessToken  = str_replace('j', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('k', '0', $accessToken);
$accessToken  = str_replace('l', '1', $accessToken);
$accessToken  = str_replace('m', '2', $accessToken);
$accessToken  = str_replace('n', '3', $accessToken);
$accessToken  = str_replace('o', '4', $accessToken);
$accessToken  = str_replace('p', '5', $accessToken);
$accessToken  = str_replace('q', '6', $accessToken);
$accessToken  = str_replace('r', '7', $accessToken);
$accessToken  = str_replace('s', '8', $accessToken);
$accessToken  = str_replace('t', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('u', '!', $accessToken);
$accessToken  = str_replace('v', '#', $accessToken);
$accessToken  = str_replace('w', '$', $accessToken);
$accessToken  = str_replace('x', '^', $accessToken);
$accessToken  = str_replace('y', '*', $accessToken);
$accessToken  = str_replace('z', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('0', '$', $accessToken);
$accessToken  = str_replace('1', '&', $accessToken);
$accessToken  = str_replace('2', '@', $accessToken);
$accessToken  = str_replace('3', '^', $accessToken);
$accessToken  = str_replace('4', '!', $accessToken);
$accessToken  = str_replace('5', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('n', 't', $accessToken);
$accessToken  = str_replace('r', 'q', $accessToken);
$accessToken  = str_replace('f', 'q', $accessToken);
$accessToken  = str_replace('s', 'e', $accessToken);
$accessToken  = str_replace('f', 'x', $accessToken);
$accessToken  = str_replace('3', '7', $accessToken);
$accessToken  = str_replace('7', 'l', $accessToken);
$accessToken  = str_replace('a', ';', $accessToken);
$accessToken  = str_replace('f', ']', $accessToken);
$accessToken  = str_replace('8', '/', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('1', '7', $accessToken);
$accessToken  = str_replace('x', '=', $accessToken);
$accessToken  = str_replace('p', '~', $accessToken);
$accessToken  = str_replace('k', '^', $accessToken);
$accessToken  = str_replace('a', '*', $accessToken);
$accessToken  = str_replace('q', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('3', '$', $accessToken);
$accessToken  = str_replace('8', '&', $accessToken);
$accessToken  = str_replace('c', '@', $accessToken);
$accessToken  = str_replace('b', '^', $accessToken);
$accessToken  = str_replace('v', '!', $accessToken);
$accessToken  = str_replace('y', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = strtolower($accessToken);
$accessToken  = str_replace(' ', '0', $accessToken);
$accessToken  = str_replace('a', '0', $accessToken);
$accessToken  = str_replace('b', '1', $accessToken);
$accessToken  = str_replace('c', '2', $accessToken);
$accessToken  = str_replace('d', '3', $accessToken);
$accessToken  = str_replace('e', '4', $accessToken);
$accessToken  = str_replace('f', '5', $accessToken);
$accessToken  = str_replace('g', '6', $accessToken);
$accessToken  = str_replace('h', '7', $accessToken);
$accessToken  = str_replace('i', '8', $accessToken);
$accessToken  = str_replace('j', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('k', '0', $accessToken);
$accessToken  = str_replace('l', '1', $accessToken);
$accessToken  = str_replace('m', '2', $accessToken);
$accessToken  = str_replace('n', '3', $accessToken);
$accessToken  = str_replace('o', '4', $accessToken);
$accessToken  = str_replace('p', '5', $accessToken);
$accessToken  = str_replace('q', '6', $accessToken);
$accessToken  = str_replace('r', '7', $accessToken);
$accessToken  = str_replace('s', '8', $accessToken);
$accessToken  = str_replace('t', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('u', '!', $accessToken);
$accessToken  = str_replace('v', '#', $accessToken);
$accessToken  = str_replace('w', '$', $accessToken);
$accessToken  = str_replace('x', '^', $accessToken);
$accessToken  = str_replace('y', '*', $accessToken);
$accessToken  = str_replace('z', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('0', '$', $accessToken);
$accessToken  = str_replace('1', '&', $accessToken);
$accessToken  = str_replace('2', '@', $accessToken);
$accessToken  = str_replace('3', '^', $accessToken);
$accessToken  = str_replace('4', '!', $accessToken);
$accessToken  = str_replace('5', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('n', 't', $accessToken);
$accessToken  = str_replace('r', 'q', $accessToken);
$accessToken  = str_replace('f', 'q', $accessToken);
$accessToken  = str_replace('s', 'e', $accessToken);
$accessToken  = str_replace('f', 'x', $accessToken);
$accessToken  = str_replace('3', '7', $accessToken);
$accessToken  = str_replace('7', 'l', $accessToken);
$accessToken  = str_replace('a', ';', $accessToken);
$accessToken  = str_replace('f', ']', $accessToken);
$accessToken  = str_replace('8', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('1', '7', $accessToken);
$accessToken  = str_replace('x', '=', $accessToken);
$accessToken  = str_replace('p', '~', $accessToken);
$accessToken  = str_replace('k', '^', $accessToken);
$accessToken  = str_replace('a', '*', $accessToken);
$accessToken  = str_replace('q', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('3', '$', $accessToken);
$accessToken  = str_replace('8', '&', $accessToken);
$accessToken  = str_replace('c', '@', $accessToken);
$accessToken  = str_replace('b', '^', $accessToken);
$accessToken  = str_replace('v', '!', $accessToken);
$accessToken  = str_replace('y', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = strtolower($accessToken);
$accessToken  = str_replace(' ', '0', $accessToken);
$accessToken  = str_replace('a', '0', $accessToken);
$accessToken  = str_replace('b', '1', $accessToken);
$accessToken  = str_replace('c', '2', $accessToken);
$accessToken  = str_replace('d', '3', $accessToken);
$accessToken  = str_replace('e', 't', $accessToken);
$accessToken  = str_replace('f', '5', $accessToken);
$accessToken  = str_replace('g', '6', $accessToken);
$accessToken  = str_replace('h', '7', $accessToken);
$accessToken  = str_replace('i', '8', $accessToken);
$accessToken  = str_replace('j', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('k', '0', $accessToken);
$accessToken  = str_replace('l', '1', $accessToken);
$accessToken  = str_replace('b', '2', $accessToken);
$accessToken  = str_replace('n', '3', $accessToken);
$accessToken  = str_replace('o', '4', $accessToken);
$accessToken  = str_replace('p', '5', $accessToken);
$accessToken  = str_replace('q', '6', $accessToken);
$accessToken  = str_replace('r', '7', $accessToken);
$accessToken  = str_replace('s', '8', $accessToken);
$accessToken  = str_replace('t', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('u', '!', $accessToken);
$accessToken  = str_replace('v', '#', $accessToken);
$accessToken  = str_replace('v', '$', $accessToken);
$accessToken  = str_replace('x', '^', $accessToken);
$accessToken  = str_replace('y', '*', $accessToken);
$accessToken  = str_replace('z', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('0', '$', $accessToken);
$accessToken  = str_replace('1', '&', $accessToken);
$accessToken  = str_replace('x', '@', $accessToken);
$accessToken  = str_replace('3', '^', $accessToken);
$accessToken  = str_replace('4', '!', $accessToken);
$accessToken  = str_replace('5', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('n', 'v', $accessToken);
$accessToken  = str_replace('r', 'q', $accessToken);
$accessToken  = str_replace('f', 'q', $accessToken);
$accessToken  = str_replace('s', 'e', $accessToken);
$accessToken  = str_replace('f', 'x', $accessToken);
$accessToken  = str_replace('3', '7', $accessToken);
$accessToken  = str_replace('7', 'l', $accessToken);
$accessToken  = str_replace('a', ';', $accessToken);
$accessToken  = str_replace('f', ']', $accessToken);
$accessToken  = str_replace('8', '/', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('1', '7', $accessToken);
$accessToken  = str_replace('x', '=', $accessToken);
$accessToken  = str_replace('p', 'c', $accessToken);
$accessToken  = str_replace('k', '^', $accessToken);
$accessToken  = str_replace('a', '*', $accessToken);
$accessToken  = str_replace('q', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('3', '$', $accessToken);
$accessToken  = str_replace('8', '&', $accessToken);
$accessToken  = str_replace('c', '@', $accessToken);
$accessToken  = str_replace('b', 'r', $accessToken);
$accessToken  = str_replace('v', '!', $accessToken);
$accessToken  = str_replace('y', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = strtolower($accessToken);
$accessToken  = str_replace(' ', '0', $accessToken);
$accessToken  = str_replace('a', '0', $accessToken);
$accessToken  = str_replace('b', '1', $accessToken);
$accessToken  = str_replace('c', 'z', $accessToken);
$accessToken  = str_replace('d', '3', $accessToken);
$accessToken  = str_replace('e', '4', $accessToken);
$accessToken  = str_replace('f', '5', $accessToken);
$accessToken  = str_replace('g', '6', $accessToken);
$accessToken  = str_replace('h', 'b', $accessToken);
$accessToken  = str_replace('i', '8', $accessToken);
$accessToken  = str_replace('j', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('k', '0', $accessToken);
$accessToken  = str_replace('l', '1', $accessToken);
$accessToken  = str_replace('m', '2', $accessToken);
$accessToken  = str_replace('n', 'n', $accessToken);
$accessToken  = str_replace('o', '4', $accessToken);
$accessToken  = str_replace('p', '5', $accessToken);
$accessToken  = str_replace('q', '6', $accessToken);
$accessToken  = str_replace('r', '7', $accessToken);
$accessToken  = str_replace('s', 'v', $accessToken);
$accessToken  = str_replace('t', '9', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('u', '!', $accessToken);
$accessToken  = str_replace('v', '#', $accessToken);
$accessToken  = str_replace('w', 's', $accessToken);
$accessToken  = str_replace('x', '^', $accessToken);
$accessToken  = str_replace('y', '*', $accessToken);
$accessToken  = str_replace('z', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('0', '$', $accessToken);
$accessToken  = str_replace('1', '&', $accessToken);
$accessToken  = str_replace('2', '@', $accessToken);
$accessToken  = str_replace('3', '^', $accessToken);
$accessToken  = str_replace('4', '!', $accessToken);
$accessToken  = str_replace('5', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('n', 't', $accessToken);
$accessToken  = str_replace('r', 'q', $accessToken);
$accessToken  = str_replace('f', 'q', $accessToken);
$accessToken  = str_replace('s', 'e', $accessToken);
$accessToken  = str_replace('f', 'x', $accessToken);
$accessToken  = str_replace('3', '3', $accessToken);
$accessToken  = str_replace('7', 'l', $accessToken);
$accessToken  = str_replace('a', ';', $accessToken);
$accessToken  = str_replace('f', ']', $accessToken);
$accessToken  = str_replace('8', '/', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = str_replace('1', '7', $accessToken);
$accessToken  = str_replace('x', '=', $accessToken);
$accessToken  = str_replace('p', '~', $accessToken);
$accessToken  = str_replace('k', 'x', $accessToken);
$accessToken  = str_replace('a', '*', $accessToken);
$accessToken  = str_replace('q', '{', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_rot13($accessToken);
$accessToken  = md5($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('3', '$', $accessToken);
$accessToken  = str_replace('8', 't', $accessToken);
$accessToken  = str_replace('c', '@', $accessToken);
$accessToken  = str_replace('b', '^', $accessToken);
$accessToken  = str_replace('v', '!', $accessToken);
$accessToken  = str_replace('y', '?', $accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = sha1($accessToken);
$accessToken  = str_replace('a', '-', $accessToken);
$accessToken  = str_replace('8', ')', $accessToken);
$accessToken  = str_replace('h', '_', $accessToken);
//Final Output Do not chnage anything below this line.
$key          = mb_substr(sha1(md5($accessToken)), 5, 15);
$first400     = substr($key, 0, 10);
$theRest      = substr($key, 10);
$accessToken  = md5($accessToken).':'.$first400.'-'.$theRest;	
?>