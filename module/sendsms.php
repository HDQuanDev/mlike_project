<?php

function send_twilio_text_sms($id, $token, $from, $to, $body)
{

$url = "https://api.twilio.com/2010-04-01/Accounts/".$id."/SMS/Messages.json";
$data = array (
    'From' => $from,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($data);
$x = curl_init($url );
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);
$y = curl_exec($x);
curl_close($x);
return '';
}
// Check tiền twilio
function get_usd(){
     global $id, $token;
$url = 'https://api.twilio.com/2010-04-01/Accounts/'.$id.'/Balance.json';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$id:$token");
$result = curl_exec($ch);
curl_close($ch);  
$get = json_decode($result);
return $get->balance;
}
?>