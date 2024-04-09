<?php

$mail = $_GET["mail"];
$hi = file_get_contents('https://disify.com/api/email/' . $mail);
$str = json_decode($hi);
var_dump($str);
var_dump($hi);
var_dump($mail);
$curl = curl_init();

$data = [
    'email' => $mail,
];

$post_data = http_build_query($data);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.disify.com/api/email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $post_data,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
