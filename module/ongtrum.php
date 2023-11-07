<?php
function ongtrum($uid, $link, $kenh, $dv, $sl, $start)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ongtrum.pro/api/v2/server.aspx',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('api_token' => 'YPwzpjYS6AAkTzjzz9ZAEjVYbN11JpjA8l9cM2wQFvZuGg8c3jNs1hLDVXri3B7mpCXCVnNPzT5COPhQ', 'url' => '' . $link . '', 'type_method' => 'add', 'channel' => '' . $kenh . '', 'start' => ''.$start.'', 'type_api' => '' . $dv . '', 'max' => '' . $sl . '', 'uid' => '' . $uid . ''),
        CURLOPT_HTTPHEADER => array(
            'Cookie: root_session=yaDShatGcEQpfX9PdfiJ8XOvOaMU9w7YG03QQ4V0'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function ongtrum_b($uid, $link, $kenh, $dv, $sl, $start)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ongtrum.pro/api/v2/server.aspx',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('api_token' => 'YPwzpjYS6AAkTzjzz9ZAEjVYbN11JpjA8l9cM2wQFvZuGg8c3jNs1hLDVXri3B7mpCXCVnNPzT5COPhQ', 'url' => '' . $link . '', 'type_method' => 'add', 'channel' => '' . $kenh . '', 'start' => ''.$start.'', 'type_api' => '' . $dv . '', 'max' => '' . $sl . '', 'uid' => '' . $uid . '', 'speed' => '1', 'start' => '0'),
        CURLOPT_HTTPHEADER => array(
            'Cookie: root_session=yaDShatGcEQpfX9PdfiJ8XOvOaMU9w7YG03QQ4V0'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
