<?php 

function login_vnfb($user, $pass){
	$curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://vietnamfb.com/?mc=pub&site=postLogin",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "username=$user&password=$pass",
	  CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
	  CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
	  CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"origin: https://vietnamfb.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  return "cURL Error #:" . $err;
	} else {
	  return $response;
	}
}

function send_follow_vnfb($idpost, $limit, $sv){
    if($sv == 1){
        $n = 6;
    }elseif($sv == 2){
        $n = 1;
    }
    $curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://vietnamfb.com/?mc=covid_sub&site=add_new",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 60,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "id=$idpost&amount=$limit&channel_number=$n&buff_speed=false&buff_speed_second=5&reaction=LIKE&force_buff=0",
	 CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
	  CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
	  CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"origin: https://vietnamfb.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function send_likett_vnfb($idpost, $limit){
   $quan = login_vnfb('ctvsang', 'sangdeptrai');
   if (isset($quan)) {
    $curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://vietnamfb.com/?mc=tiktok_like&site=add_new",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 60,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "link=$idpost&amount=$limit&channel=2",
	 CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
	  CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
	  CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"origin: https://vietnamfb.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
}

function check_likett_vnfb($id){

    $curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://vietnamfb.com/api?mc=tiktok_like&site=get_info_order&username=ctvsang&api_key=9e03ffd099486b730decb467acc9d3bcd29aaee83794decf389512c23b3ba06b5e6092ed36639d7e922557021b4197391ae9cd6e231d3a94588011c7749be1f3",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 60,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "ids=$id",
	 CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
	  CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
	  CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"origin: https://vietnamfb.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}


function check_follow_vnfb($id){

    $curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://vietnamfb.com/api?mc=covid_sub&site=get_info_order&username=ctvsang&api_key=9e03ffd099486b730decb467acc9d3bcd29aaee83794decf389512c23b3ba06b5e6092ed36639d7e922557021b4197391ae9cd6e231d3a94588011c7749be1f3",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 60,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "ids=$id",
	 CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
	  CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
	  CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"origin: https://vietnamfb.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest"
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}