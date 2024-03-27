<?php

function cloudflare($site)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"account": {"id": "171ab3ab6b813fe20b3000794daac67c"}, "name":"' . $site . '","jump_start":true}',
        CURLOPT_HTTPHEADER => array(
            'X-Auth-Key: 0ed54be0a07dc5d442b2dfc9ad9029e2c44fb',
            'X-Auth-Email: maiyeuem608@gmail.com',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function cloudflare_dns($zone, $domain)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/' . $zone . '/dns_records',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"type":"A","name":"' . $domain . '","content":"45.118.132.201","ttl":3600,"proxied":true}',
        CURLOPT_HTTPHEADER => array(
            'X-Auth-Key: 0ed54be0a07dc5d442b2dfc9ad9029e2c44fb',
            'X-Auth-Email: maiyeuem608@gmail.com',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function cloudflare_check($domain)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones?name=' . $domain . '&account.id=171ab3ab6b813fe20b3000794daac67c',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => 'name=' . $domain . '&account.id=171ab3ab6b813fe20b3000794daac67c',
        CURLOPT_HTTPHEADER => array(
            'X-Auth-Key: 0ed54be0a07dc5d442b2dfc9ad9029e2c44fb',
            'X-Auth-Email: maiyeuem608@gmail.com',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

class bt_api
{
    private $BT_KEY = "5OZ0Iqa2QKWjUdJyVsgh5EaIGDRcCYfw";
    private $BT_PANEL = "http://45.118.132.201:2003";
    public function __construct($bt_panel = null, $bt_key = null)
    {
        if ($bt_panel) {
            $this->BT_PANEL = $bt_panel;
        }
        if ($bt_key) {
            $this->BT_KEY = $bt_key;
        }
    }
    public function GetLogs()
    {
        $url = $this->BT_PANEL . '/site?action=AddSite';
        $p_data = $this->GetKeyData();
        $p_data['webname'] = '{"domain":"' . $this->domain . '","domainlist":[],"count":0}';
        $p_data['path'] = '/www/wwwroot/sitecon';
        $p_data['type_id'] = '0';
        $p_data['type'] = 'PHP';
        $p_data['version'] = '74';
        $p_data['port'] = '80';
        $p_data['ps'] = 'st';
        $p_data['ftp'] = 'false';
        $p_data['sql'] = 'false';

        $result = $this->HttpPostCookie($url, $p_data);

        $data = json_decode($result, true);
        return $data;
    }
    private function GetKeyData()
    {
        $now_time = time();
        $p_data = array(
            'request_token'    =>    md5($now_time . '' . md5($this->BT_KEY)),
            'request_time'    =>    $now_time
        );
        return $p_data;
    }

    private function HttpPostCookie($url, $data, $timeout = 60)
    {

        $cookie_file = './' . md5($this->BT_PANEL) . '.cookie';
        if (!file_exists($cookie_file)) {
            $fp = fopen($cookie_file, 'w+');
            fclose($fp);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

//echo cloudflare_check('qfan.club');
