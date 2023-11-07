<?php
$page = 'view_ig';
require_once('../../_System/db.php');
$title = "Tăng View Instagram";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
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
                var idbuff = document.getElementById("idbuff_like").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                if (sv == '1') {
                    var gia = '<?= $gia; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng View Instagram</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server View:</label>
                    <div class="form-check">
                        <input class="form-check-input" checked="checked" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server View 1 (<b><?= $gia; ?>₫</b>) ( Video/Reel/TV ) </label>
                        <div class="collapse" id="sv1">
                        </div>
                    </div>
                    <!-- <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server View 2 (<b><?= $gia2; ?>₫</b>) ( Chỉ áp dụng video thường ) </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div> -->
                    <div class="mb-3">
                        <label>Nhập Link Video Instagram:</label>
                        <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        Tốc độ: 10k-100k/ngày<br>
                        <br>
                        Server 1 chạy được link : <br>
                        https://www.instagram.com/reel/ID video/ <br>
                        https://www.instagram.com/tv/ID video/ <br>
                        https://www.instagram.com/p/ID video/ <br>
                        Server 2 chạy được link :
                        https://www.instagram.com/p/ID video/ <br>
                    </div>
                    <!--<label style="font-size:18px;">Hướng dẫn Lấy id  <a href="https://findids.net/username-to-id-tiktok" target="_blank">Tại đây</a></label> 
 </div>-->

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Chú Ý:</strong><br>
  <p>
</p>
</div>
    <div class="alert alert-warning" role="alert">
  <strong>Lưu ý:</strong><br>
- Tốc độ tăng nhanh, người dùng việt thật đang hoạt động <br>
- 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
- Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
- Có thể trong lúc chạy có thể like hoặc sub bị tụt vui lòng buff dư thêm 20 - 40% trên tổng số lượng để tránh tụt vì acc lấy ra chạy có thể bị checkpoint trong khi chạy ! <br>
- Nếu khách hàng cố tình đổi Username trong quá trình Buff sẽ không được hoàn tiền<br>-->
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
            <div class="card-footer border-0 text-center py-4"> <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a></div>
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
                    url: "/api/buy/instagram/view.php",
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
                <h4 class="card-title">Lịch Sử</h4>
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
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ins_view' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ins_view' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="profile"><?php echo $ro['nse']; ?></td>
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
require('../../_System/end.php');
?>