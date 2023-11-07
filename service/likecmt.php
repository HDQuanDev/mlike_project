<?
$page = 'fb_likecmt';
require_once('../_System/db.php');
$title = "Tăng Like Comment Facebook";
require_once('../_System/head.php');
include('../module/tlc.php');
require_once('../module/tds.php');
$min = '20';
$max = '10000';
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
                var gift = document.getElementById("gift").value;
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                }
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;
                <?
                $gt = time();
                $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '$site' AND `ex` > '$gt'");
                while ($ro = mysqli_fetch_assoc($result1)) {
                ?>
                    if (gift == '<?= $ro['code']; ?>') {
                        var dis = '<?= $ro['dis']; ?>';

                    }
                <? } ?>

                var giam = (sl * gia) - ((sl * gia) * dis / 100);
                var dz = giam.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("giamgia").innerHTML = dz;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Like Comment Facebook</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Like:</label>
                    <div class="form-check">
                        <input class="form-check-input"  ="checked" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Like 1 (<b><?= $gia1; ?>₫</b>) ( Tốc độ chậm , cài số lượng nhỏ lên được hãy cài tiếp )<span class="badge bg-success">Hoạt động</span></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"  checked id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 2 (<b><?= $gia2; ?>₫</b>) (Tốc độ nhanh. Có thể lên hụt 1-10%) <span class="badge bg-success">Hoạt động</span> </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"   disabled id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server Like 3 (<b><?= $gia3; ?>₫</b>) (Bắt đầu lên từ 3h-6h, inbox hỗ trợ chạy sớm nhất có thể, min 2k - max 10k. Chỉ hỗ trợ cảm xúc like ) <span class="badge bg-danger">Bảo trì</span> </label>
                    </div>
                    <div class="form-group">
                        <label>Nhập ID Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link bài viết hoặc nhập ID!" required="" id="idbuff_like">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning" id="get" type="button">GET ID</button>
                            </div>
                        </div>
                        <label>(*) Nếu nhập <code>link bài viết</code> vui lòng ấn vào <code>"GET ID"</code></label>
                    </div>
                    <label>
                        <h5> <span style="color: red;">(*) Vui Lòng Đọc Lưu Ý trước khi dùng tránh mất tiền</span></h5>
                    </label>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu Ý:</strong><br>
                        <p>
                            - Lấy ID bằng máy tính , kích vào thời gian cmt để lấy link. Nhập vào hệ thống bấm GET ID <br>
                            - Dùng 1 nick không bạn bè , không bạn chung với nick cmt rồi vào link để kiểm tra có bị ẩn hay ko trước khi cài <br>
                            - Mua bằng ID comment có dạng 1594122870782465_1594131514114934 không phải link bài viết.<br>
                            - SV1 có hỗ trợ check lỗi. Nếu cài báo lỗi thì nguyên nhân do id sai hoặc bị ẩn cấm cài tránh mất tiền oan <br>
                            - Không hỗ trợ hủy hoàn khi đã thanh toán <br>
                            - Nhớ chọn cảm xúc trước khi thanh toán <br>
                            - Sv1 tốc độ chậm tài nguyên ít nên lên chậm nên đặt trước số lượng nhỏ test lên được hãy cài tiếp <br>
                            - Sv2 tốc độ nhanh, tuy nhiên tốc độ cũng thay đổi tùy vào thời điểm nên test trước khi cài <br>
                            - Sv3 xử lý lâu tốc độ lên nhanh, khuyến khích cài 1 lần. Min 5k max 20k. Chú ý chỉ hỗ trợ cảm xúc like <br> 
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Like" name="sl" value="" required="">
                    </div>
                    <div class="form-group">
                        <label>Chọn loại cảm xúc</label>
                        <select class="form-select" aria-label="Default select example" id="cx" required="">
                            <option selected="">Vui lòng chọn loại cảm xúc</option>
                            <option value="LIKE">Like</option>
                            <option value="LOVE">Love</option>
                            <option value="HAHA">Haha</option>
                            <option value="WOW">Wow</option>
                            <option value="SAD">Sad</option>
                            <option value="ANGRY">Angry</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <select class="form-select mb-3" name="gift" id="gift" oninput="calc()">
                            <option selected>Chọn Mã Giảm Giá</option>
                            <?php
                            $gt = time();
                            $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '$site' AND `ex` > '$gt'");

                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                            ?>
                                    <option value="<?= $ro['code']; ?>"><b>Mã: <span style="color:red;"><?= $ro['code']; ?></span></b> giảm <i><?= $ro['dis']; ?></i>%</option>
                            <?
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ</strong><br>
                            <strong>Giảm Giá: <span id="giamgia">0</span> VNĐ</strong>
                        </center>
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
                var cx = $('#cx').val();
                var gift = $('#gift').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/facebook/likecmt.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
                        cx,
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
                <h4 class="card-title">Lịch Sử Tăng Like</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id">#</th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="sl">Hoàn Thành</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_likecmt' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_likecmt' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                                    $sv = $ro['nse'];
                            ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="sl"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                        <td class="user"><?php echo $sv; ?></td>
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
require('../_System/end.php');
?>