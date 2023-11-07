<?php
$hdq = 'ok';
require_once('../_System/db.php');
if(time() > 0){
require_once("simple_html_dom.php"); // tài liệu Simple HTML DOM Parser link tải : https://sourceforge.net/projects/simplehtmldom/files/
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
$url2 = 'https://traodoisub.com/mua/comment/';
// Khởi tạo CURL
$ch2 = curl_init($url2);
// Thiết lập có return
curl_setopt ($ch2, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch2, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch2);
curl_close($ch2);
$rs = str_get_html($result);
$lol =  $rs->find('tbody',0);
$ketqua = array();
$i = 0;
foreach($lol->find('tr') as $article) {
  if($i=='15'){
    break;
  }
  $i++;
    $Idlike = $article->find('a', 0)->innertext;
    $status = $article->find('span', 0)->innertext;
    $datang = $article->find('td', 3)->innertext;
    
   $check = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile` = '$Idlike' AND `sttdone` = '0' AND `nse` = '5' AND `dv` = 'Cmt' ORDER BY id DESC LIMIT 10");
	$check = mysqli_num_rows($check);
if($check != 0){
$u = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile`='$Idlike' AND `nse` = '5' AND `sttdone` = '0' AND `dv` = 'Cmt' LIMIT 1");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$datang' WHERE `profile` = '$Idlike' AND `nse` = '5' AND `sttdone` = '0' AND `dv` = 'Cmt'");
    echo 'ID: <a href="//facebook.com/'.$Idlike.'">'.$Idlike.'</a> -> DONE: '.$datang.' / '.$goc.'<br>';
    if($datang > '1' && $datang < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$Idlike' AND `nse` = '5' AND `sttdone` = '0' AND `dv` = 'Cmt'");
    }elseif($datang > $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$Idlike' AND `nse` = '5' AND `dv` = 'Cmt'");
    }
}



}
}
}else{
    $err['message'] = 'thieu param user va pass';
    echo json_encode($err);
}