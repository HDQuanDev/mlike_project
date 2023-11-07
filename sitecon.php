<?php
require_once('_System/db.php');

switch($_GET['act']){
    default:
    $title = "Tạo site con";
require_once('_System/head.php');

    ?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Tạo site con</h5>
    </div>
    <div class="card-body">

        <p class="card-text">
        <div id="result"></div>
        <div class="alert alert-warning" role="alert">
            <h5 class="mb-0"><i class="fa fa-exclamation-triangle"></i> Nạp ít nhất 2 triêu / tháng mới được hỗ trợ mở site con. Giá cả sẽ được set giá riêng, ở đâu rẻ hơn mlike cấp rẻ hơn nữa. Bao giá toàn facebook. Nếu mỗi tháng không nạp đủ chỉ tiêu sẽ trả thêm phí duy trì web 200k / tháng.</h5>
            <h5 class="mb-0">- Hình thức quản lý : Tài khoản của bạn ở SITE CHÍNH sẽ là tải khoản quản lý ở site con bạn sẽ tạo. (dùng chung tài khoản, mật khẩu).</h5>
            <h5 class="mb-0">- Tài khoản tạo ở site con sẽ không đăng nhập được ở SITE CHÍNH và ngược lại.</h5>
            <h5 class="mb-0">- Khách hàng tạo tài khoản và sử dụng dịch vụ ở site con. Tiền sẽ trừ vào tài khoản của đại lý ở SITE CHÍNH. Vì thế để khách hàng mua được tài khoản đại lý phải còn số dư.</h5>
            <h5 class="mb-0">- Chúng tôi hỗ trợ mục đích kinh doanh của tất cả đại lí!</h5><br>
            <h5 class="font-bold text-danger mb-0">- Các bước đăng ký đại lý:</h5>
            <h5 class="font-bold text-danger mb-0">&nbsp;&nbsp;&nbsp;&nbsp; + Nhập tên miền muốn đăng ký đại lý</h5>
            <h5 class="font-bold text-danger mb-0">&nbsp;&nbsp;&nbsp;&nbsp; + Bấm nút Tạo SITE</h5>
            <h5 class="font-bold text-danger mb-0">&nbsp;&nbsp;&nbsp;&nbsp; + Chỉnh Name Server (NS) về name server hiện ra ở mục NAMESERVERS</h5>
            <h5 class="font-bold text-danger mb-0">&nbsp;&nbsp;&nbsp;&nbsp; + Chờ 1 thời gian để hệ thống sẽ tự nhận diện và cài đặt site đại lý cho bạn</h5>
        </div>
        <?php
        $chec = mysqli_query($db, "SELECT * FROM `sitecon` WHERE `user` = '$login'");
        $check = mysqli_num_rows($chec);
        if($check == '1'){
            $si = mysqli_fetch_assoc($chec);
            ?>
            <div class="form-group">
            <label class="mb-1">Tên miền của bạn:</label>
            <input type="domain" class="form-control mb-3" readonly id="domain" value="<?=$si['site'];?>" required="">
            </div>
            <h5 class="font-bold text-danger mb-0">Vui lòng trỏ domain đến các NS sau:</h5>
            <div class="form-group">
            <label class="mb-1">Nameserver 1:</label>
            <input type="domain" class="form-control mb-3" readonly id="domain" value="<?=$si['ns1'];?>" required="">
            </div>
            <div class="form-group">
            <label class="mb-1">Nameserver 2:</label>
            <input type="domain" class="form-control mb-3" readonly id="domain" value="<?=$si['ns2'];?>" required="">
            </div>
<?php
if($si['trangthai'] == '1'){
    $tt = 'Đang chờ trỏ Nameserver';
}elseif($si['trangthai'] == '2'){
    $tt = 'Đã trỏ tên miền, đang chờ vào site kích hoạt';
}elseif($si['trangthai'] == '3'){
    $tt = 'Site hoạt động bình thường';
}
?>
            <div class="form-group">
            <label class="mb-1">Trạng Thái SITE Con:</label>
            <input type="domain" class="form-control mb-3" readonly id="domain" value="<?=$tt;?>" required="">
            </div>
            <form><div class="form-group"><center>
<button type="button" class="btn btn-warning" id="button" onclick="check()">Kiểm tra trạng thái SITE</button>
</center></div></form>
<br>
<script>
            function check(){
               $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
 $.ajax({
                    url : "/sitecon?act=check",
                    type : "post",
                    dataType:"text",
                    data : {
                         check : '1'
                    },
                    success : function (result){
                      $('#button')['html']('Kiểm tra trạng thái SITE');
 $("#result").html(result);
  
                    }
                });
            }
        </script>
            <?
        }else{
            ?>
<form>
<div class="form-group">
<label class="mb-1">Nhập tên miền mà bạn muốn đăng ký site:</label>
<input type="domain" class="form-control mb-3" id="domain" value="" required="">
</div>
<div class="form-group"><center>
<button type="button" class="btn btn-success" id="button" onclick="load_ajax()">Tạo SITE</button>
</center></div>
</form>
<br>
<?php
        }
        if($check == '0'){
echo '<div class="alert alert-primary" role="alert">
<div id="result"></div><h3 style="text-align: center; font-size: 45px; padding: 15px;">Bấm nút <span style="color: red;">Tạo SITE</span> để lấy <span style="color: red;">NAMESERVERS</span>!!!</h3>
</div>';
        }else{
            echo '<div class="alert alert-primary" role="alert">
<div id="result"></div><h3 style="text-align: center; font-size: 45px; padding: 15px;">Vui lòng trỏ <span style="color: red;">Nameserver</span> đến các <span style="color: red;">NAMESERVERS</span> phía trên để kích hoạt site của bạn!!!</h3>
</div>';
        }
        ?>
        </p>
    </div>
</div>
<script>
            function load_ajax(){
               var id = $('#idbuff_like').val();
               $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
 $.ajax({
                    url : "/api/addsite.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         domain : $('#domain').val()
                    },
                    success : function (result){
                      $('#button')['html']('Tạo SITE');
 $("#result").html(result);
  
                    }
                });
            }
        </script>
