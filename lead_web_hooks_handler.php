<?php

$posback_request = array();
$posback_request['postback_key'] = '8ADeD3A1998cA3841F5f2899DcC12eF3';
$posback_request['campaign_code'] = 'b519ef0db6';
$posback_request['action_code'] = '3';
$posback_request['tariff_code'] = '1';
$posback_request['pb'] = '1';

$posback_request['order_id'] = $_POST['tranid'];

$tilda_cookies = $_POST["COOKIES"];

$cookies = explode("; ", $tilda_cookies);

foreach ($cookies as &$value) {
if (strpos($value, 'deduplication_cookie') !== false) // получаем последний платный источник трафика
    {
        $deduplication_cookie = explode("=", $value);
        $deduplication_cookie_value = $deduplication_cookie[1];
    }

if (strpos($value, 'tagtag_aid') !== false) // получаем admitad UID
    {
        $admitad_uid_cookie = explode("=", $value);
        $posback_request['uid'] = $admitad_uid_cookie[1];
    }
if (strpos($value, 'TILDAUTM') !== false) // последние метки tilda
    {
        $tildaUTM_cookie = explode("=", $value);
        $posback_request['tilda_utms'] = json_encode($tildaUTM_cookie);
    }
}

$parts = array();
foreach ($posback_request as $key => $value) {
	$parts[] = $key . '=' . urlencode($value);
}

$url = 'https://ad.admitad.com/r?' . implode('&', $parts);

if ($deduplication_cookie_value == 'admitad' || $deduplication_cookie_value == 'adm'){
	file_get_contents($url);
} 
?>
