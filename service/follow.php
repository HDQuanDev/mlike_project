<?

$page = 'follow_fb';
require_once('../_System/db.php');
$title = "Tăng Follow Facebook";
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
         <? if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Bảo trì dịch vụ follow </big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <? } ?>  -->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Follow Facebook</h4>
                <form method="POST">
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server Follow 1 (<b><?= $gia1; ?>₫</b>) (Sub beta dạng mới gần như không tụt, yêu cầu tắt chế độ chuyên nghiệp)</label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger"> Dạng follow mới ( ngày lên done 500k sub) <br>
                                6 tháng trở lại đây gần như ko tụt. Tương lai tùy fb quét ko thể biết trước <br>
                                *** lưu ý : khi ấn vào sẽ không check được người theo dõi chỉ hiện người theo dõi cũ <br>
                                vui lòng test trước khi cài <br>
                                *** Vui lòng đơn thành công rồi buff tiếp</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nhập ID Profile Facebook:</label>
                        <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập nguyên link" required="" id="idbuff_like">
                    </div>
                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Chú Ý:</strong><br>
              <p>
            </p>
            </div>-->

                    <div class="mb-3">
                        <label>Số Lượng Follow Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Follow..." name="sl" value="" required="">
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
                            - 1 ID KHÔNG CÀI 2 ĐƠN CÙNG LÚC TRONG HỆ THỐNG ! ĐƠN CŨ XONG MỚI CÀI ĐƠN MỚI . CỐ TÌNH CÀI BỊ HỤT SỐ LƯỢNG SẼ KHÔNG XỬ LÝ ! ( Xem trực tiếp sub ở ngoài đủ chưa hãy cài tiếp ) <br>
                            - Nếu ID đang chạy trên hệ thống MLIKE mà bạn vẫn mua id đó cá hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lí!<br>
                        </p>
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
                    url: "/api/buy/facebook/follow.php",
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

                <h4 class="card-title">Lịch Sử Tăng Follow </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">Follow Gốc</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="profile">Server</th>
                                <th class="sort" data-sort="done">Đã Tăng</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Sub' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Sub' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="goc"><?php echo $ro['idgd']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="profile"><?php echo $ro['nse']; ?></td>
                                        <td class="done"><?php echo $ro['done']; ?></td>
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
