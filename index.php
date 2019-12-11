<?php 
require_once("vendor/autoload.php");

function posting($img,$caption){
	$arr = array("\r","	");
	$url = "https://postingscrape.000webhostapp.com/database.php";
    $h = explode("\n",str_replace($arr,"","
    User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
    $body = "img=$img&caption=$caption";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
    curl_close($ch);
    return $x;
}



$instagram = new \InstagramScraper\Instagram();
$medias = $instagram->getMedias('hijab.keceh', 6215);

foreach ( $medias as $media ) {
	//echo 'Caption: ' . $media['caption'] . '<br />';
	//echo 'Image: ' . $media['imageHighResolutionUrl']."\n\n\n";
	$foto = str_replace("&","🔜",$media['imageHighResolutionUrl']);
	$p = posting($foto,$media['caption']);
	echo $foto."\n" ;
	sleep(2);
}
