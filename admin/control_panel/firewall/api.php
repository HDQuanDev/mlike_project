<?php
function show_setting()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'show_settings', 'format' => ''),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function allow_ip($ip)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'allowlist_ip', 'ip' => '' . $ip . ''),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function allow_ip_del($ip)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'delete_allowlist_ip', 'ip' => '' . $ip . ''),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function block_ip($ip)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'blocklist_ip', 'ip' => '' . $ip . ''),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function block_ip_del($ip)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'delete_blocklist_ip', 'ip' => '' . $ip . ''),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function get_list()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wafx.sucuri.net/api?v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('k' => '819a52d20a00e4bd47a023f473a74937', 's' => '1476c177f61a92405e33dcab4780ef9e', 'a' => 'audit_trails', 'format' => 'json'),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

switch ($_GET['act']) {
    case 'show_setting':
        echo show_setting();
        break;
    case 'allow_ip':
        if (isset($_GET['ip'])) {
            echo allow_ip($_GET['ip']);
        }
        break;
    case 'allow_ip_del':
        if (isset($_GET['ip'])) {
            echo allow_ip_del($_GET['ip']);
        }
        break;
    case 'block_ip':
        if (isset($_GET['ip'])) {
            echo block_ip($_GET['ip']);
        }
        break;
    case 'block_ip_del':
        if (isset($_GET['ip'])) {
            echo block_ip_del($_GET['ip']);
        }
        break;
    case 'get_list':
        echo get_list();
        break;
}
