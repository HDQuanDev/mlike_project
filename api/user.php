<?php
require_once('../_System/db.php');
if(isset($login)){
switch($_GET['act']){
  case 'update':
if(isset($_POST['update'])){
if(!empty($_POST['hoten']) && !empty($_POST['email']) && !empty($_POST['sdt'])){
$hoten = mysqli_real_escape_string($db, $_POST['hoten']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$sdt = mysqli_real_escape_string($db, $_POST['sdt']);
mysqli_query($db, "UPDATE `member` SET `sdt`= '$sdt', `hoten`='$hoten', `email`='$email', `active` = '2' WHERE `username` = '$login'");
echo "<script>swal('Hệ Thống!','Cập nhật Thông Tin Thành Công!','success');</script>";
echo '<script>setTimeout(function(){
    window.location="/index.php";
}, 3000);</script>';
}else{
  echo "<script>swal('Hệ Thống!','Vui lòng nhập đầy đủ thông tin!','warning');</script>";
}
}
break;

case 'changepass':
  if (isset($_POST['up'])) {
$password = mysqli_real_escape_string($db, $_POST['password']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
$mdpass = md5($password);
$mdpassnew = md5($password_1);
if (empty($password)) {
Echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu cũ!','warning');</script>";
}elseif (empty($password_1)) { Echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu mới!','warning');</script>"; }elseif ($password_1 != $password_2) {
Echo "<script>swal('OOPS!','Hai mật khẩu không khớp nhau!','warning');</script>";
}elseif($mdpass != $row['password']){
Echo "<script>swal('OOPS!','Mật khẩu cũ không chính xác!','warning');</script>";
}else{
mysqli_query($db, "UPDATE `member` SET `password`= '$mdpassnew' WHERE `username`='$login'");
$nd1 = 'Thay Đổi Mật Khẩu Tài Khoản!';
$bd = '0';
$time = time();
$goc = $row['vnd'];
mysqli_query($db,"INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '3', `goc` = '$goc'");
echo "<script>swal('Hệ Thống!','Thay đổi mật khẩu thành công!','success');</script>";
echo '<script>setTimeout(function(){
    window.location="/logout.php";
}, 3000);</script>';
die();

}
}
  break;
}
}