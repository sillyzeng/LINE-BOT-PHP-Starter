<?php
$access_token = 'OFmkms7FmGibjB8bbarU8jExukfzbI4sj5Jg1yp9PtEQ8FxUF35ilJTnBrxkW1n/aYvfZjvztL7X4n2bIyjPn6tOXwRvr2oAOznLrbWBcRf9BNQXzEgApLf3AAyDx3gKiFXYIEYJRAv3P/kJRONnywdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
