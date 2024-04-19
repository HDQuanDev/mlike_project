<?
$page = "like_fb_v2";
require_once('../_System/db.php');
$title = "Tăng Like Facebook Kênh 2";
require_once('../_System/head.php');
include('../module/autoccv2.php');
?>

<?php
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
                } else if (sv == '4') {
                    var gia = '<?= $gia4; ?>';
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
        <!-- thong bao -->
        <!--<script>
            var sangml = document.createElement("sangml");
            sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'>KHÔNG CHẠY ĐƯỢC LINK ID DẠNG CHỮ , VUI LÒNG QUA KÊNH 1 CÓ HỖ TRỢ NHÉ</center></big></b>";
            swal({
                content: sangml,
                buttons: false
            });
        </script>-->

        <!--end-->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Like Bài Viết Kênh 2</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Like:</label>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Tốc độ cực chậm [1 lượt/phút] <span style="color: red;">[Lên thiếu 10-20%] <span style="color:blue;"><?= $gia1; ?>₫</span> <span class="badge bg-danger">Bảo trì</span></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger"> KHÔNG CHẠY ĐƯỢC BÀI VIẾT CHIA SẼ , LINK GROUP, ALBUM, AVT , BÌA </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Tốc độ trung bình [3 lượt/phút] <span style="color:red;"><?= $gia2; ?>₫</span> <span class="badge bg-success">Hoạt Động</span></label>
                    </div>
        -->
                    <div class="form-check">
                        <input class="form-check-input" disabled  id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Tốc độ thông thường [5 lượt/phút] <span style="color: red;">[Lên thiếu 10-20% ] <span style="color:reblued;"> <span style="color:blue;"><?= $gia3; ?>₫</span> <span class="badge bg-danger">Bảo trì</span></label>
                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger"> KHÔNG CHẠY ĐƯỢC BÀI VIẾT CHIA SẼ , LINK GROUP, ALBUM, AVT , BÌA </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Tốc độ nhanh [20 lượt/phút] <span style="color: red;">[Lên thiếu 10-20% ] <span style="color:blue;"><span style="color:blue;"><?= $gia4; ?>₫</span> <span class="badge bg-danger">Bảo trì</span></label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger"> KHÔNG CHẠY ĐƯỢC BÀI VIẾT CHIA SẼ , LINK GROUP, ALBUM, AVT , BÌA </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        <label>Nhập ID Hoặc Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Hoặc ID Bài Viết" required="" id="idbuff_like">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning" id="get" type="button">GET ID</button>
                            </div>
                        </div>
                        <label>(*) Nếu nhập <code>link bài viết</code> vui lòng ấn vào <code>"GET ID"</code></label><br>
                        <label>
                        </label>
                    </div>
                    <div class="mb-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Lưu Ý:</strong> <br>
                            <mark style="color:red;"><strong>- KHÔNG CHẠY ĐƯỢC BÀI VIẾT CHIA SẼ , LINK GROUP, ALBUM, AVT , BÌA</strong></mark> <Br>
                            - Thời gian khởi động tầm 15p mới bắt đầu chạy.<br>
                            - Tốc độ trên chỉ là tốc độ dự kiến, có thể nhanh hoặc chậm hơn tùy lúc. Hiện tại fb quét căng nên rất chậm <br>
                            - Trong quá trình buff có thể lên hụt 5-10% vì acc đang chạy die thì tụt trong lúc chạy là điều bình thường. <br>
                            - Đối với gói nhanh hệ thống chỉ tăng tầm 90% là nhanh 10% chạy theo tốc độ thường. Nên muốn lên nhanh chuẩn số vui lòng buff dư ra .<br>
                            - Mẹo nhỏ để tăng tốc đối với đơn số lượng lớn . Vidu đơn 3k like chia ra mua 500 1 / lần tốc độ sẽ lên cùng lúc siêu nhanh </strong><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Like" name="sl" value="" required="">
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
                var gift = $('#gift').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/facebook/likev2.php",
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
                <h4 class="card-title">Lịch Sử Tăng Like</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thời Gian</th>
                                <th>Số Lượng</th>
                                <th>Đã Tăng</th>
                                <th>ID BUFF</th>
                                <th>Tốc Độ</th>
                                <th>Người Mua</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fblike_v2' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fblike_v2' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                                    $done = $ro['done'];
                                    if ($done == 14102003) {
                                        $done = 'Không áp dụng';
                                    } else {
                                    }
                            ?>
                                    <tr>
                                        <td><?= $ro['id']; ?></td>
                                        <td><?php echo time_func($t); ?></td>
                                        <td><?php echo $ro['sl']; ?></td>
                                        <td><?php echo $done; ?></td>
                                        <td><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                        <td><?php echo $ro['nse']; ?></td>
                                        <td><?php echo $ro['user']; ?></td>
                                        <td><?php trangthai($tt); ?></td>
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
?>

<?php
require('../_System/end.php');
?>