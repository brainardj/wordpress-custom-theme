<?php

function load_site(){
	$searchdir = !file_exists(get_stylesheet_directory().'/site.json') ? get_template_directory() : get_stylesheet_directory();
	
	
	$file = $searchdir.'/site.json';
	
	if(!file_exists($file)) {
		throw new Exception("Error reading site.json file from: ".$searchdir);
	}
	
	$handle = fopen($file,'r');
	if($handle !== false) {
		$data = fread($handle,filesize($file));
	} else {
		throw new Exception("Error reading site.json file from: ".$searchdir);
	}

	return json_decode($data,true);
}

// print load_site();exit;
function getSiteValue($arr, $keys) {

	$keyc = array_shift($keys);
	
	if(!empty($arr[$keyc])) {
		if(!is_array($arr[$keyc]) || count($keys) == 0) return $arr[$keyc];
		else return getSiteValue($arr[$keyc],$keys);
	}
	
	else return null;
}


function confget($key) {
	static $json;
	$keys = explode(".",$key);
	
	
	
	if(empty($json)) {
		$json = load_site();
	}
	
	if(null == $json){
		throw new Exception("Error parsing site.json.");
	}
	
	return null == $json ? '' : getSiteValue($json, $keys);
}