<?php
require_once('_System/end.php');
break;
case 'check':
    require_once('module/cloudflare.php');
    $chec = mysqli_query($db, "SELECT * FROM `sitecon` WHERE `user` = '$login'");
        $check = mysqli_num_rows($chec);
        if($check == '0'){
            echo "<script>swal('OOPS!','Vui lòng tạo site trước khi kiểm tra trạng thái','warning');</script>";
        }else{
            $si = mysqli_fetch_assoc($chec);
            $domain = $si['site'];
            $user = $si['user'];
            $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$user' AND `site` = '$domain'");
            $u = mysqli_fetch_assoc($u);
            $check = cloudflare_check($domain);
            $quan = json_decode($check);
            if($quan->result[0]->status == 'active' && $u['active'] == '1'){
                echo "<script>swal('OOPS!','Đã nhận domain và đang chờ vào site kích hoạt','success');</script>";
                mysqli_query($db, "UPDATE `sitecon` SET `trangthai` = '2'
                WHERE `user` = '$user' AND `site` = '$domain'");
                echo '<script>setTimeout(function(){
                    window.location="/sitecon";
                }, 3000);</script>';
            }elseif($quan->result[0]->status == 'active' && $u['active'] == '2'){
                echo "<script>swal('OOPS!','Đã nhận domain và đã kích hoạt site, site họat động bình thường','success');</script>";\
                mysqli_query($db, "UPDATE `sitecon` SET `trangthai` = '3'
                WHERE `user` = '$user' AND `site` = '$domain'");
                echo '<script>setTimeout(function(){
                    window.location="/sitecon";
                }, 3000);</script>';
            }else{
                echo "<script>swal('OOPS!','Đang chờ trỏ domain đến Nameserver đã hiện thị!','success');</script>";
                mysqli_query($db, "UPDATE `sitecon` SET `trangthai` = '1'
                WHERE `user` = '$user' AND `site` = '$domain'");
                echo '<script>setTimeout(function(){
                    window.location="/sitecon";
                }, 3000);</script>';
            }
        }
             
    break;
}

?>