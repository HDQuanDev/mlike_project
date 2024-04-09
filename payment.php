<?php
require_once('_System/db.php');
$title = "Nạp Tiền Vào Tài Khoản";
require_once('_System/head.php');
?>
<script>
    function copy(text) {
        var input = document.createElement('input');
        input.setAttribute('value', text);
        document.body.appendChild(input);
        input.select();
        var result = document.execCommand('copy');
        document.body.removeChild(input);
        if (result) {
            swal("Thành công!", "Đã copy nội dung vào Clipboard!", "success");
        } else {
            swal("Lỗi!", "Không thể copy nội dung!", "error");
        }
    }

    function ndct() {
        var text = "mlike <?= $login; ?>";
        copy(text);
    }

    function stk(text) {
        copy(text);
    }
</script>
<div class="row g-0">
    <div class="col-lg-6 ps-lg-2 mb-3">
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title">Nạp tiền vào tài khoản</h4>
            </div>
            <div class="card-body">
                <p class="card-text">
                <div id="result"></div>
                <div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-triangle"></i> Lưu ý: <?= $s['ttck']; ?></div>
                </P>
                <center>
                    <button class="btn btn-outline-info" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-bs-original-title="" title="">Nạp Tiền Bằng Mã QR</button>
                </center><br>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nạp Tiền Bằng Mã QR</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                            </div>
                            <div class="modal-body">
                                <form class="theme-form">
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Nhập Số Tiền Muốn Nạp</label>
                                        <input type="number" class="form-control" id="vnd" placeholder="Nhập số tiền...">
                                    </div>
                                    <div class="col-12">
                                        <span id="resultt"></span>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Đóng</button>
                                <button class="btn btn-secondary" type="button" data-bs-original-title="" title="" onclick="load_ajax()" id="button">Tạo Mã QR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $resul = mysqli_query($db, "SELECT * FROM `stk` WHERE `site` = '$site'");
while ($r = mysqli_fetch_assoc($resul)) {
    ?>
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>Tài Khoản Số: <?= $r['id']; ?></h4>
                                </div>
                                <p class="card-text">
                                    <font>Ngân Hàng: <b class="bold"><?= $r['nganhang']; ?></b><br>
                                        STK: <b><?= $r['stk']; ?></b> <button onclick="stk('<?= $r['stk']; ?>')" class="btn btn-warning me-1 mb-1"><i class="fa fa-copy"></i></button><br>
                                        Chủ TK: <b><?= $r['name']; ?> </b>
                                        <hr>
                                        <b style="color:red;">(Duyệt tiền tự động 1p - 5p <br> Vui Lòng Kéo xuống dưới copy nội dung chuyển)</b>
                                    </font>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
}
?>
                <div class="mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Nội Dung Chuyển Tiền</h4>
                            </div>
                            <p class="card-text">
                                <b><?= $s['ndck']; ?> <?= $row['username']; ?> <button onclick="ndct()" class="btn btn-warning me-1 mb-1"><i class="fa fa-copy"></i></button></b>
                                <hr>
                                <b style="color:red;">(Chuyển đúng nội dung để được xử lý nạp tiền nhanh nhất)</b>

                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 ps-lg-2 mb-3">
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title">Lịch Sử Nạp Tiền</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>ID</b></th>
                                <th class="sort" data-sort="id"><b>IDGD</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="time">Hình Thức</th>
                                <th class="sort" data-sort="st">Số Tiền Nạp</th>
                                <th class="sort" data-sort="idgd">Ghi Chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            $result1 = mysqli_query($db, "SELECT * FROM `momo` WHERE `user`='$login' AND `site` = '$site' ORDER BY id DESC");
while ($ro = mysqli_fetch_assoc($result1)) {
    $vn = $ro['vnd'];
    $vnd = number_format(floatval($vn));
    $t = $ro['time'];
    ?>
                                <tr>
                                    <td class="id"><?= $ro['id']; ?></td>
                                    <td class="id"><?= $ro['tranid']; ?></td>
                                    <td class="time"><?php echo time_func($t); ?></td>
                                    <td class="id"><?= $ro['app']; ?></td>
                                    <td class="st"><?= $vnd; ?>₫</td>
                                    <td class="idgd"><?= $ro['text']; ?></td>
                                </tr>
                            <?php
}

?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function load_ajax() {
        $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
        $.ajax({
            url: "/api/qr.php",
            type: "post",
            dataType: "text",
            data: {
                vnd: $('#vnd').val(),
                nd: '<?= $s['ndck']; ?> <?= $row['username']; ?>',
                act: 'getqr',
            },
            success: function(result) {
                $('#button')['html']('Tạo Mã QR');
                $("#resultt").html(result);

            }
        });
    }
</script>
<?php
require_once('_System/end.php');
