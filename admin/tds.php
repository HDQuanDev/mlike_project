<?php
require_once('../_System/db.php');
$title = "ADD Token";
require_once('../_System/head.php');
if(!isset($_SESSION['u'])) {
    Header('Location:/login');
    die();
}
if($row['rule'] !== '99') {
    Header('Location:/404');
    die();
}
if($_GET['check'] == 'live') {
    $get = mysqli_query($db, "SELECT `token` FROM `token` ORDER BY RAND() Limit 50");
    $qu = 0;
    while($a = mysqli_fetch_assoc($get)) {
        $token = $a['token'];
        $me = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token), true);
        $qu = $qu + 1;
        if(!$me['id']) {
            mysqli_query($db, "DELETE FROM `token` WHERE `token` = '".$token."'");
        }
    }
    echo "<script>swal('Hệ Thống!','Đã Xoá ".$qu." Token Die!','success');
setTimeout(function(){
    window.location='token';
}, 3000);</script></script>";
}
if($_GET['del']) {
    $id = $_GET['del'];
    $tko = mysqli_query($db, "SELECT * FROM `token` WHERE `id` = '$id'");
    $tko = mysqli_num_rows($tko);
    if($tko != 0) {
        $del = mysqli_query($db, "DELETE FROM `token`
WHERE `id` = '$id'");
        if($del) {
            echo "<script>swal('Hệ Thống!','Xoá Token ID ".$id." thành công!','success');</script>";
            sleep(1);
            echo '<script>
window.location="/admin/token#'.$id.'";
</script>';
        }
    }
}
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $check = mysqli_query($db, "SELECT * FROM `token` WHERE `token` = '".$token."'");
    $check = mysqli_num_rows($check);
    if($check == '0') {
        $time = time();
        mysqli_query($db, "INSERT INTO `token` SET `token` = '".$token."', `time`='$time'");
        echo "<script>swal('Hứa Đức Quân!','Thêm Token Thành Công!','success');</script>";
    }
}
?>

  <div class="container-fluid">
    <div class="row">
  <div class="col-lg-6">
<div class="card shadow mb-4">
 <div class="card-header py-3">             <h6 class="m-0 font-weight-bold text-primary" id="sve">Thêm Token Vào Hệ Thống</h6>
                                </div>
 <div class="card-body">
  <div class="form-group">
    <textarea rows="10" cols="50" type="text" class="form-control form-control-user" id="listtoken"  placeholder="list token facebook, mỗi token 1 dòng" required=""></textarea>
					</div>
<center>
<button type="submit" name="add" class="btn btn-success btn-rounded" id="btn" onclick="addtoken();"><i class="fa fa-add"></i> Thêm Token</button>
</center>
</form>
                                </div>
                            </div>
                            </div>
  <div class="col-lg-6">            
  <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                   <h6 class="m-0 font-weight-bold text-primary">Danh Sách Token Trên Hệ Thống</h6>
                                </div>
                                <div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%">
 <thead>
<tr>
  <th>ID</th>
<th>Token</th>
<th>Thời Gian Thêm</th>
<th>Hành Động</th>
</tr>
</thead>
<tfoot>
<tr>
 <th>ID</th>
<th>Token</th>
<th>Thời Gian Thêm</th>
<th>Hành Động</th>
</tr>
</tfoot>
<tbody>
<?php
            $result1 = mysqli_query($db, "SELECT * FROM `token`");
if($result1) {
    while($ro = mysqli_fetch_assoc($result1)) {
        ?>
<tr>
  <td><b><?=$ro['id'];?></b></td>
  <td><?php echo $ro['token']; ?></td>
<td><?php echo date('H:i d/m', $ro['time']); ?></td>
<td><a class="btn btn-success" href="?del=<?=$ro['id'];?>"><i class="fa fa-trash"></i> Xoá</a></td>
</tr>
				<?php
    }
    echo '</tbody>
</table>
';
}
?>
</div>
                                </div>
                            </div>
  </div>
                            </div>
                </div>
                </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
<script type="text/javascript">
    function addtoken() {
		var insert = 0, update = 0, die = 0;
        var listtoken = $('#listtoken').val();
		$('#an').show();
		 $('#btn').removeClass('btn btn-info').addClass('btn btn-warning').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lí..').attr('disabled','disabled');
		var token = listtoken.split('\n');
		var c = token.length;
		for(i = 0; i < c; i++){
		var kunloc = token[i].trim();
        $.get('token.php', {
            token: kunloc
        }, 
  	
        function(data, status) {
			if(data == '')
			{
				die++;
					$('#btn').removeClass('btn btn-danger').addClass('btn btn-primary').html('Die...').removeAttr('disabled');
			}
			if(data == 'insert')
			{
				insert++;
				$('#insert').removeClass('btn btn-submit').addClass('btn btn-primary').html('Insert...').removeAttr('disabled');
			}
			if(data == 'update')
			{
				update++;
					$('#update').removeClass('btn btn-info').addClass('btn btn-primary').html('Update...').removeAttr('disabled');
				
			}
				$('#btn').removeClass('btn btn-sucess').addClass('btn btn-primary').html('Hoàn thành').removeAttr('disabled');
				setTimeout(function(){
    window.location='token.php';
}, 1500);
			
        });
		}
    }
</script>
 <?php
require_once('../_System/end.php');
?>