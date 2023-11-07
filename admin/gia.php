<?php
require_once('../_System/db.php');
$title = "Chỉnh Sửa Bảng Giá";
require_once('../_System/head.php');
if(!isset($_SESSION['u'])){
Header('Location:/login');
die();
}
if($row['rule'] !== '99'){
Header('Location:/404');
die();
}
if (isset($_POST['web'])) {
$dl = mysqli_real_escape_string($db, $_POST['dl']);
$ctv = mysqli_real_escape_string($db, $_POST['ctv']);
$ckref = mysqli_real_escape_string($db, $_POST['ckref']);
$minref = mysqli_real_escape_string($db, $_POST['minref']);
$min1 = mysqli_real_escape_string($db, $_POST['min1']);
$max1 = mysqli_real_escape_string($db, $_POST['max1']);
$min5 = mysqli_real_escape_string($db, $_POST['min5']);
$max5 = mysqli_real_escape_string($db, $_POST['max5']);
$min2 = mysqli_real_escape_string($db, $_POST['min2']);
$max2 = mysqli_real_escape_string($db, $_POST['max2']);
$min3 = mysqli_real_escape_string($db, $_POST['min3']);
$max3 = mysqli_real_escape_string($db, $_POST['max3']);
$min4 = mysqli_real_escape_string($db, $_POST['min4']);
$max4 = mysqli_real_escape_string($db, $_POST['max4']);
$smin = mysqli_real_escape_string($db, $_POST['smin']);
$smax = mysqli_real_escape_string($db, $_POST['smax']);
$submin = mysqli_real_escape_string($db, $_POST['submin']);
$submax = mysqli_real_escape_string($db, $_POST['submax']);
$cmin = mysqli_real_escape_string($db, $_POST['cmin']);
$cmax = mysqli_real_escape_string($db, $_POST['cmax']);

mysqli_query($db, "UPDATE `system` SET `dl`= '$dl', `ctv`='$ctv', `ckref`='$ckref', `minref`='$minref', `min1`='$min1', `max1`='$max1', `min2`='$min2', `max2`='$max2', `min3`='$min3', `max3`='$max3', `min4`='$min4', `max4`='$max4', `cmin`='$cmin', `cmax`='$cmax', `smin`='$smin', `smax`='$smax', `submin`='$submin', `submax`='$submax', `max5`='$max5', `min5`='$min5'");
echo "<script>swal('Hệ Thống!','Cập nhật Website Thành Công!','success');</script>";
echo '<script>setTimeout(function(){
    window.location="'.$url.'";
}, 3000);</script>';
}
?>

<div class="card border-danger border-bottom border-3 border-0">

            <div class="card-header">
              <h5 class="card-title" data-anchor="data-anchor">Chỉnh Sửa Bảng Giá</h5>
            </div>
            <div class="card-body">
              <p class="mb-0">
<form action="" id="info" method="POST" accept-charset="utf-8" class="user">
<div class="mb-3">
<label>Chiết khấu CTV (Đơn vị ₫):</label>
<input type="number" class="form-control mb-3" name="ctv" value="<?=$s['ctv'];?>" required="">
</div>
<div class="mb-3">
<label>Chiết khấu Đại Lý (Đơn Vị ₫):</label>
<input type="number" class="form-control mb-3" name="dl" value="<?=$s['dl'];?>" required="">
</div>
<div class="mb-3">
<label>Hoa Hồng Giới Thiệu (Đơn Vị %):</label>
<input type="number" class="form-control mb-3" name="ckref" value="<?=$s['ckref'];?>" required="">
</div>
<div class="mb-3">
<label>Hoa Hồng Tối Thiểu (Đơn Vị ₫):</label>
<input type="number" class="form-control mb-3" name="minref" value="<?=$s['minref'];?>" required="">
</div>
<div class="mb-3">
<label>Min Like Server 1:</label>
<input type="number" class="form-control mb-3" name="min1" value="<?=$s['min1'];?>" required="">
</div>
<div class="mb-3">
<label>Max Like Server 1:</label>
<input type="number" class="form-control mb-3" name="max1" value="<?=$s['max1'];?>" required="">
</div>
<div class="mb-3">
<label>Min Like Server 2:</label>
<input type="number" class="form-control mb-3" name="min2" value="<?=$s['min2'];?>" required="">
</div>
<div class="mb-3">
<label>Max Like Server 2:</label>
<input type="number" class="form-control mb-3" name="max2" value="<?=$s['max2'];?>" required="">
</div>
<div class="mb-3">
<label>Min Like Server 3:</label>
<input type="number" class="form-control mb-3" name="min3" value="<?=$s['min3'];?>" required="">
</div>
<div class="mb-3">
<label>Max Like Server 3:</label>
<input type="number" class="form-control mb-3" name="max3" value="<?=$s['max3'];?>" required="">
</div>
<div class="mb-3">
<label>Min Like Server 4:</label>
<input type="number" class="form-control mb-3" name="min4" value="<?=$s['min4'];?>" required="">
</div>
<div class="mb-3">
<label>Max Like Server 4:</label>
<input type="number" class="form-control mb-3" name="max4" value="<?=$s['max4'];?>" required="">
</div>
<div class="mb-3">
<label>Min Like Server 5:</label>
<input type="number" class="form-control mb-3" name="min5" value="<?=$s['min5'];?>" required="">
</div>
<div class="mb-3">
<label>Max Like Server 5:</label>
<input type="number" class="form-control mb-3" name="max5" value="<?=$s['max5'];?>" required="">
</div>
<div class="mb-3">
<label>Min Share:</label>
<input type="number" class="form-control mb-3" name="smin" value="<?=$s['smin'];?>" required="">
</div>
<div class="mb-3">
<label>Max Share:</label>
<input type="number" class="form-control mb-3" name="smax" value="<?=$s['smax'];?>" required="">
</div>
<div class="mb-3">
<label>Min Follow:</label>
<input type="number" class="form-control mb-3" name="submin" value="<?=$s['submin'];?>" required="">
</div>
<div class="mb-3">
<label>Max Follow:</label>
<input type="number" class="form-control mb-3" name="submax" value="<?=$s['submax'];?>" required="">
</div>
<div class="mb-3">
<label>Min Bình Luận:</label>
<input type="number" class="form-control mb-3" name="cmin" value="<?=$s['cmin'];?>" required="">
</div>
<div class="mb-3">
<label>Max Bình Luận:</label>
<input type="number" class="form-control mb-3" name="cmax" value="<?=$s['cmax'];?>" required="">
</div>
<button type="submit" class="btn btn-info btn-rounded btn-block" name="web"><i class="fa fa-info"></i> Lưu</button>
</form>

</p></div></div>

<?php
require_once('../_System/end.php');
?>