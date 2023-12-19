<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.disify.com/api/email/" . $_GET['mail'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
