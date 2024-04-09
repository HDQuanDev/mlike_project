<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Reset Thành Viên";
require_once('../_System/head.php');

if($_GET['ok'] == '1') {
    mysqli_query($db, "UPDATE `member` SET `rule`= '1' WHERE `id` != '484'");
    echo "<script>swal('Hệ Thống!','Thành công!','success');</script>";
    echo '<script>window.location="/"</script>';
    die();
}
?>
<script>
swal({
          title: 'Xác Nhận Reset?',
          text: 'Ấn xác nhận để reset toàn bộ người dùng về thành viên' ,
          type: 'warning',
          showCancelButton: true,
          confirmButtonText:'Xác Nhận',
          cancelButtonText: 'Hủy Bỏ',
          showCloseButton: true,
          showLoaderOnConfirm: true
        }).then((result) => {
      if(result.value) {
            swal('Deleted', 'You successfully deleted this file', 'success')
          } else {
			window.location="?ok=1";
          } 
        })</script>