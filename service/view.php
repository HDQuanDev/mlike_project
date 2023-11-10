<?
$page = 'view_fb';
require_once('../_System/db.php');
require_once('../_System/config.php');
$title = "Tăng View Video";
require_once('../_System/head.php');
switch ($_GET['act']) {
    default:
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
                var td = document.querySelector('input[name="sv"]:checked').value;
                var idbuff = document.getElementById("idbuff_like").value;
                if (td < 3) {
                    if (td == 1) {
                        var aq = 1;
                    } else {
                        var aq = 1.5;
                    }
                    var gia = <?= $gia; ?>;
                    var tien = sl * gia * aq;
                    $("#sl")
                        .prop("disabled", false);
                } else if (td == 3) {
                    var gia = <?= $gia2; ?>;
                    var tien = sl * gia;
                    $("#sl")
                        .prop("disabled", false);
                } else if (td == 4) {
                    var gia = <?= $gia3; ?>;
                    var tien = sl * gia;
                    $("#sl")
                        .prop("disabled", false);
                } else if (td == 5) {
                    var gia = <?= $gia4; ?>;
                    var tien = sl * gia;
                    $("#sl")
                        .prop("disabled", false);
                } else if (td == 6) {
                    var gia = <?= $gia5; ?>;
                    var tien = sl * gia;
                    $("#sl")
                        .prop("disabled", false);
                } else if (td == 7) {
                    var gia = <?= $gia6; ?>;
                    var tien = 600000 * gia;
                    $("#sl")
                        .prop("disabled", true)
                        .val("600000");
                } else if (td == 8) {
                    var gia = <?= $gia7; ?>;
                    var tien = 60000 * gia;
                    $("#sl")
                        .prop("disabled", true)
                        .val("60000");
                }
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;
            }
        </script>
        <!-- thong bao-->
        <!-- <? if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Facebook đang quét tốc độ view có thể chậm hơn dự kiến</big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <? } ?>-->
        <!--end-->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng View Video Facebook</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Tốc Độ View/Server View:</label>
                    <?php
                    /* <div class="form-check">
                        <input class="form-check-input"  type="radio" name="td" value="1" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Tốc độ thường <span style="color: Blue;"> [Dự kiến hoàn thành từ 12h-24h]<span style="color:red;"> <?= $gia1; ?>₫</span> <span class="badge bg-success">Hoạt động</span>
                        </label><br>
                      <span class="text-danger">Số đơn hàng khả dụng: <span id="view_count_1"><?= check_view(1); ?></span></span>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" checked  type="radio" name="td" value="2" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Tốc độ nhanh <span style="color: Blue;">[Dự kiến hoàn thành từ 1h-6h ] <span style="color:red;"><?= $gia1 * 1.5; ?>₫</span> <span class="badge bg-success">Hoạt động</span></span>
                        </label><br>
                     <span class="text-danger">Số đơn hàng khả dụng: <span id="view_count_2"><?= check_view(2); ?></span></span>
                    </div> */ ?>
                    <!-- <div class="form-check">
                        <input class="form-check-input"  disabled type="radio" name="sv" value="3" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server view 3 <span style="color: Blue;">[View 3s] [Tốc độ thường , dự kiến 10k-20k / ngày ] </span> <span style="color:red;">[Chạy được Reel] </span> <span style="color:Blue;"><?= $gia2; ?>₫</span> <? if ($sv3  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                    echo '<span class="badge bg-danger">Quá tải </span>';
                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                    echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                                } ?>
                        </label>
                    </div> -->
                    <div class="form-check">
                        <input class="form-check-input" checked type="radio" name="sv" value="4" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server View 4 <span style="color:Blue;">[View 3s] [Tốc độ trung bình, bắt đầu lên từ 3h-24h, dự kiến 30k-100k/ngày,ib hỗ trợ lên ngay đơn từ 5k trở lên ]</span> <span style="color:red;">[Chạy được Reel] </span> <span style="color:Blue;"><?= $gia3; ?>₫ </span> <? if ($sv4  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                } ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sv" value="5" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server View 5 <span style="color:Blue;">[View 3s] [ Tốc độ ưu tiên, tốc độ 100k-300k/ngày, ib hỗ trợ lên ngay đơn từ 2k trở lên )</span> <span style="color:red;">[Chạy được Reel] </span> <span style="color:Blue;"><?= $gia4; ?>₫ </span> <? if ($sv5  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                            <!--    </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sv" value="6" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server View 6 <span style="color:red;">[100k view reel play]</span> <span style="color:Blue;">[Tốc độ dự kiến hoàn thành 24h-72h] </span> <span style="color:red;"><?= $gia5; ?>₫ </span> <? if ($sv6  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                        } ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sv" value="7" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server View 7 <span style="color:red;">[600k phút]</span> <span style="color:Blue;">[Yêu cầu video trên 180 phút ] [Tốc độ dự kiến hoàn thành 6h-24h ] </span> <span style="color:red;"><?= $gia6; ?>₫ </span> <? if ($sv7  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sv" value="8" id="td" oninput="calc()" /><label class="form-check-label" for="flexRadioDefault1"> Server View 8 <span style="color:red;">[60k phút]</span> <span style="color:Blue;">[Yêu cầu video trên 180 phút ] [Tốc độ dự kiến hoàn thành 1h-12h ] </span> <span style="color:red;"><?= $gia7; ?>₫ </span> <? if ($sv8  == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                echo '<span class="badge bg-success">Hoạt động</span>';
                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                        </label> -->
                    </div>
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link Video:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Video hoặc nhập ID!" required="" id="idbuff_like">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info rounded-10 shadow-lg border-0 mt-3"><span style="color: red;">
                            (*) Dùng máy tính kích vào video để lấy link, link phải có chữ video . Lấy trên điện thoại sẽ không chạy được nhé. <br>
                            * Link chuẩn có dạng : </span><br>
                        https://www.facebook.com/xxxxxxxx/videos/xxxxxxxx <br>
                        https://www.facebook.com/watch/live/?v=xxxxxxxx
                    </div>

                    <div class="mb-3">
                        <label>Số Lượng View Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số View..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu Ý:</strong><br>
                        <p> - Có hỗ trợ link ở điện thoại, nhập nguyên link vào nhé. Tốt nhất vẫn nên dùng link chuẩn theo hướng dẫn bên trên <br>
                            - Không chạy được video trong nhóm, event ,... <br>
                            - Tốc độ trên chỉ là dự kiến, có thể nhanh hoặc chậm hơn tùy vào đơn hàng hệ thống. Chúng tôi đánh giá cao về sự kiên nhẫn của bạn. <br>
                            - <span style="color:red;"> 1 ID KHÔNG CÀI 2 ĐƠN CÙNG LÚC TRONG HỆ THỐNG ! ĐƠN CŨ XONG MỚI CÀI ĐƠN MỚI ! CỐ TÌNH CÀI BỊ HỤT SỐ LƯỢNG SẼ KHÔNG XỬ LÝ ! HOÀN THÀNH = GỐC + SỐ MUA </span> <br>
                            - Nếu ID đang chạy trên MLike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lí! <br>
                            - KHÔNG HOÀN TIỀN đối với id sai định dạng video , id đang chạy mà die giữa chừng hoặc không công khai. <br>

                    </div>


                    <div class="alert alert-success" role="alert">
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong>
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
            setInterval(function() {
                $('#view_count_1').load('/api/viewfb.php?sv=1');
            }, 60000)
        </script>
        <script>
            setInterval(function() {
                $('#view_count_2').load('/api/viewfb.php?sv=2');
            }, 60000)
        </script>
        <script>
            function send_order() {
                var id = $('#idbuff_like').val();
                var sl = $('#sl').val();
                var sv = $("input[name='sv']:checked").val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/facebook/view.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sl,
                        sv,
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
                <h4 class="mb-0">Lịch Sử Tăng View Video Facebook</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">View Gốc</th>
                                <th class="sort" data-sort="done">View Đã Tăng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                                <th class="sort" data-sort="tt">Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'view' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `user` = '" . $login . "' AND `dv` = 'view' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="done"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="profile"><?php echo $ro['sv']; ?></td>
                                        <td class="user"><?php echo $ro['user']; ?></td>
                                        <td class="tt"><?php trangthai($tt); ?></td>
                                        <?php
                                        if ($tt == '7') {
                                            echo '<td><form><input id="id_order_' . $ro["id"] . '" value="' . $ro['id'] . '" type="hidden"><input id="token" value="' . $row['token'] . '" type="hidden"><button type="button" id="button_' . $ro["id"] . '" class="btn btn-primary btn-rounded" onclick="huy_order_' . $ro["id"] . '()">Hủy & Hoàn Tiền</button></form></td>';
                                        } else {
                                            echo '<td>NULL</td>';
                                        }
                                        ?>
                                    </tr>
                                    <script>
                                        function huy_order_<?= $ro["id"]; ?>() {
                                            var id_order = $('#id_order_<?= $ro["id"]; ?>').val();
                                            var token = $('#token').val();
                                            $('#button_<?= $ro["id"]; ?>')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                                            $("#button_<?= $ro["id"]; ?>")
                                                .prop("disabled", true);
                                            $.ajax({
                                                url: "/api/buy/facebook/view.php?act=cancel_order",
                                                type: "post",
                                                dataType: "json",
                                                data: {
                                                    id_order,
                                                    token,
                                                },
                                                success: function(response) {
                                                    if (response.status === 'success') {
                                                        swal('Hệ Thống!', response.msg, 'success');
                                                    } else {
                                                        swal('Hệ Thống!', response.msg, 'warning');
                                                        $("#button_<?= $ro["id"]; ?>")
                                                            .prop("disabled", false)
                                                    }
                                                    $('#button_<?= $ro["id"]; ?>')['html']('Hủy & Hoàn Tiền');
                                                }
                                            });
                                        }
                                    </script>
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
