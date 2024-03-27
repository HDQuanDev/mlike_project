<?php
$page = 'view_web';
require_once('../../_System/db.php');
$title = "Tăng Traffic Website";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
        $min = '100';
        $max = '100000';
        $api = new Api();
        ?>

        <?php
                if (isset($_POST['add']) && isset($login)) {

                    $id = mysqli_real_escape_string($db, $_POST['id']);
                    $sl = mysqli_real_escape_string($db, $_POST['sl']);
                    $tongtien = $sl * $gia;
                    if (empty($id)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Link cần tăng View TikTok!','warning');</script>";
                    } elseif (empty($sl)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập số lượng!','warning');</script>";
                    } elseif ($sl < $min) {
                        echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');</script>";
                    } elseif ($sl > $max) {
                        echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . " 1 lần ( Có thể order nhiều lần )!','warning');</script>";
                    } elseif ($row['vnd'] < $tongtien) {
                        echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                    } else {
                        $order = $api->order(array('service' => 182, 'link' => '' . $id . '', 'quantity' => $sl));
                        //$buff = json_decode($order);
                        if (isset($order)) {
                            $nd1 = 'Tăng View Website Link:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ws_view',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            echo "<script>swal('Hệ Thống!','Tăng Thành Công! Cảm ơn bạn!!','success');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        } else {
                            echo "<script>swal('OOPS!','" . $buff->message . "','warning');</script>";
                        }
                    }
                }

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
                var gia = document.getElementById("gia").value;
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Traffic Website</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <input id="gia" oninput="calc()" type="hidden" value="<?= $gia; ?>">
                    <div class="mb-3">
                        <label>Nhập Link Website:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - Chạy được link bit.ly , cuttly ,...<br>
                        - Traffic VIỆT NAM tự nhiên đến từ FACEBOOK <br>
                        - Tốc độ hiện tại hơi chậm 50-200/ ngày.
                    </div>
                    <div class="mb-3">
                        <label>Số Lượng Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?= $gia; ?> ₫ / 1 View<br>Cách Tính Giá: Giá x Số Traffic
                                <hr>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong></center>
                    </div>
                    <center>
                        <button type="submit" name="add" class="btn btn-success btn-rounded me-1 mb-1"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4"> <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a></div>
        </div>
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
                                <th class="sort" data-sort="profile">Link BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                if ($row['rule'] == 99) {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ws_view' ORDER BY id DESC LIMIT 0,1000");
                                } else {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ws_view' ORDER BY id DESC LIMIT 0,1000");
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
            <div class="card-footer border-0 text-center py-4"><a href="?act=buy" class="btn btn-primary">Quay Lại Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a></div>
        </div>

<?php
        break;
}
require('../../_System/end.php');
?>