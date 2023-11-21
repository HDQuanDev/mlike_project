<?php
require_once('../_System/db.php');
require_once('../module/mail.php');
if (isset($login)) {
  switch ($_GET['act']) {
    case 'update':
      if (isset($_POST['update'])) {
        if (!empty($_POST['hoten']) && !empty($_POST['email']) && !empty($_POST['sdt'])) {
          $hoten = mysqli_real_escape_string($db, $_POST['hoten']);
          $email = mysqli_real_escape_string($db, $_POST['email']);
          $sdt = mysqli_real_escape_string($db, $_POST['sdt']);
          $checkmail = mysqli_query($db, "SELECT * FROM `member` WHERE `email` = '$email'");
          $checkmail1 = mysqli_num_rows($checkmail);
          $validmail = json_decode(checkMail($email));
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>swal('Hệ Thống!','Địa chỉ email không hợp lệ!','warning');</script>";
          } elseif (!preg_match("/^[0-9]{10}$/", $sdt)) {
            echo "<script>swal('Hệ Thống!','Số điện thoại không hợp lệ!','warning');</script>";
          } elseif ($validmail->disposable == false) {
            echo "<script>swal('Hệ Thống!','Vui lòng không sửa dụng email tạm thời hoặc email không tồn tại để cập nhật!','warning');</script>";
          } elseif ($checkmail1 > 0) {
            echo "<script>swal('Hệ Thống!','Địa chỉ email đã được sử dụng!','warning');</script>";
          } else {
            mysqli_query($db, "UPDATE `member` SET `sdt`= '$sdt', `hoten`='$hoten', `email`='$email', `active` = '2', `is_email_disposable` = 'true' WHERE `username` = '$login'");
            echo "<script>swal('Hệ Thống!','Cập nhật Thông Tin Thành Công!','success');</script>";
            echo '<script>setTimeout(function(){
    window.location="/index.php";
}, 3000);</script>';
          }
        } else {
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
          echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu cũ!','warning');</script>";
        } elseif (empty($password_1)) {
          echo "<script>swal('OOPS!','Vui lòng nhập mật khẩu mới!','warning');</script>";
        } elseif ($password_1 != $password_2) {
          echo "<script>swal('OOPS!','Hai mật khẩu không khớp nhau!','warning');</script>";
        } elseif ($mdpass != $row['password']) {
          echo "<script>swal('OOPS!','Mật khẩu cũ không chính xác!','warning');</script>";
        } else {
          mysqli_query($db, "UPDATE `member` SET `password`= '$mdpassnew' WHERE `username`='$login'");
          $nd1 = 'Thay Đổi Mật Khẩu Tài Khoản!';
          $bd = '0';
          $time = time();
          $goc = $row['vnd'];
          mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '3', `goc` = '$goc'");
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
