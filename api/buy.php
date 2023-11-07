<?php
$page = 'like_fb';
require_once('../_System/db.php');
if(isset($login)){
include('../module/tds.php');
include('../module/tlc.php');
include('../module/autocc.php');
switch ($_GET['act']) {
  case 'like':
if (isset($_POST['add'])) {
$id = mysqli_real_escape_string($db, $_POST['id']);
$sl = mysqli_real_escape_string($db, $_POST['sl']);
$sv = mysqli_real_escape_string($db, $_POST['sv']);
if($sv == '1'){
$tongtien = $sl*$gia1;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min1']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min1']." Like','warning');</script>";
}elseif($sl > $s['max1']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max1']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(1) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
	$user = $s['user'];
	$pass = $s['pass'];
	$login_tds = json_decode(login($user, urlencode($pass)));
	if($login_tds->success == 'true'){
		$date_create =  date("Y-m-d H:i:s");
		$send_api = send_tds(trim($id), trim($sl), '', $date_create);
		usleep(1000);
		if(strpos($send_api, 'nh công') !== false){
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
			$sve = 'Server Like 1';
			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '1', `bh`='1', `sttdone` = '0'");
			$stien = 5*$sl;
					$ctime = date("d/m");
			$stien = $tongtien-$stien;
			$static = mysqli_query($db,"SELECT * FROM `static` WHERE `time`='$ctime'");
$static = mysqli_num_rows($static);
if($static == '0'){
    mysqli_query($db,"INSERT INTO `static` SET `sv1l` = '$sl', `sv2l` = '0', `sv1` = '$stien', `sv2` = '0', `time`='$ctime', `sv5l` = '0',`sv5` = '0'");
}elseif($static == '1'){
    mysqli_query($db,"UPDATE `static` SET `sv1l` = `sv1l`+'$sl', `sv1` = `sv1` + '$stien' WHERE `time`='$ctime'");
}
			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
			
			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";
		}else{
			echo "<script>swal('OOPS!','Lỗi ID Tăng Like, Vui Lòng Kiểm Tra Lại, Nếu Vẫn Không Được Vui Lòng Liên Hệ Admin!','warning');</script>";
		}
	}else{
		echo "<script>swal('OOPS!','Lỗi server like, vui lòng liên hệ Admin!','warning');</script>";
	}

}

}elseif($sv == '2'){
$tongtien = $sl*$gia2;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min2']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min2']." Like','warning');</script>";
}elseif($sl > $s['max2']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max2']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(2) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
	$send_tlc = json_decode(sv2($id, $sl));
	if($send_tlc->success == 'true'){
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
			$sve = 'Server Like 2';
			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
						$ctime = date("d/m");
$stien = 10*$sl;
			$stien = $tongtien-$stien;
			$static = mysqli_query($db,"SELECT * FROM `static` WHERE `time`='$ctime'");
$static = mysqli_num_rows($static);
if($static == '0'){
    mysqli_query($db,"INSERT INTO `static` SET `sv2l` = '$sl', `sv1l` = '0', `sv2` = '$stien', `sv1` = '0', `time`='$ctime', `sv5l` = '0', `sv5` = '0'");
}elseif($static == '1'){
    mysqli_query($db,"UPDATE `static` SET `sv2l` = `sv2l`+'$sl', `sv2` = `sv2` + '$stien' WHERE `time`='$ctime'");
}
			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";
	}else{
		echo "<script>swal('OOPS!','Đã xảy ra lỗi, vui lòng liên hệ Admin hoặc mua Like Server khác, Cảm ơn! ','warning');</script>";

	}

}
}elseif($sv == '3'){
$tongtien = $sl*$gia3;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min3']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min3']." Like','warning');</script>";
}elseif($sl > $s['max3']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max3']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(3) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
	$user = $s['user'];
	$pass = $s['pass'];
	$login_tds = json_decode(login($user, urlencode($pass)));
	if($login_tds->success == 'true'){
		$date_create =  date("Y-m-d H:i:s");
		$send_api = send_tds(trim($id), trim($sl), '', $date_create);
		usleep(1000);
		if(strpos($send_api, 'nh công') !== false){
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
		$sve = 'Server Like 3';

			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '3', `bh`='2', `sttdone` = '0'");

			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");

			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";
		}else{

			echo "<script>swal('OOPS!','Lỗi ID Tăng Like, Vui Lòng Kiểm Tra Lại, Nếu Vẫn Không Được Vui Lòng Liên Hệ Admin!','warning');</script>";
		}

	}else{

		echo "<script>swal('OOPS!','Lỗi server like, vui lòng liên hệ Admin!','warning');</script>";

	}

}

  
}elseif($sv == '4'){
$tongtien = $sl*$gia4;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min4']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min4']." Like','warning');</script>";
}elseif($sl > $s['max4']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max4']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(4) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
			$sve = 'Server Like Tay';
			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '4', `bh`='1', `sttdone` = '0'");

			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
			$maila = $s['mail'];
			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";

}

}elseif($sv == '5'){
$tongtien = $sl*$gia5;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min5']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min5']." Like','warning');</script>";
}elseif($sl > $s['max5']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max5']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
$quan = file_get_contents('https://graph.facebook.com/'.$id.'?access_token='.$token.'');
$quan = json_decode($quan);
$idget = $quan->id;
$iduserget = $quan->from->id;
$dang = $quan->images;
if($dang == NULL){
$idbuff = 'https://www.facebook.com/'.$iduserget.'/posts/'.$idget.'';
}else{
  $idbuff = 'https://www.facebook.com/photo.php?fbid='.$idget.'&set=a.' .$iduserget.'&type=3';
}
//$idbuff = urlencode($idbuff);
if($idget !== NULL && $iduserget !== NULL){
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(5) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
	$send = autocc(''.$idbuff.'', ''.$sl.'');
	if($send !== 'false'){
	  $check = json_decode($send);
	  $idgd2 = $check->idgd;
	  $iddon = $check->iddon;
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
			$sve = 'Server Like 5';
			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '10', `bh`='1', `sttdone` = '0',`idgd`='$idgd2',`iddon`='$iddon'");
			$stien = 4*$sl;
					$ctime = date("d/m");
			$stien = $tongtien-$stien;
			$static = mysqli_query($db,"SELECT * FROM `static` WHERE `time`='$ctime'");
$static = mysqli_num_rows($static);
if($static == '0'){
    mysqli_query($db,"INSERT INTO `static` SET `sv5l` = '$sl', `sv2l` = '0', `sv1l` = '0', `sv5` = '$stien', `sv2` = '0', `sv1` = '0', `time`='$ctime'");
}elseif($static == '1'){
    mysqli_query($db,"UPDATE `static` SET `sv5l` = `sv5l`+'$sl', `sv5` = `sv5` + '$stien' WHERE `time`='$ctime'");
}
			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
			$maila = $s['mail'];
			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";
}else{
    echo "<script>swal('Hệ Thống!','Lỗi ID BUFF Vui Lòng Kiểm Tra Lại, Nếu Nhập Like Vui Lòng  Ấn GET ID, Hoặc Nếu Bài Viết Chưa Bật Công Khai Vui Lòng Bật Và Thử Lại, Cảm ơn!','warning');</script>";
}
}else{
  echo "<script>swal('Hệ Thống!','Lỗi Server Like, Vui lòng liên hệ Admin hoặc thử lại!','warning');</script>";
}
}
}elseif($sv == '6'){
$c6 = file_get_contents('https://mlike.vn/service/s6.txt');
if($c6 < time()){
$tongtien = $sl*5;
if (empty($id)) {
echo "<script>swal('OOPS!','Vui lòng nhập số ID Bài Viết Facebook!','warning');</script>";
}elseif(empty($sl)){
echo "<script>swal('OOPS!','Vui lòng nhập số lượng Like!','warning');</script>";
}elseif($sl < $s['min1']){
echo "<script>swal('OOPS!','Số lượng phải lớn hơn ".$s['min1']." Like','warning');</script>";
}elseif($sl > $s['max1']){
echo "<script>swal('Cảnh Báo','Số lượng tối đa ".$s['max1']." Like 1 lần ( Có thể order nhiều lần )!','warning');</script>";
}elseif($row['vnd'] < $tongtien){
echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
}else{
	$nd1 = 'Mua Like Bài Viết ID:';
	$bd = $tongtien;
	$gt = '-';
	$idgd = '(6) '.$id.' ('.$sl.')';
	$goc = $row['vnd'];
	$time = time();
## check acc ##
$tongxu = $sl*330;
$ac = mysqli_query($db,"SELECT * FROM `acctds` WHERE `tien` > '$tongxu' AND `slsd` < '15' ORDER BY RAND() LIMIT 1");
$cacc = mysqli_num_rows($ac);
if($cacc > 0){
$acc = mysqli_fetch_assoc($ac);
$idacc = $acc['id'];
	$user = $acc['user'];
	$pass = $acc['pass'];
	$login_tds = json_decode(login($user, urlencode($pass)));
	if($login_tds->success == 'true'){
		$date_create =  date("Y-m-d H:i:s");
		$send_api = send_tds(trim($id), trim($sl), '', $date_create);
		usleep(1000);
		if(strpos($send_api, 'nh công') !== false){
			mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
			$sve = 'Server Limited';
			mysqli_query($db,"INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '14102003', `nse` = '99', `bh`='1', `sttdone` = '1'");
			mysqli_query($db,"UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
			mysqli_query($db,"UPDATE `acctds` SET `tien` = `tien`-'$tongxu', `slsd` = `slsd`+'1' WHERE `id` = '$idacc'");
			$t6 = time()+180;
			$myfil = fopen("s6.txt", "w+");
			 fwrite($myfil, $t6);
			echo "<script>swal('Hệ Thống!','Mua LIKE Thành Công! Cảm ơn bạn!!','success');</script>";
		}else{
			echo "<script>swal('OOPS!','Lỗi ID Tăng Like, Vui Lòng Kiểm Tra Lại, Nếu Vẫn Không Được Vui Lòng Liên Hệ Admin!','warning');</script>";
		}
	}else{
		echo "<script>swal('OOPS!','Lỗi server like, vui lòng liên hệ Admin!','warning');</script>";
	}
}else{
  echo "<script>swal('OOPS!','Lỗi server like, vui lòng liên hệ Admin!','warning');</script>";
}
}
}
}else{
  echo "<script>swal('Hệ Thống!','Vui lòng chọn Server Like và thử lại!','error');</script>";
}
}
break;
} // end switch
}