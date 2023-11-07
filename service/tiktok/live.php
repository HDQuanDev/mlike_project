<?php
$page = 'live_tt';
require_once('../../_System/db.php');
$title = "Mua Mắt Livestream TikTok";
require_once('../../_System/head.php');
require_once('../../module/autofbpro.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
        $min = '1000000';
        $max = '50000';
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
                var tg = document.getElementById("tg").value;
                var gia = document.getElementById("gia").value;
                var tien = sl * gia * tg;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("total").innerHTML = quan;
                document.getElementById("slmua").innerHTML = dz;
                document.getElementById("idbuff").innerHTML = idbuff;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Mua Mắt Livestream TikTok</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <input id="gia" oninput="calc()" type="hidden" value="<?= $gia; ?>">
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link hoặc nhập ID!" required="" id="idbuff_like">

                        </div>
                        <!--<label style="font-size:18px;">Hướng dẫn Lấy id <a href="https://findids.net/" target="_blank">Tại đây</a></label>-->
                    </div>
                    <div class="form-group">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số" name="sl" value="" required="">
                    </div>

                    <div class="mb-3">
                        <label>Thời gian duy trì mắt:</label>
                        <select class="form-select mb-3" onchange="calc()" id="tg" name="tg" required>
                            <option value="30">30 phút</option>
                            <option value="60">60 phút</option>
                            <option value="90">90 phút</option>
                            <option value="120">120 phút</option>
                            <option value="180">180 phút</option>
                            <option value="240">240 phút</option>
                        </select>
                    </div>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Chú Ý:</strong><br>
                       - Link mẫu: https://www.tiktok.com/@username/live?enter_from_merge=others_homepage&enter_method=others_photo
                       - Mắt xem sẽ tăng sau từ 2-7 phút sau khi thanh toán!<br>
                       - Nếu hệ thống có vấn đề hãy chụp ảnh livestream kèm THỜI GIAN và gửi cho hỗ trợ <br>
                       - 1 ID KHÔNG CÀI 2 ĐƠN CÙNG LÚC TRONG HỆ THỐNG ! ĐƠN CŨ XONG MỚI CÀI ĐƠN MỚI ! CỐ TÌNH CÀI BỊ HỤT SỐ LƯỢNG SẼ KHÔNG XỬ LÝ !<br>
                       - Nếu ID đang chạy trên hệ thống MLIKE mà bạn vẫn mua id đó cá hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lí!<br>
                       - Nghiêm cấm đổi Username trong quá trình Buff Mắt Tiktok.<br>
                       - Nếu khách hàng cố tình đổi Username trong quá trình Buff Mắt Tiktok, sẽ KHÔNG được hoàn tiền.<BR>
                       - Mắt xem sẽ tăng sau từ 2-7 phút sau khi thanh toán!<br>
                        <p>
                        </p>
                    </div>

                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?= $gia; ?>₫<br>Cách Tính Giá: (Số Lượng) x (Thời Gian) x (Giá)
                                <hr> Thành Tiền: <span id="total">0</span> VNĐ
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
        <? if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> BẢO TRÌ DỊCH VỤ VUI LÒNG KHÔNG SỬ DỤNG</big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <? } ?>
        <script>
            function send_order() {
                var id = $('#idbuff_like').val();
                var sl = $('#sl').val();
                var phut = $('#tg').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/tiktok/live.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sl,
                        phut,
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

                <h4 class="card-title">Lịch Sử Mua Mắt Livestream</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">Thời Gian BUFF</th>
                                <th class="sort" data-sort="goc">Hoàn Thành</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tt_live' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tt_live' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="goc"><?php echo $ro['nse']; ?></td>
                                        <td class="sv"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
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