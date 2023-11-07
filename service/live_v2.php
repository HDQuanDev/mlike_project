<?
$page = 'live_fb_v2';
require_once('../_System/db.php');
$title = "Tăng Mắt Livestream V2";
require_once('../_System/head.php');
require_once('../module/autofbpro.php');

$min = '50';
$max = '2000';
$gia = $gia1; //mã giảm giá, nếu không có điền quandz


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
                var phut = document.getElementById("phut").value;
                var idbuff = document.getElementById("idbuff_like").value;
                var gift = document.getElementById("gift").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                var gia = '<?= $gia; ?>';
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                }
                var tien = sl * gia * phut;
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

                var giam = (sl * gia * phut) - ((sl * gia * phut) * dis / 100);
                var dz = giam.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("giamgia").innerHTML = dz;
            }
        </script>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Mắt Livestream Facebook</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Live:</label>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Live 1 (<b><?= $gia; ?>₫</b>) ( Tốc độ lên nhanh, ổn định tối thường quá tải )</label>
                        <div class="collapse" id="sv1">
                            <div class="alert alert-danger" role="alert"></div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"    id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 2 (<b><?= $gia2; ?>₫</b>) (Vip có thể lên thiếu 30-50%) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>  
                    <div class="form-check">
                        <input class="form-check-input"   id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server Live 3 (<b><?= $gia3; ?>₫</b>) (Thường có thể lên thiếu 40-60%) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link Livestream:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link livestream hoặc nhập ID!" required="" id="idbuff_like">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning" id="get" type="button">GET ID</button>
                            </div>
                        </div>
                        <label>(*) Nếu nhập <code>link livestream</code> vui lòng ấn vào <code>"GET ID"</code></label>
                    </div>

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Chú Ý:</strong><br>
  <p>
</p>
</div>-->

                    <div class="mb-3">
                        <label>Số Lượng Mắt Muốn Mua:</label>
                        <select class="form-select mb-3" id="sl" name="sl" oninput="calc()">
                            <option value="30">20-30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="300">300</option>
                            <option value="350">350</option>
                            <option value="400">400</option>
                            <option value="450">450</option>
                            <option value="500">500</option>
                            <option value="550">550</option>
                            <option value="600">600</option>
                            <option value="650">650</option>
                            <option value="700">700</option>
                            <option value="750">750</option>
                            <option value="800">800</option>
                            <option value="850">850</option>
                            <option value="900">900</option>
                            <option value="950">950</option>
                            <option value="1000">1000</option>
                            <option value="1050">1050</option>
                            <option value="1100">1100</option>
                            <option value="1150">1150</option>
                            <option value="1200">1200</option>
                            <option value="1250">1250</option>
                            <option value="1300">1300</option>
                            <option value="1350">1350</option>
                            <option value="1400">1400</option>
                            <option value="1450">1450</option>
                            <option value="1500">1500</option>
                            <option value="1550">1550</option>
                            <option value="1600">1600</option>
                            <option value="1650">1650</option>
                            <option value="1700">1700</option>
                            <option value="1750">1750</option>
                            <option value="1800">1800</option>
                            <option value="1850">1850</option>
                            <option value="1900">1900</option>
                            <option value="1950">1950</option>
                            <option value="2000">2000</option>
                            <option value="2050">2050</option>
                            <option value="2100">2100</option>
                            <option value="2150">2150</option>
                            <option value="2200">2200</option>
                            <option value="2250">2250</option>
                            <option value="2300">2300</option>
                            <option value="2350">2350</option>
                            <option value="2400">2400</option>
                            <option value="2450">2450</option>
                            <option value="2500">2500</option>
                            <option value="2550">2550</option>
                            <option value="2600">2600</option>
                            <option value="2650">2650</option>
                            <option value="2700">2700</option>
                            <option value="2750">2750</option>
                            <option value="2800">2800</option>
                            <option value="2850">2850</option>
                            <option value="2900">2900</option>
                            <option value="2950">2950</option>
                            <option value="3000">3000</option>
                        </select>
                        <label>(!) Số mắt phải trong khoảng 50 đến 2000 mắt</label>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Phút Muốn Xem:</label>
                        <select class="form-select mb-3" id="phut" name="phut" oninput="calc()">
                            <option value="30">30 phút</option>
                            <option value="45">45 phút</option>
                            <option value="60">60 phút</option>
                            <option value="90">90 phút</option>
                            <option value="120">120 phút</option>
                            <option value="150">150 phút</option>
                            <option value="180">180 phút</option>
                            <option value="210">210 phút</option>
                            <option value="240">240 phút</option>
                            <option value="270">270 phút</option>
                            <option value="300">300 phút</option>
                        </select>
                        <label>(!) Số phút phải trong khoảng 30p đến 1440p</label>
                    </div>
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
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu Ý:</strong><br>
                        <p>
                            - KHÔNG HOÀN TIỀN với những video / livestream KHÔNG công khai. <br>
                            - Tốc độ nhanh ổn định, ít bị quá tải. Đa số lên đủ mắt hoặc dư, nếu có tình trạng lên thiếu thì tự mua bù thêm nhé. <br>

                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong><br>
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
                var phut = $('#phut').val();
                var gift = $('#gift').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/facebook/live_v2.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
                        phut,
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

                <h4 class="card-title">Lịch Sử Tăng Mắt Livestream</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'matv2' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'mat_v2' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="user"><?php echo $ro['user']; ?></td>
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