<?php
$page = 'tim_tt';
require_once('../../_System/db.php');
$title = "Tăng Tim TikTok";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
require_once('../../module/vnfb.php');

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
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                } else if (sv == '4') {
                    var gia = '<?= $gia4; ?>';
                } else if (sv == '5') {
                    var gia = '<?= $gia5; ?>';
                } else if (sv == '6') {
                    var gia = '<?= $gia6; ?>';
                } else if (sv == '7') {
                    var gia = '<?= $gia7; ?>';
                } else if (sv == '8') {
                    var gia = '<?= $gia8; ?>';
                }
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("total").innerHTML = quan;
                document.getElementById("slmua").innerHTML = dz;
                document.getElementById("idbuff").innerHTML = idbuff;
            }
        </script>
        <script>
            $('input[value="1_2"]').on('click', function() {
                window.location = "like_v2.php";
            });
        </script>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Tim TikTok</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Like:</label>
                    <!-- <div class="form-check">
                      <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Like 1<i class="wi wi-time-1"></i><i class="wi wi-moon-1"></i> (<b><?= $gia1; ?>₫</b>) ( <span style="color: ;">Tim tây sale rẻ châm, đôi khi delay. Test ít thấy lên nhanh thì khuyên dùng </span>Max 50k <span style="color: red;">.</span> ) <span class="badge bg-success">Hoạt động</span></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger">  Max 50k </div>
                        </div>
                    </div>
-->
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 2 (<b><?= $gia2; ?>₫</b>) ( <span style="color: red;">Tim tây tốc độ nhanh, đôi khi delay 3h-12h không quá lâu, test ít cảm nhận </span>.Tốc độ tạm ổn 5k-10k+ / ngày <span style="color: red;">Max 50k</span> ) <span class="badge bg-success ">Lúc nhanh lúc chậm</span> </label>
                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger"> Không được đè đơn </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 3 (<b><?= $gia3; ?>₫</b>) (Tim việt , lên thiếu 20-40% , tốc độ ổn đinh nhất nên đùng, tài nguyên max 5k. Nên cài sl nhỏ lên được hãy cài tiếp )
                        </label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger">
                                + tụt có thể 20-40% hoặc có thể nhiều hơn vui lòng buff dư ra <br>
                                + Hiện tại có thể cài bằng link video hoặc link rút gọn từ điện thoại
                            </div>
                        </div>
                    </div>-->
                    <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv4" /><label class="form-check-label" for="flexRadioDefault1">Server Like 4 (<b><?= $gia4; ?>₫</b>) (<span style="color: red;">Tim việt đang nhanh thường lên ngay ổn định sl nhỏ nên dùng</span> , dự kiến 1k-3k+ / ngày <span style="color: red;"></span>. Cài bằng link máy tính <span style="color: red;">Max 20k </span> ) <span class="badge bg-success ">Đơn cũ hoàn thành mới được cài đơn mới</span> </label>
                        </label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv4">
                            <div class="accordion-body alert alert-danger">
                                + Hiện tại có thể cài bằng link video hoặc link rút gọn từ điện thoại
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv5" aria-expanded="false" aria-controls="sv5" /><label class="form-check-label" for="flexRadioDefault1">Server Like 5 (<b><?= $gia5; ?>₫</b>) (Dùng bằng link lấy trên máy tính , Tim tây lên nhanh đôi khi delay, 5k-10k / ngày. <span style="color: red;">Max 50k </span>. )
                        </label>
                        <div id="sv5" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv5">
                            <div class="accordion-body alert alert-danger">
                                - Tốc nhanh 5k - 10k like / ngày, tài nguyên max 50k like, không bảo hành.
                            </div>
                        </div>
                    </div> -->
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="6" data-bs-toggle="collapse" data-bs-target="#sv6" aria-expanded="false" aria-controls="sv6" /><label class="form-check-label" for="flexRadioDefault1">Server Like 6 (<b><?= $gia6; ?>₫</b>) (<span style="color: red;">Tim tây nhanh 10k-30k / ngày thích hợp chạy sll, max 10k 1 lần cài </span> Đôi khi delay 1-3 ngày ko thể can thiệp.  Hạn chế chia nhỏ tránh lỗi <span style="color: red;"></span><span style="color: red;">Max 60k </span> )
                        </label>
                        <div id="sv6" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv6">
                            <div class="accordion-body alert alert-danger">
                                * Không thể hủy/dừng đơn .
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="7" data-bs-toggle="collapse" data-bs-target="#sv7" aria-expanded="false" aria-controls="sv7" /><label class="form-check-label" for="flexRadioDefault1">Server Like 7 (<b><?= $gia7; ?>₫</b>) (<span style="color: red;">Tim Việt tốc độ trung bình, </span> Max 5k 1 lần cài <span style="color: red;">Max 100k </span> ) <span class="badge bg-warning ">Trung Bình</span>
                        </label>
                        <div id="sv7" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv7">
                            <div class="accordion-body alert alert-danger">
                                * Không thể hủy/dừng đơn .
                            </div>
                        </div>
                    </div>
                     <!-- <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="8" data-bs-toggle="collapse" data-bs-target="#sv8" aria-expanded="false" aria-controls="sv8" /><label class="form-check-label" for="flexRadioDefault1">Server Like 8 (<b><?= $gia8; ?>₫</b>) (<span style="color: red;">Tim tây </span> Tốc độ đang thử nghiệm sẽ cập nhật sau <span style="color: blude;">test ít lên ổn thì dùng nhé ) </span><span class="badge bg-danger">Đang theo dõi tốc độ đơn cũ để cập nhật</span> </span> 
                        </label>
                        <div id="sv8" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv8">
                            <div class="accordion-body alert alert-danger">
                                * Lúc nhanh lúc chậm, đôi khi delay
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <a href="like_v2.php">Server Tim Sale <i class="wi wi-time-1"></i><i class="wi wi-moon-1"></i> (Tim tây sale, bắt đầu lên từ 3p - 15p. Rất ít delay. Tốc độ 300-1k / 1h . Quá 1h chưa lên inbox hỗ trợ đẩy gấp trước 1 ít )</a> <span class="badge bg-success">Bấm vào để chuyển kênh</span></label>
                    </div> -->
                    <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                    <label>Nhập ID Hoặc Link Video:</label>
                    <div class="input-group mb-3">
                        <input type="text" oninput="getTym('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link hoặc nhập ID!" required="" id="idbuff_like">

                    </div>
                    <div id="detailServer">
                    </div>

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Chú Ý:</strong><br>
  <p>
