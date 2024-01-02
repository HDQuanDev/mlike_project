<?
$page = 'share_fb';
require_once('../_System/db.php');
require_once('../_System/config.php');
$title = "Tăng Share Facebook";
require_once('../_System/head.php');
require_once('../module/tds.php');
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
                } else if (sv == '5') {
                    var gia = '<?= $gia5; ?>';
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
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Share Bài Viết</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Share:</label>
                    <div class="form-check">
                        <input class="form-check-input" checked="checked" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Share 1 (<b><?= $gia1; ?>₫</b>) (Share clone có hiện acc. Max 1k. )<span class="badge bg-success">Nhanh</span></label>
                    </div>
                    <!-- <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Share 2 (<b><?= $gia2; ?>₫</b>)(Share ảo, có thể hiện acc, ko hỗ trợ video, live ) <span class="badge bg-danger">Bảo trì</span> </label>
                    </div> -->
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv4" /><label class="form-check-label" for="flexRadioDefault1">Server Share 3 (<b><?= $gia3; ?>₫</b>) (Share thật min 10 có chạy đc live ib riêng , duyệt tay vui lòng đợi xử lý trong 24h)<span class="badge bg-success">Chất lượng</span> </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" <? if ($sv4 == 'off') {
                                                            echo 'disabled';
                                                        } ?> id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv4" /><label class="form-check-label" for="flexRadioDefault1">Server Share 4 (<b><?= $gia4; ?>₫</b>) (Share ảo chỉ hiện số lượng, min 50k - Max không giới hạn <span style="color: red;">KHÔNG CHẠY VIDEO / LIVE. </span>Tốc độ hoàn thành trong 24h ) <? if ($sv4 == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<span class="badge bg-danger">Đang đóng</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<span class="badge bg-success">Đang mở</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?></label> </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" <? if ($sv4 == 'off') {
                                                            echo 'disabled';
                                                        } ?> id="flexRadioDefault1" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv5" /><label class="form-check-label" for="flexRadioDefault1">Server Share 5 (<b><?= $gia5; ?>₫</b>) ( Share ảo chỉ hiện số lượng, min 1k - Max không giới hạn <span style="color: red;">KHÔNG CHẠY VIDEO / LIVE. </span>Tốc độ hoàn thành trong 24h) <? if ($sv4 == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<span class="badge bg-danger">Đang đóng</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<span class="badge bg-success">Đang mở</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?></label> </label>
                    </div>
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link bài viết hoặc nhập ID!" required="" id="idbuff_like">
                        </div>
                    </div>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Chú Ý:</strong><br>
                        <p>
                            <?= $s['tbshare']; ?>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label>Số Lượng Share Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Share..." name="sl" value="" required="">

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
                    url: "/api/buy/facebook/share.php",
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
                <h4 class="card-title">Lịch Sử Tăng Share </h4>
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
                                <th class="sort" data-sort="sl">Hoàn Thành</th>
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Share' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Share' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                                    $svv = $ro['nse'];
                                    if ($svv == 4) {
                                        $sv = 'Server Share 3';
                                    } else {
                                        $sv = $svv;
                                    }
                            ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="profile"><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                        <td class="sl"><?php echo $ro['done']; ?></td>
                                        <td><?= $sv; ?></td>
                                        <td><?= $ro['user']; ?></td>
                                        <td class="tt"><?php trangthai($tt); ?></td>
                                        <?
                                        if ($ro['nse'] == 'Server Share 4' || $ro['nse'] == 'Server Share 5') {
                                            if ($tt == '7') {
                                                echo '<td><form><input id="id_order_' . $ro["id"] . '" value="' . $ro['id'] . '" type="hidden"><input id="token" value="' . $row['token'] . '" type="hidden"><button type="button" id="button_' . $ro["id"] . '" class="btn btn-primary btn-rounded" onclick="huy_order_' . $ro["id"] . '()">Hủy & Hoàn Tiền</button></form></td>';
                                            } else {
                                                echo '<td>NULL</td>';
                                            }
                                        } else {
                                            echo '<td>NO CONTROL</td>';
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
                                                url: "/api/buy/facebook/share.php?act=cancel_order",
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
