<?php
require_once('_System/db.php');
$title = "Thông Tin Cá Nhân";
require_once('_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
                            <div class="card-header">
                                <h5 class="card-title">Thay đổi mật khẩu</h5>
                            </div>
                            <div class="card-body">

                                <p class="card-text">
                                <div class="form-group">
<label class="mb-1"><b>TOKEN:</b></label>
<input type="text" class="form-control mb-3" value="<?=$row['token']?>" readonly="">
</div>
                          <div id="result"></div>
<br>
<form>
<div class="form-group">
<label class="mb-1">Mật Khẩu Cũ:</label>
<input type="password" class="form-control mb-3" id="p" value="" required="">
</div>
<div class="form-group">
<label class="mb-1">Mật Khẩu Mới:</label>
<input type="password" class="form-control mb-3" id="p1" value="" required="">
</div>
<div class="form-group">
<label class="mb-1">Nhập Mật Khẩu Mới:</label>
<input type="password" class="form-control mb-3" id="p2" value="" required="">
</div>
<div class="form-group"><center>
<button type="button" class="btn btn-success" id="button" onclick="load_ajax()">Thay Đổi</button>
</center></div>
</form>
</p>
</div></div>

<script>
            function load_ajax(){
               var id = $('#idbuff_like').val();
               $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
 $.ajax({
                    url : "/api/user.php?act=changepass",
                    type : "post",
                    dataType:"text",
                    data : {
                         password : $('#p').val(),
password_1 : $('#p1').val(),
password_2 : $('#p2').val(),
up : 'ok',
                    },
                    success : function (result){
                      $('#button')['html']('Thay Đổi');
 $("#result").html(result);
  
                    }
                });
            }
        </script>
<?php
require_once('_System/end.php');
?>