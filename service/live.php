<?
$page = 'live_fb';
require_once('../_System/db.php');
$title = "Tăng Mắt Livestream";
require_once('../_System/head.php');
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
                var sv = document.querySelector('input[name="sv"]:checked').value;
                var gift = document.getElementById("gift").value;
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '4') {
                    var gia = '<?= $gia4; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '5') {
                    var gia = '<?= $gia5; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '6') {
                    var gia = '<?= $gia6; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '7') {
                    var gia = '<?= $gia7; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '8') {
                    var gia = '<?= $gia8; ?>';
                    $("#phut")
                        .prop("disabled", false);
                } else if (sv == '9') {
                    var gia = '<?= $gia9; ?>';
                    $("#phut")
                        .prop("disabled", true)
                        .val("30");
                } else if (sv == '10') {
                    var gia = '<?= $gia10; ?>';
                    $("#phut")
                        .prop("disabled", true)
                        .val("60");
                } else if (sv == '11') {
                    var gia = '<?= $gia11; ?>';
                    $("#phut")
                        .prop("disabled", true)
                        .val("90");
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
                  <!--      <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Live 1 (<b><?= $gia1; ?>₫</b>) (Máy chủ VIP) </label>
                        <div class="collapse" id="sv1">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 2 (<b><?= $gia2; ?>₫</b>) (Máy chủ thử nghiệm) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled did="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 3 (<b><?= $gia3; ?>₫</b>) (Máy chủ thường) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 4 (<b><?= $gia4; ?>₫</b>) (Máy chủ rẻ) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>
                   
                    <div class="form-check">
                        <input class="form-check-input"  disabled id="flexRadioDefault1" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 5 (<b><?= $gia5; ?>₫</b>) (ổn định nhất , ít quá tải vào buổi tối) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div> 

                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="6" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 6 (<b><?= $gia6; ?>₫</b>) (ổn định nhất , lên ngay - Nên dùng) </label>
                        <div class="collapse" id="sv6">
                        </div>
                    </div>
                    <div class="form-check"> -->
                        <input class="form-check-input" checked  id="flexRadioDefault1" type="radio" name="sv" value="7" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 7 (<b><?= $gia7; ?>₫</b>) (Chú ý chỉ nhập ID LÀ SỐ , mắt dao động 70-120%) ( Quá 4p chưa lên inbox hỗ trợ ) </label>
                        <div class="collapse" id="sv6">
                        </div>
                    </div> 
                  <!--     <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="8" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 8 (<b><?= $gia8; ?>₫</b>) (Chú ý chỉ nhập ID LÀ SỐ , mắt dao động 70-120%) ( LỖI KHÔNG HỖ TRỢ )</label>
                        <div class="collapse" id="sv6">
                        </div>
                    </div>   
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="9" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 9 ( VIP ) (<b><?= $gia9; ?>₫</b>) (ỔN ĐỊNH ĐẶT LỊCH TRƯỚC ADMIN CHỪA SLOT) </span> <span class="badge bg-success">INBOX ĐẶT LỊCH ADMIN TRƯỚC</span></label> 
                        <div class="collapse" id="sv6">
                        </div>
                    </div> -->
                  <!--  <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="10" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 10 ( VIP ) (<b><?= $gia10; ?>₫</b>) (Chú ý chỉ nhập Link có chữ VIDE, Loại 60P , Ổn định không tụt mắt) </span> <span class="badge bg-success">MỞ KHÔNG GIỚI HẠN</span></label>
                        <div class="collapse" id="sv6">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="11" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Live 11 ( VIP ) (<b><?= $gia11; ?>₫</b>) (Chú ý chỉ nhập Link có chữ VIDE, Loại 90P, Ổn định không tụt mắt) </span> <span class="badge bg-success">MỞ KHÔNG GIỚI HẠN</span></label>
                        <div class="collapse" id="sv6">
                        </div>
                    </div> -->
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
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Mắt..." name="sl" value="" required="">
                        <label>(!) Số mắt phải trong khoảng 50 đến 2000 mắt</label>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Phút Muốn Xem:</label>
                        <input type="number" id="phut" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Phút..." name="phut" value="" required="">
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
                            - Hệ thống sẽ tăng từ 90% - 120% SỐ LƯỢNG ĐÃ ĐẶT (Máy chủ VIP) <br>
                            - Hệ thống sẽ tăng từ 80% - 120% SỐ LƯỢNG ĐÃ ĐẶT (Máy chủ thường) <br>
                            - Hệ thống sẽ tăng từ 70% - 120% SỐ LƯỢNG ĐÃ ĐẶT (Máy chủ rẻ) <br>
                            - Hệ thống sẽ tăng từ 60% - 120% SỐ LƯỢNG ĐÃ ĐẶT (Máy chủ thử nghiệm) <br>
                            - Cần mua sll inbox để có giá tốt, bao lên giờ cao điểm.

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
                    url: "/api/buy/facebook/live.php",
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
                                <th class="sort" data-sort="goc">Mắt Gốc</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="sv">Server Live</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'mat' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'mat' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="goc"><?php echo $ro['start']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="sv"><?php echo $ro['sv']; ?></td>
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
