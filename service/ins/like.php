<?php
$page = 'like_ig';
require_once('../../_System/db.php');
$title = "Tăng Like Instagram";
require_once('../../_System/head.php');

switch ($_GET['act']) {
    default:
?>

        <script>
            function format_curency(a) {
                a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
        </script>
        <script>
            function calc() {
                var sl = document.getElementById("sl").value;
                var idbuff = document.getElementById("idbuff_like").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                if (sv == '1') {
                    var gia = '<?= $gia; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                }
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("total").innerHTML = quan;
                document.getElementById("slmua").innerHTML = dz;
                document.getElementById("idbuff").innerHTML = idbuff;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Like Instagram</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Like:</label>
                    <div class="form-check">
                        <input class="form-check-input" disabled ="checked" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Like 1 (<b><?= $gia1; ?>₫</b>) ( Người dùng việt thật, lên nhanh) </label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger"> Like việt người dùng thật bấm tay</div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 2 (<b><?= $gia2; ?>₫</b>) (Like việt Nuôi, lên nhanh) </label>
                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger"> - Like việt rẻ lên nhanh , đủ số lượng <br>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server Like 3 (<b><?= $gia3; ?>₫</b>) (Like tây, lên nhanh)(<mark style="color:red;"><strong>Nhập Nguyên Link</strong></mark>)</label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger"> Like tây rẻ nhanh</div>
                        </div>
                    </div><br>
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link Instagram:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link hoặc nhập ID!" required="" id="idbuff_like">
                            <div class="input-group-append">
                           <!-- <button class="btn btn-outline-warning" id="get" type="button">GET ID</button> -->
                            </div>
                        </div>
                        <label>(*) Nếu nhập <code>link</code> vui lòng ấn vào <code>"GET ID"</code></label>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - Nhập nguyên link vào <br>
                        - Tốc độ cực nhanh , có thể tụt trong lúc chạy bên buff dư 5-10%. <br>
                        - 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ</strong></center>
                    </div>
                    <center>
                        <button type="button" id="button" name="add" class="btn btn-primary btn-rounded me-1 mb-1" onclick="send_order()"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>
            </div>
        </div>
        <script>
            function send_order() {
                var id = $('#idbuff_like').val();
                var sv = $("input[name='sv']:checked").val();
                var sl = $('#sl').val();
                var gift = $('#gift').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/instagram/like.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
                        gift,
                        token,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            swal('Hệ Thống!', response.msg, 'success');
                            setTimeout(function() {
                                    window.location = "";
                                },
                                1500);
                        } else {
                            swal('Hệ Thống!', response.msg, 'warning');
                        }
                        $('#button')['html']('<i class="fa fa-dollar-sign"></i> Thanh Toán');
                        $("#button")
                            .prop("disabled", false)

                    }
                });
            }
        </script>
    <?php
        break;
    case 'history':
    ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title">Lịch Sử Tăng Like Instagram</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">Đã Tăng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="nse">Server</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ins_like' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ins_like' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                            ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="goc"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="nse"><?php echo $ro['nse']; ?></td>
                                        <td class="user"><?php echo $ro['user']; ?></td>
                                        <td class="tt"><?php trangthai($tt); ?></td>
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
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=buy" class="btn btn-primary">Quay Lại Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>
            </div>
        </div>
<?php
        break;
}
require('../../_System/end.php');
?>