<?php
require_once('_System/db.php');
$title = "Lịch Sử Hoạt Động";
require_once('_System/head.php');
?>
 
<div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
              <h5 class="card-title">Lịch Sử Hoạt Động</h5>
            </div>
            <div class="card-body">
<div class="table-responsive">
  <table id="example" class="table table-striped table-bordered"  style="width:100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Thời Gian</th>
        <th>Hành Động</th>
        <th>Số Dư Cuối Cùng</th>
        </tr>
        </thead>
        <tbody>
<?php
                $result1 = mysqli_query($db, "SELECT * FROM `lichsu` WHERE `user` = '".$login."' AND `site` = '$site' ORDER BY id DESC LIMIT 4000");
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
 <td><?=$ro['id'];?></td>
<td><?php echo time_func($t); ?></td>
<td><?php echo $nd; ?></td>
<td><?php echo $gt; ?></td>
</tr>
				<?php
    }
}
?>
				</tbody>
</table>
</div></div></div>

<?php
require_once('_System/end.php');
?>