<?php
require_once('_System/db.php');
$title = "Giới Thiệu Bạn Bè";
require_once('_System/head.php');
?>
<div class="row g-0">
  <div class="col-lg-6 ps-lg-2 mb-3">
          <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title" data-anchor="data-anchor">Giới Thiệu Bạn Bè</h5>
            </div>
            <div class="card-body">
              <p class="mb-0"><?=$s['noteref'];?><br>
<div class="form-group"><label>Mã Giới Thiệu Của Bạn:</label><input type="number" class="form-control mb-3" value="<?=$row['mgt'];?>" readonly="" required=""></div>
<div class="form-group"><label>Link Giới Thiệu Của Bạn:</label><input type="url" class="form-control mb-3" value="<?=$domain;?>/share.php?ref_code=<?=$row['mgt'];?>" readonly="" required="" id="myInput"></div>
<button type="submit" class="btn btn-info me-1 mb-1" onclick="myFunction()"><i class="fa fa-clone"></i> Copy Link</button></p></div></div></div>
<div class="col-lg-6 ps-lg-2 mb-3">
          <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title" data-anchor="data-anchor">Danh Sách Bạn Đã Mời</h5>
            </div>
            <div class="card-body">
              <p class="mb-0">
<div class="table-responsive scrollbar">
  <table id="example" class="table table-striped table-bordered"  style="width:100%">
    <thead>
<tr>
<th>#</th>
<th>Tên Tài Khoản</th>
<th>Thu Nhập</th>
</tr>
</thead>
<tbody>
<?php
				$result1 = mysqli_query($db,"SELECT * FROM `member` WHERE `ref` = '$login'");
				if($result1)
				{
while($ro = mysqli_fetch_assoc($result1))
				{
				   $vnd = $ro['vndgt'];
$formattedNum = number_format($vnd);
$vnd = $formattedNum; 
				?>
<tr>
<td><?php echo $ro['id']; ?></td>
<td><?php echo $ro['username']; ?></td>
<td><?=$vnd;?> ₫</td>
</tr>
				<?php 
				}
echo '</tbody>
</table>
';
}
				
?>
</p></div></div></div></div>



<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  swal('Referral!','Copy Link Giới Thiệu Thành Công!','success');
}
</script>
<?php
require_once('_System/end.php');
?>