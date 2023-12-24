<?
$page = 'fb_feeling';
require_once('../_System/db.php');
$title = "Tăng Cảm Xúc Facebook";
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
                var idbuff = document.getElementById("idbuff_like").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                var gift = document.getElementById("gift").value;
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                }

                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;
                <?
                 $gt = time();
                 $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '$site' AND `ex` > '$gt'");
                 while ($ro = mysqli_fetch_assoc($result1)) {
                     ?>
                if(gift == '<?=$ro['code'];?>'){
                    var dis = '<?=$ro['dis'];?>';
                   
                }
                <?}?>
              
                var giam = (sl * gia) - ((sl * gia) * dis / 100);
                var dz = giam.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("giamgia").innerHTML = dz;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Cảm Xúc Bài Viết</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Cảm Xúc:</label>
                    <div class="form-check">
                        <input class="form-check-input"    ="checked" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Cảm Xúc 1 (<b><?= $gia1; ?>₫</b>) <span class="badge bg-success">ổn định</span>( Tốc độ nhanh )</label></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"  checked id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Cảm Xúc 2 (<b><?= $gia2; ?>₫</b>) <span class="badge bg-danger">Trung bình</span> ( Lỗi cảm xúc thương thương ) </label>
                    </div>
                    <div class="form-group">
                        <label>Nhập ID Hoặc Link Bài Viết:</label>
                        <div class="input-group mb-3">
                        <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Hoặc ID Bài Viết" required="" id="idbuff_like">
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
                            - Chọn loại cảm xúc trươc khi mua, đợi lên xong mới mua cảm xúc khác, không cài cùng lúc tránh xung đột có thể xảy ra lỗi.<br>
                            - Xem trực tiếp số lượng ở ngoài , hệ thống không hỗ trợ check <br>
                            - Sv1 lên nhanh , chuẩn số lượng , chạy được album ,không hỗ trợ reel , Max 30k<br>
                            - Sv2 lên trung bình, có thể dư nhiều, thích hợp mua 1 loại cảm xúc, không chạy được album , Max 5k <br>

                    </div>
                    <div class="form-group">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Like" name="sl" value="" required="">
                    </div>
                    <div class="form-group">
                        <label>Chọn loại cảm xúc</label>
                        <select class="form-select" aria-label="Default select example" id="cx" required="">
                            <option selected="">Vui lòng chọn loại cảm xúc</option>
                            <option value="care">Care</option>
                            <option value="love">Love</option>
                            <option value="haha">Haha</option>
                            <option value="wow">Wow</option>
                            <option value="sad">Sad</option>
                            <option value="angry">Angry</option>
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
                        <strong>Giảm Giá: <span id="giamgia">0</span> VNĐ</strong></center>
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
                    url: "/api/buy/facebook/like_feeling.php",
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
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_feeling' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_feeling' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                                    $svv = $ro['nse'];
                                    if ($svv == 2) {
                                        $sv = 'Server Cảm Xúc 1';
                                    } else {
                                        $sv = $ro['nse'];
                                    }
                            ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
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
