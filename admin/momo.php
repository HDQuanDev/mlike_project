<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Thống Kê Nạp Tiền Tự Động";
require_once('../_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title">Lịch Sử Giao Dịch</h5>
            </div>
            <div class="card-body">
<div class="table-responsive scrollbar">
  <table class="table table-striped table-bordered" id="example">
    <thead class="bg-200 text-900">
<tr>
<th class="sort" data-sort="id"><b>IDGD</b></th>
<th class="sort" data-sort="time">Thời Gian</th>
<th class="sort" data-sort="time">Hình Thức</th>
<th class="sort" data-sort="user">Tên TK</th>
<th class="sort" data-sort="st">Số Tiền Nạp</th>
<th class="sort" data-sort="idgd">Ghi Chú</th>
</tr>
</thead>
<tbody class="list">
<?php
				$result1 = mysqli_query($db,"SELECT * FROM `momo` WHERE `site` = '$site' ORDER BY id DESC LIMIT 0,1000");
				if($result1)
				{


while($ro = mysqli_fetch_assoc($result1))
				{
				   $vnd = $ro['vnd'];
				   $vnd = number_format($vnd);
				   $t = $ro['time'];
				  ?>
<tr>
 <td class="id"><?=$ro['id'];?></td>
 <td class="time"><?php echo time_func($t); ?></td>
 <td class="id"><?=$ro['app'];?></td>
 <td class="user"><a href="/admin/user.php?edit=<?php echo $ro['user']; ?>"><?php echo $ro['user']; ?></a></td>
 <td class="st"><?=$vnd;?>₫</td>
 <td class="idgd"><?=$ro['text'];?></td>
</tr>
				<?php 
				}

}
				?>
</tbody>

</table>

</div></div></div>

<?php
require_once('../_System/end.php');
?>