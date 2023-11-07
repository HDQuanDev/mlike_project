<?php
$u = 'login';
require_once('../_System/db.php');
if (isset($_POST['login'])) {
$u = mysqli_real_escape_string($db, $_POST['username']);
$p = mysqli_real_escape_string($db, $_POST['password']);
$r = $_POST['redirect'];
if (empty($u)) {
echo "<script>swal('OOPS!','Vui lòng nhập tài khoản!','warning');</script>";
;
}elseif (empty($p)) {
echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu!','warning');";
echo '</script>';
}elseif ($u && $p) {
$p = md5($p);
$query = "SELECT * FROM member WHERE username='$u' AND password='$p' AND `site`='$site'";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) == 1) {
$_SESSION['u'] = $u;
$_SESSION['p'] = $p;
setcookie("username", $u, time()+31556926, "/");
setcookie("password", $p, time()+31556926, "/");
echo "<script>swal('System!','Đăng nhập thành công vui lòng chờ chuyển hướng!','success');</script>";
echo '<script>setTimeout(function(){
    window.location="'.$r.'";
}, 3000);</script>';
exit();
}else {

echo "<script>swal('OOPS!','Tài khoản hoặc mật khẩu không chính xác!','warning');</script>";

}
}

}