<?php
$page = 'save_tt';
require_once('../../_System/db.php');
$title = "Tăng Save TikTok";
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Save TikTok</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server:</label>
                    <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Save 1<i class="wi wi-time-1"></i><i class="wi wi-moon-1"></i> (<b><?= $gia1; ?>₫</b>) ( Min 50, bắt đầu từ 1h-72h, giá rẻ không ổn định tốc độ. Lỗi không hỗ trợ ) <span class="badge bg-success">Hoạt động</span></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger"> - Bắt đầu 0-1 giờ. Tốc độ 5k/ngày.<br>
                                - Giá rẻ ko ổn định về tốc độ. </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        <label>Nhập ID Hoặc Link Video:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getTym('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link hoặc nhập ID!" required="" id="idbuff_like">

                        </div>
                        
                    </div>

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Chú Ý:</strong><br>
  <p>
</p>
</div>-->
                    <!-- thong bao -->
                    <!--<? if (!isset($_POST['add'])) { ?>
                        <script>
                            var sangml = document.createElement("sangml");
                            sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Đang update mở sv mới , mọi người kiên nhẫn chờ đợi </center></big></b>";
                            swal({
                                content: sangml,
                                buttons: false
                            });
                        </script>
                    <? } ?>-->
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - <mark style="color:red;"><strong>Định Dạng nhập link : Link rút gọn ở đt hoặc link máy tính đều được.</strong></mark> <br>
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
                    url: "/api/buy/tiktok/save.php",
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

                <h4 class="card-title">Lịch Sử Tăng Save TikTok</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">Server BUFF</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'save_tt' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'save_tt' ORDER BY id DESC LIMIT 0,1000");
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