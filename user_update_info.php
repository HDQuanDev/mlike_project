<?php
require_once('_System/db.php');
$uif = '1';
$title = "Cập Nhật Thông Tin Cá Nhân";
//require_once('_System/head-html.php');
require_once('_System/head.php');
if ($row['active'] == '2') {
    Header('Location:/');
    die();
}
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Cập nhật thông tin cá nhân</h5>
    </div>
    <div class="card-body">

        <p class="card-text">
        <div id="result"></div>
        <i class="fa fa-bell"></i> Để đảm bảo an toàn cho tài khoản của bạn vui lòng cập nhân thông tin cá nhân tại đây, thông tin cá nhân phải chính xác để chúng tôi có thể trợ giúp tốt nhất cho bạn về các vấn đề phát sinh sau này!<br>
        <form>
            <div class="form-group">
                <label class="mb-1">Họ Và Tên:</label>
                <input type="text" class="form-control mb-3" id="ten" value="" required="">
            </div>
            <div class="form-group">
                <label class="mb-1">Số Điện Thoại:</label>
                <input type="number" class="form-control mb-3" id="sdt" value="" required="">
            </div>
            <div class="form-group">
                <label class="mb-1">Địa Chỉ Email:</label>
                <input type="email" class="form-control mb-3" id="mail" value="" required="">
            </div>
            <strong>(*)</strong> Vui lòng đảm bảo các thông tin bạn vừa nhập là <code>chính xác</code>, nếu chúng tôi phát hiện các <code>thông tin trên là sai</code> chúng tôi có thể <code>Xoá tài khoản</code> của bạn mà không báo trước. Cảm ơn bạn đã sử dụng MLIKE.VN <br>
            <div class="form-group">
                <center>
                    <button type="button" class="btn btn-success" id="button" onclick="load_ajax()">Lưu Lại</button>
                </center>
            </div>
        </form>
        </p>
    </div>
</div>

<script>
    function load_ajax() {
        var id = $('#idbuff_like').val();
        $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $.ajax({
            url: "/api/user.php?act=update",
            type: "post",
            dataType: "text",
            data: {
                hoten: $('#ten').val(),
                sdt: $('#sdt').val(),
                email: $('#mail').val(),
                update: 'ok',
            },
            success: function(result) {
                $('#button')['html']('Lưu Lại');
                $("#result").html(result);

            }
        });
    }
</script>
<?php
require_once('_System/end.php');
?>