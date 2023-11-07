<?php
$hdq = 'ok';
require_once('../_System/db.php');
if(time() > 0){
include("simple_html_dom.php"); // tài liệu Simple HTML DOM Parser link tải : https://sourceforge.net/projects/simplehtmldom/files/
$ckfile = 'quancookie.txt'; // nhớ tạo thêm file đó
	$user = $s['user'];
	$pass = $s['pass'];
$url = 'https://traodoisub.com/scr/login.php';
$poststring = "username=$user&password=$pass";
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $poststring);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "content-type: application/x-www-form-urlencoded",
		"origin: https://traodoisub.com",
		"user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
		"x-requested-with: XMLHttpRequest",
		"Cookie: all required cookies will appear here",
		"Connection: keep-alive"
	));
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
$output = curl_exec($ch);
curl_close($ch);
if($output == '1'){
    $err['message'] = 'sai tk mk tds';
    echo json_encode($err);
}else{
$url2 = 'https://traodoisub.com/mua/reactioncmt/';
// Khởi tạo CURL
$ch2 = curl_init($url2);
// Thiết lập có return
curl_setopt ($ch2, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch2, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
$result = str_get_html(curl_exec($ch2));
curl_close($ch2);
$lol = $result->find('tbody', 0);
$ketqua = array();
//echo $result;

$i = 0;
foreach($lol->find('tr') as $article) {
  if($i>=50){
    break;
  }
  $i++;
    $Idlike = $article->find('a', 0)->innertext;
    $status = $article->find('span', 0)->innertext;
    $total = $article->find('td', 1)->innertext;
    $datang = $article->find('td', 4)->innertext;
   $check = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$Idlike' AND `sttdone` = '0' AND `dv` = 'fb_likecmt' AND `nse` = 'Server Like 1' ORDER BY id DESC LIMIT 30");
	$check = mysqli_num_rows($check);
if($check != 0){
$u = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile`='$Idlike' AND `dv` = 'fb_likecmt' AND `nse` = 'Server Like 1' AND `sttdone` = '0' LIMIT 1");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$datang' WHERE `profile` = '$Idlike' AND `dv` = 'fb_likecmt' AND `nse` = 'Server Like 1' AND `sttdone` = '0'");
    echo 'ID: <a href="//facebook.com/'.$Idlike.'">'.$Idlike.'</a> -> DONE: '.$datang.' / '.$goc.'<br>';
    if($datang >= '1' && $datang < $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$Idlike' AND `dv` = 'fb_likecmt' AND `nse` = 'Server Like 1' AND `sttdone` = '0'");
    }elseif($datang >= $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$Idlike' AND `dv` = 'fb_likecmt' AND `nse` = 'Server Like 1'");
    }
}



}
}
}else{
    $err['message'] = 'thieu param user va pass';
    echo json_encode($err);
}


$token = $s['tlc'];
$time = time();
$result1 = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `dv` = 'fb_likecmt' AND `nse` = 'Server Like 2' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1))
    {
      $id = $ro['profile']; //id bai viet
$url = 'https://tanglikecheo.com/api/history?litmit=10&object_id='.$id.'&provider=facebook&type=like_comment';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_GET, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $headers = array();
  $headers[] = 'Content-Type: application/json';
  $headers[] = 'Authorization: ' . $token;
  $headers[] = 't:' . $time;	
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
$server_output = curl_exec ($ch); 
curl_close ($ch);
$result = $server_output;
$quan = json_decode($result);
if($quan->success = false){
  echo 'lỗi rồi';
}else{
  $done = $quan->data[0]->worker;
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id'");
  echo 'id: '.$id.' -> '.$done.'<br>';
  $goc = $ro['sl'];
  if($done >= 1 && $done < $goc){
      mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id'");
  }elseif($done >= $goc){
      mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id'");
  }
}

    }