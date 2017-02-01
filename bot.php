<?php
$access_token = 'OFmkms7FmGibjB8bbarU8jExukfzbI4sj5Jg1yp9PtEQ8FxUF35ilJTnBrxkW1n/aYvfZjvztL7X4n2bIyjPn6tOXwRvr2oAOznLrbWBcRf9BNQXzEgApLf3AAyDx3gKiFXYIEYJRAv3P/kJRONnywdB04t89/1O/w1cDnyilFU=';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('<channel access token>');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '<channel secret>']);
$response = $bot->getProfile('<userId>');
$textreturn = "";
if ($response->isSucceeded()) {
    $profile = $response->getJSONDecodedBody();
    $textreturn .= $profile['displayName'];
    $textreturn .= $profile['pictureUrl'];
    $textreturn .= $profile['statusMessage'];
}
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if($text=="kam"){
				$messages = [
					'type' => 'text',
					'text' => $textreturn
				];
			}else{
				$messages = [
					'type' => 'text',
					'text' => $textreturn
				];
			}
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