</p>
</div>-->
                    <!-- thong bao -->
                    <!-- <? if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Bảo trì update get id , nếu lỗi thử lại sau 15p </big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <? } ?>-->
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - <mark style="color:red;"><strong>Định Dạng nhập link : Link rút gọn ở đt hoặc link máy tính đều được.</strong></mark> <br>
                        - Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
                        - Vui Lòng Đợi Đơn Cũ Mới Được Cài Đơn mới , Cố tình chia nhỏ spam cùng lúc nhiều sv lên thiếu hụt không xử lý <br>
                        - Hệ thống k hỗ trợ check số lượng đã tăng vui lòng xem thực tế ở ngoài <br>
                        - Nếu khách hàng cố tình đổi Username trong quá trình Buff sẽ không được hoàn tiền<br>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Tim Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Cách Tính Giá: Giá x Số Like
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
                    url: "/api/buy/tiktok/like.php",
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

                <h4 class="card-title">Lịch Sử Tăng Tim TikTok</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="sl">LIKE GỐC</th>
                                <th class="sort" data-sort="goc">Đã Tăng (Tim Hiện Tại)</th>
                                <th class="sort" data-sort="goc">Server BUFF</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_like' ORDER BY id DESC LIMIT 0,3000");
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
                                        <td class="goc"><b><?php echo $ro['done']; ?></b><br>(Update Lúc: <?= date('H:i:s - d/m', $ro['timeup']); ?>)</td>
                                        <td class="goc"><?php echo $ro['nse']; ?></td>
                                        <td class="profile"><a href="https://www.tiktok.com/@tiktok/video/<?php echo $ro['profile']; ?>"><?php echo $ro['profile']; ?></a></td>
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