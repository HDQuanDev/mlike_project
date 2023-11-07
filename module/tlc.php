<?php
function sv2_low($id, $sl, $t)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data =
        "object_id=$id&type=like&object_type=like&package_type=like_sale&quantity=$sl&speed=0&notes=mlike&provider=facebook";
    $headers = array(
        'Authorization: ' . $token . '',
        'Content-Type: application/x-www-form-urlencoded'
    );
    $url = 'https://agency.tanglikecheo.com/api/buy';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}
function sv2_7d($id, $sl, $t)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data =
        "object_id=$id&type=like&object_type=like&package_type=like_normal&quantity=$sl&speed=0&notes=mlike&provider=facebook";
    $headers = array(
        'Authorization: ' . $token . '',
        'Content-Type: application/x-www-form-urlencoded'
    );
    $url = 'https://tanglikecheo.com/api/buy';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}
function sv2($id, $sl, $t)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data =
        "object_id=$id&type=like&object_type=like&quantity=$sl&speed=0&notes=mlike&provider=facebook";
    $headers = array(
        'Authorization: ' . $token . '',
        'Content-Type: application/x-www-form-urlencoded'
    );
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=like&package_type=like&type=like&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}


function sv2_speed($id, $sl, $t)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "like",
        "object_type" => "like",
        "package_type" => "like_speed",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&package_type=like_speed&object_type=like&type=like&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function sv2_cx($id, $sl, $cx)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "like",
        "object_type" => "$cx",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=' . $cx . '&type=like&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function tlc_likecmt($id, $sl, $cx)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "like_comment",
        "object_type" => "$cx",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=' . $cx . '&type=like_comment&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function tlc_memgroup($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "join_group",
        "object_type" => "join_group",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=join_group&type=join_group&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function like_ins_tlc($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    //	$token = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2MDQ5NTQzODU5YmU2NjUzODg4NmRmNDYiLCJwYXNzd29yZCI6ImIyZjc3OTk1YTBjODFkODcxZDViNWFiMDE5NzAwM2UxIiwic3RhdHVzIjowLCJpYXQiOjE2MjcwNjE5OTMsImV4cCI6NTIyNzA1ODM5M30.nptD37NmgfYuaCbrQeC9RpGyYGMCBCC6FLVbw8np4ijaGgbkQbWnKVFF_q0Ux52M7rPFyY9vGW4Shp_6Fssr_w';
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "like",
        "object_type" => "like",
        "package_type" => "like_sale",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "instagram"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=like&type=like&package_type=like_sale&provider=instagram&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function follow_fb_tlc($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "follow",
        "object_type" => "follow_15",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=follow&type=follow_15&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function follow_ins_tlc($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "follow",
        "object_type" => "follow",
        "package_type" => "follow_sale",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "instagram"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=follow&package_type=follow_sale&type=follow&provider=instagram&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function follow_fb_tlc_2($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "follow",
        "object_type" => "follow_20",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://tanglikecheo.com/api/buy?object_id=' . $id . '&object_type=follow&type=follow_20&provider=facebook&speed=0&quantity=' . $sl . '&notes=mlike';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function cmt_ins_tlc($id, $sl, $nd)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "comment",
        "object_type" => "comment",
        "list_comment" => "$nd",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "instagram"
    ));
    $url = 'https://tanglikecheo.com/api/buy';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function cmt_fb_tlc($id, $sl, $nd)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data = json_encode(array(
        "object_id" => $id,
        "type" => "comment",
        "object_type" => "comment",
        "list_comment" => "$nd",
        "quantity" => $sl,
        "speed" => 0,
        "notes" => "mlike",
        "provider" => "facebook"
    ));
    $url = 'https://agency.tanglikecheo.com/api/buy';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token . '';
    $headers[] = 't:' . $time;
    // $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}
//echo sv2('437591004595302', '50');

function sv2_re($id, $sl)
{
    $token = file_get_contents('https://mlike.vn/admin/get_tlc_abc.php');
    $time = time();
    $data =
        "object_id=$id&type=like&object_type=like&package_type=like_sale&quantity=$sl&speed=0&notes=mlike&provider=facebook";
    $headers = array(
        'Authorization: ' . $token . '',
        'Content-Type: application/x-www-form-urlencoded'
    );
    $url = 'https://tanglikecheo.com/api/buy';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}