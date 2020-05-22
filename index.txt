<?php
header('Content-Type: application/json');
function getSession($wallet){
    $url = "https://exchanging.cc/fdg-en/";
    $h = array(
    "upgrade-insecure-requests: 1",
    "user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36"
    );
        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
    curl_setopt($ch, CURLOPT_TIMEOUT,30);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $x = curl_exec($ch);
    curl_close($ch);

    preg_match("/name='prefix' value='(.*?)' ><br><br>/", $x, $prefix);
    preg_match("/fdg_ip\" type=\"hidden\" value=\"(.*?)\">/", $x, $iphash);

    return json_encode(array("prefix"=>$prefix[1], "ip"=>$iphash[1]));

}

$wallet = 'DB6ZjFVp3LigRw1zpnZamYFkxqjaK2AbUT';
print_r(getSession($wallet));
