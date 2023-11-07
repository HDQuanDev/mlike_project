<?php
$page = 'tim_tt_tay';
require_once('../../_System/config.php');
require_once('../../_System/db.php');
$title = "Tăng Tim TikTok SALE";
require_once('../../_System/head.php');

switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
?>
        <script>
            function format_curency(a) {
                a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
        </script>
        <script>
            function calc() {
                var sl = document.getElementById("sl").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                if (sv == '1') {
                    var gia = '<?= $gia; ?>';
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Tim TikTok Sale</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server:</label>
                    <div class="form-check">
                        <input class="form-check-input" checked <? if ($sv1 == 'off') {
                                                            echo 'disabled';
                                                        } else {
                                                            echo 'checked';
                                                        } ?> id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Like 1<i class="wi wi-time-1"></i><i class="wi wi-moon-1"></i> (<b><?= $gia1; ?>₫</b>) (Tim tây sale, bắt đầu lên từ 5p - 15p. Rất ít delay. Tốc độ chậm 200-300 / 1h ) <? if ($sv1 == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger">
                                Vui lòng dùng link
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        <label>Nhập ID Hoặc Link Video:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getTym('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link hoặc nhập ID!" required="" id="idbuff_like">

                        </div>
                        <div id="detailServer">
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - <mark style="color:red;"><strong>Định Dạng nhập link : Link rút gọn ở đt hoặc link máy tính đều được.</strong></mark> <br>
                        - Mỗi nick tiktok chỉ được buff 1 video. Video cũ hoàn thành mới được buff video khác <br> 
                        - Đơn đang chạy ở Mlike mà bạn mua ở bên khác song song nếu lên hụt sẽ không xử lý. Hoàn thành = gốc + số mua <br>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Cách Tính Giá: Giá x Số Lượng
                                <hr>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong></center>
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
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/tiktok/like_v2.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
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
                <h4 class="card-title">Lịch Sử Tăng Tim TikTok Sale</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="sl">Gốc</th>
                                <th class="sort" data-sort="profile">Đã Tăng</th>
                                <th class="sort" data-sort="goc">Server BUFF</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like_tay' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_like_tay' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="sl"><?php echo $ro['iddon']; ?></td>
                                        <td class="sl"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><a href="https://www.tiktok.com/@tiktok/video/<?php echo $ro['profile']; ?>"><?php echo $ro['profile']; ?></a></td>
                                        <td class="goc"><?php echo $ro['nse']; ?></td>
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