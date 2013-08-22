<?php
#phpinfo();
print_r("Power Couple");
	$params = array(
		'api_key'	=> '712ee7fdf58e5a6a1fcba0619cdb9b42',
		'method'	=> 'flickr.photos.getInfo',
		'photo_id'	=> '8528639443',
		'format'	=> 'php_serial',
	);

	$encoded_params = array();

	foreach ($params as $k => $v){
		$encoded_params[] = urlencode($k).'='.urlencode($v);
	}

	#
# call the API and decode the response
#
	$url = "http://68.142.214.24/services/rest/?".implode('&', $encoded_params);

	# $rsp = 	file_get_contents("http://api.flickr.com/services/rest/?api_key=712ee7fdf58e5a6a1fcba0619cdb9b42&method=flickr.photos.getInfo&photo_id=8528639443&format=php_serial");

	#$rsp = file_get_contents($url);

	/*if( ini_get('allow_url_fopen') ) {
		echo "fopen allowed";
	}
	else{
		echo "fopen not allowed";
	}*/


	#echo("curl exists");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);
	#echo $output;


	#var_dump (file_get_contents($url));
	$rsp_obj = unserialize($output);
	var_dump($rsp_obj);

#
# display the photo title (or an error if it failed)
#
	if ($rsp_obj['stat'] == 'ok'){

		$photo_title = $rsp_obj['photo']['title']['_content'];
		dumper($rsp_obj['photo'],"dini");

		echo "Title is $photo_title!";
	}else{

		echo "Call failed!";
	}
?>
