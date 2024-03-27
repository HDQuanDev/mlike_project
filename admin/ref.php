<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Thống Kê Giới Thiệu";
require_once('../_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title">Thống Kê Giới Thiệu </h5>
            </div>
            <div class="card-body">
<?php

if($_GET['view']) {
    $id = $_GET['view'];
    $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$id'");
    $tko = mysqli_num_rows($tko);
    if($tko != 0) {
        ?>
<div class="table-responsive scrollbar">
  <div class="mb-3">
    <div class="alert alert-primary" role="alert"><center>Thống Kê: <strong><?=$id;?></strong></center></div>
</div>
  <table class="table table-striped table-bordered" id="example">
    <thead class="bg-200 text-900">
<tr>
<th class="sort" data-sort="id"><b>#</b></th>
<th class="sort" data-sort="user">Tên Tài Khoản</th>
<th class="sort" data-sort="tn">Thu Nhập</th>
</tr>
</thead>
<tbody class="list">
<?php
                      $result1 = mysqli_query($db, "SELECT * FROM `member` WHERE `ref` = '$id'");
        if($result1) {
            while($ro = mysqli_fetch_assoc($result1)) {
                $vnd = $ro['vndgt'];
                $formattedNum = number_format($vnd);
                $vnd = $formattedNum;
                ?>
<tr>
<td class="id"><?php echo $ro['id']; ?></td>
<td class="user"><a href="/admin/user.php?edit=<?php echo $ro['username']; ?>"><?php echo $ro['username']; ?></a></td>
<td class="tn"><?=$vnd;?> ₫</td>
</tr>
				<?php
            }
            echo '</tbody>
</table>
';
        }
        ?>
</div></div></div></div>
<?php
        require_once('../_System/end.php');
        die();
    }
}
?>
<div class="table-responsive scrollbar">
  <table class="table table-striped table-bordered" id="example">
    <thead class="bg-200 text-900">
<tr>
<th class="sort" data-sort="id"><b>#</b></th>
<th class="sort" data-sort="user">Tên Tài Khoản</th>
<th class="sort" data-sort="tn">Hành Động</th>
</tr>
</thead>
<tbody class="list">
<?php
                $result1 = mysqli_query($db, "SELECT * FROM `member`");
if($result1) {
    while($ro = mysqli_fetch_assoc($result1)) {
        ?>
<tr>
<td class="id"><?php echo $ro['id']; ?></td>
<td class="user"><a href="/admin/user.php?edit=<?php echo $ro['username']; ?>"><?php echo $ro['username']; ?></a></td>
<td class="tn"><a class="btn btn-success" href="?view=<?=$ro['username'];?>"><i class="fa fa-eye"></i> Xem</a></td>
</tr>
				<?php
    }
    echo '</tbody>
</table>
';
}
?>
			
</div></div></div></div>

<?php
require_once('../_System/end.php');
?>