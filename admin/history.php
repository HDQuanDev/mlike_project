<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Lịch Sử Hoạt Động Thành Viên";
require_once('../_System/head.php');
?> 
<div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title">Lịch Sử Hoạt Động Thành Viên </h5>
            </div>
            <div class="card-body">
<div class="table-responsive scrollbar">

  <table class="table table-striped table-bordered" id="example">
    <thead class="bg-200 text-900">
      <tr>
        <th class="sort" data-sort="id"><b>#</b></th>
        <th class="sort" data-sort="time"><b>Thời Gian</b></th>
        <th class="sort" data-sort="user"><b>Tài Khoản</b></th>
        <th class="sort" data-sort="hd"><b>Hành Động</b></th>
        <th class="sort" data-sort="sd"><b>Số Dư Cuối Cùng</b></th>
        </tr>
        </thead>
        <tbody class="list">
<?php
                $result1 = mysqli_query($db, "SELECT * FROM `lichsu` WHERE `site` = '$site' ORDER BY id DESC LIMIT 1000");
if($result1) {
    while($ro = mysqli_fetch_assoc($result1)) {
        $goc = $ro['goc'];
        $goc = number_format($goc);
        if($ro['loai'] == '3') {
            $nd = ''.$ro['nd'].'';
            $gt = '<span class="badge bg-primary" role="alert">'.$goc.'₫</span> + <span class="badge bg-danger" role="alert">0₫</span> = <span class="badge bg-success" role="alert">'.$goc.'₫</span>';
        } elseif($ro['loai'] == '2') {
            $idgd = $ro['idgd'];
            $idgd = number_format($idgd);
            $nd = ''.$ro['nd'].' <span class="badge bg-info" role="alert">'.$idgd.'₫</span>';
            $quan = $ro['goc'];
            $dz = $ro['gt'];
            $vl = $ro['bd'];
            $vll = number_format($vl);
            if($dz == '-') {
                $quandz = $quan - $vl;
                $quandz = number_format($quandz);
            } else {
                $quandz = $quan + $vl;
                $quandz = number_format($quandz);
            }

            $gt = '<span class="badge bg-primary" role="alert">'.$goc.'₫</span> '.$ro['gt'].' <span class="badge bg-danger" role="alert">'.$vll.'₫</span> = <span class="badge bg-success" role="alert">'.$quandz.'₫</span>';
        } elseif($ro['loai'] == '1') {
            $idgd = $ro['idgd'];
            $nd = ''.$ro['nd'].' <span class="badge bg-info" role="alert">'.$idgd.'</span>';
            $quan = $ro['goc'];
            $dz = $ro['gt'];
            $vl = $ro['bd'];
            $vll = number_format($vl);
            if($dz == '-') {
                $quandz = $quan - $vl;
                $quandz = number_format($quandz);
            } else {
                $quandz = $quan + $vl;
                $quandz = number_format($quandz);
            }

            $gt = '<span class="badge bg-primary" role="alert">'.$goc.'₫</span> '.$ro['gt'].' <span class="badge bg-danger" role="alert">'.$vll.'₫</span> = <span class="badge bg-success" role="alert">'.$quandz.'₫</span>';
        }
        $t = $ro['time'];
        ?>
<tr>
 <td class="id"><?=$ro['id'];?></td>
<td class="time"><?php echo time_func($t); ?></td>
<td class="user"><a href="/admin/user.php?edit=<?php echo $ro['user']; ?>"><?php echo $ro['user']; ?></a></td>
<td class="hd"><?php echo $nd; ?></td>
<td class="sd"><?php echo $gt; ?></td>
</tr>
				<?php
    }
}
?>
				</tbody>
</table>

</div></div></div></div>

<?php
require_once('../_System/end.php');
?>