<?php
$u = 'reg';
require_once('../_System/db.php');
$one = $_SESSION['so1'];
$two = $_SESSION['so2'];
$dapan = $one * $two;
if (isset($_POST['reg'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $ref = mysqli_real_escape_string($db, $_POST['ref']);
  $captcha = mysqli_real_escape_string($db, $_POST['captcha']);
  if (empty($username)) {
    echo "<script>swal('OOPS!','Vui lòng nhập tên tài khoản!','warning');</script>";
  } elseif (empty($password_1)) {
    echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu!','warning');</script>";
  } elseif ($password_1 != $password_2) {
    echo "<script>swal('OOPS!','Hai mật khẩu không khớp nhau!','warning');</script>";
  } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
    echo "<script>swal('OOPS!','Tên tài khoản chỉ được dùng chữ và số, vui lòng không dùng ký tự đặc biệt hay dấu cách!','warning');</script>";
  } elseif (strlen($username) < 6) {
    echo "<script>swal('OOPS!','Tên tài khoản phải nhiều hơn 6 ký tự','warning');</script>";
  } elseif (strlen($password_1) < 6) {
    echo "<script>swal('OOPS!','Mật khẩu phải nhiều hơn 6 ký tự','warning');</script>";
  } elseif ($dapan != $captcha) {
    echo "<script>swal('OOPS!','Kiểm tra thông minh thất bại, vui lòng thử lại','warning');</script>";
    unset($_SESSION['so1']);
    unset($_SESSION['so2']);
    echo '<script>setTimeout(function(){
    window.location="";
}, 3000);</script>';
  } else {
    $user_check_query = "SELECT * FROM member WHERE username='$username' AND site='$site' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
      if ($username && $password_1 && $password_2) {
        echo "<script>swal('OOPS!','Tài khoản này đã có người đăng ký!','warning');</script>";
      }
    } else {
      $time = time();
      $code = rand(10000000, 99999999);
      $password = md5($password_1);
      $query = "INSERT INTO member(username, password, mgt, ref, very, time, site)
VALUES('$username', '$password', '$code', '0', '0', '$time', '$site')";
      if ($ref) {
        $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `mgt` = '$ref' AND site='$site' LIMIT 1");
        $tko = mysqli_num_rows($tko);
        if ($tko == '0') {
          echo "<script>swal('OOPS!','Mã giới thiệu không tồn tại, vui lòng kiểm tra lại!','warning');</script>";
          die();
        } else {
          $cref = mysqli_query($db, "SELECT * FROM `member` WHERE `mgt`='$ref' AND site='$site'");
          $cref = mysqli_fetch_assoc($cref);
          $userc = $cref['username'];
          $query = "INSERT INTO member(username, password, ref, mgt, very, time, site)
VALUES('$username', '$password', '$userc', '$code', '0', '$time', '$site')";
        }
      }
      mysqli_query($db, $query);
      echo "<script>swal('SUCCESS!','Đăng ký tài khoản thành công, vui lòng đăng nhập để bắt đầu sử dụng!','success');</script>";
      echo '<script>setTimeout(function(){
    window.location="/index.php";
}, 2000);</script>';
    }
  }
}
