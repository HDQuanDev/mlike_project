<?php
$page = 'page_fb';
require_once('../_System/db.php');
$title = "Tăng Like Fanpage Facebook";
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Like Fanpage</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server Like Fanpage:</label>
                    <!--    <div class="form-check">
                        <input class="form-check-input" disabled ="" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Fanpage 1 (<b><?= $gia1; ?>₫</b>) ( Like + Follow page nhanh,gửi riêng admin . Bảo hành 30 ngày) <span class="badge bg-danger">Bảo trì</span> </label>
                        <div class="collapse" id="sv1">
                        </div>
                    </div> -->
                    <div class="form-check">
                        <input class="form-check-input" checked="" id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like Page 2 (<b><?= $gia2; ?>₫</b>) ( Like + Follow page nhanh. Gần Như Ko Tụt. Min 1k - Max 20k / ID. Mua tối đa 3 lần 1 id ) <? if ($sv2 == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-danger">Đang đóng</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-success">Đang mở</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                        } ?> </label>
                        <div class="collapse" id="sv2">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Nhập Link Fanpage:</label>
                        <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập ID!" required="" id="idbuff_like">
                    </div>
                    <label>(*) Chỉ dùng <code>link fanpage</code> để buff, hệ thống tự động get id cho bạn!</label>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Chú Ý:</strong><br>
                        - Hỗ trợ page thường , page pro5 <br>
                        - Bắt đầu chạy trong vài giờ, chậm nhất trong 24h <br>
                        - 1 ID không cài 2 đơn cùng 1 lúc , đơn cũ hoàn thành mới được cài đơn mới , nếu cố ý tình cài bị hụt số lượng sẽ không xử lý <br>
                        <p>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
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
                    url: "/api/buy/facebook/page.php",
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
        if (isset($_GET['id']) && isset($_GET['user']) && isset($_GET['st']) && $row['rule'] == '99') {
            $id = $_GET['id'];
            $us = $_GET['user'];
            $st = $_GET['st'];
            $tko = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `id` = '$id' AND `trangthai` != '4'");
            $tko = mysqli_num_rows($tko);
            if ($tko == '1') {
                mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '4' WHERE `id` = '$id'");
                $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$us' AND `site` = '$site'");
                $u = mysqli_fetch_assoc($u);
                $time = time();
                $dd = $u['vnd'];
                $nd1 = 'Hoàn tiền tăng like page Facebook (#' . $id . '):';
                $gtls = '+';
                $bd = $st;
                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$us',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$st' WHERE `username` = '$us' AND `site` = '$site'");
                echo '<script>
                alert("Huy thanh cong, vui long cho load lai trang");
                setTimeout(function() {
    window.location = "/service/page.php?act=history";
},
1000);</script>';
            }
        }
    ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title">Lịch Sử Tăng Like Fanpage</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="sl">Gốc</th>
                                <th class="sort" data-sort="goc">Đã Tăng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="sv">Server</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                                <?php if ($row['rule'] == '99') {
                                    echo '<th class="sort" data-sort="tt">Chức Năng</th>';
                                }
                                ?>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_page' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_page' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="sl"><?php echo $ro['idgd']; ?></td>
                                        <td class="goc"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="sv"><?php echo $ro['nse']; ?></td>
                                        <td class="user"><?php echo $ro['user']; ?></td>
                                        <td class="tt"><?php trangthai($tt); ?></td>
                                        <?php if ($row['rule'] == '99') {
                                            if ($tt != '4' && $tt != '2') {
                                                echo '<td class="tt"><a href="?act=history&id=' . $ro['id'] . '&user=' . $ro['user'] . '&st=' . $ro['sotien'] . '">Hủy Đơn</a></td>';
                                            } else {
                                                echo '<td class="tt">NULL</td>';
                                            }
                                        }
                                        ?>
                                        <?
                                        if ($ro['nse'] == 'Server Fanpage 2') {
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
                                                url: "/api/buy/facebook/page.php?act=cancel_order",
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
