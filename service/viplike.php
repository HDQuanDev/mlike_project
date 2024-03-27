<?php
$page = 'viplike_fb';
require_once('../_System/db.php');
$title = "Mua Vip Like Facebook";
require_once('../_System/head.php');
require_once('../module/tds.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
        $min = '50';
        $max = '2000';
        ?>

        <?php
                if ($_GET['del'] == 'ok' && $_GET['user'] && $_GET['id']) {
                    $id = $_GET['id'];
                    $user = $_GET['user'];
                    $cc = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_viplike' AND `user` = '$login' AND `id` = '$id'");
                    $c = mysqli_fetch_assoc($cc);
                    $ccc = mysqli_num_rows($cc);
                    if ($ccc == 1) {
                        mysqli_query($db, "DELETE FROM `dv_other` WHERE `dv` = 'fb_viplike' AND `user` = '$login' AND `id` = '$id'");
                        echo "<script>swal('Hệ Thống!','Xoá ID Thành Công! ','success');</script>";
                        echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 1500);</script>';
                    } else {
                        echo "<script>swal('Hệ Thống!','Rất tiếc chưa thể xử lý yêu cầu của bạn, vui lòng liên hệ Admin!','error');</script>";
                        echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 1500);</script>';
                    }
                }
        if (isset($_POST['add']) && isset($login)) {

            $id = mysqli_real_escape_string($db, $_POST['id']);
            $sl = mysqli_real_escape_string($db, $_POST['sl']);
            $day = mysqli_real_escape_string($db, $_POST['day']);
            if ($sl == 50 || $sl == 100 || $sl == 150 || $sl == 200 || $sl == 300 || $sl == 400 || $sl == 500 || $sl == 600 || $sl == 700 || $sl == 800 || $sl == 900 || $sl == 1000 || $sl == 1500 || $sl == 2000 && $day == 7 || $day == 15 || $day == 30 || $day == 60 || $day == 90) {
                $tongtien = $gia * $sl * $day;
                if (empty($id)) {
                    echo "<script>swal('OOPS!','Vui lòng nhập số ID cần mua VIPLIKE!','warning');</script>";
                } elseif (empty($sl)) {
                    echo "<script>swal('OOPS!','Vui lòng chọn số lượng!','warning');</script>";
                } elseif (empty($day)) {
                    echo "<script>swal('OOPS!','Vui lòng chọn số ngày!','warning');</script>";
                } elseif ($sl < $min) {
                    echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');</script>";
                } elseif ($sl > $max) {
                    echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . "','warning');</script>";
                } elseif ($row['vnd'] < $tongtien) {
                    echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                } else {
                    $user = $s['user'];
                    $pass = $s['pass'];
                    $login_tds = json_decode(login($user, urlencode($pass)));
                    if ($login_tds->success == 'true') {
                        $date_create =  date("Y-m-d H:i:s");
                        $send_api = send_tds_viplike($id, '', $date_create, $day, $sl);
                        if (strpos($send_api, 'nh công') !== false) {
                            $nd1 = 'Mua VIPLIKE Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $day . ' Ngày) ' . $id . ' (' . $sl . ') (' . $bv . '/Ngày)';
                            $goc = $row['vnd'];
                            $time = time();
                            $day = ($day * 24 * 60 * 60) + $time;
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_viplike',`sl` = '$sl', `trangthai` = '3', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '$day', `nse` = '$bv', `idgd` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            echo "<script>swal('Hệ Thống!','Mua VIPLIKE Thành Công! Cảm ơn bạn!!','success');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        } else {
                            echo "<script>swal('OOPS!','Lỗi ID, Vui Lòng Kiểm Tra Lại, Nếu Vẫn Không Được Vui Lòng Liên Hệ Admin!','warning');</script>";
                        }
                    } else {
                        echo "<script>swal('OOPS!','Đã xảy ra lỗi hệ thống','warning');</script>";
                    }
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
                var day = document.getElementById("day").value;
                var gia = document.getElementById("gia").value;

                var tien = sl * gia * day;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("total").innerHTML = quan;
                document.getElementById("slmua").innerHTML = dz;
                document.getElementById("idbuff").innerHTML = idbuff;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Mua VIPLIKE Facebook</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <input id="gia" oninput="calc()" type="hidden" value="<?= $gia; ?>">
                    <div class="mb-3">
                        <label>Nhập ID Hoặc Link:</label>
                        <div class="input-group mb-3">
                            <input type="text" onpaste="getUID('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập ID!" required="" id="idbuff_like">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning" id="get" type="button">GET ID</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Chọn Số Lượng Like:</label>
                        <select class="form-select mb-3" onchange="calc()" id="sl" name="sl" required>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                            <option value="600">600</option>
                            <option value="700">700</option>
                            <option value="800">800</option>
                            <option value="900">900</option>
                            <option value="1000">1000</option>
                            <option value="1500">1500</option>
                            <option value="2000">2000</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Số ngày mua VIPLIKE:</label>
                        <select name="day" id="day" onchange="calc()" class="form-select mb-3" required>
                            <option value="7">7</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="60">60</option>
                            <option value="90">90</option>
                        </select>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Chú Ý:</strong><br>
                        - Chạy được cho cả fanpage và fb cá nhân <br>
                        - Đăng bài cách nhau 10-20p sẽ chạy đỡ bị sót bài nhé.<br>
                        - Gần như 99% không chạy được cho avt , bìa.<br>
                        - Cài xong có thể không báo hoàn thành, check ở lịch sử mua đơn bên dưới chữ thanh toán để kiểm tra nhận đơn chưa nhé <br>
                        - Những id sử dụng vip like sẽ không được buff thêm ở sv1. Có thể mua thêm ở các sv khác.<br>
                        <p>
                        </p>
                    </div>

                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?= $gia; ?>₫<br>Cách Tính Giá: (Số Ngày Mua VIP) x (Số Like / Bài Viết) x (Giá)
                                <hr> Thành Tiền: <span id="total">0</span> VNĐ
                            </strong></center>
                    </div>
                    <center>
                        <button type="submit" name="add" class="btn btn-success btn-rounded me-1 mb-1"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">

                <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>

            </div>
        </div>
    <?php
        break;
    case 'history':
        ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">

                <h4 class="card-title">Lịch Sử Mua VIPLIKE</h4>
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
                                <th class="sort" data-sort="date">Hết Hạn</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                if ($row['rule'] == 99) {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_viplike' ORDER BY id DESC LIMIT 0,1000");
                                } else {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_viplike' ORDER BY id DESC LIMIT 0,1000");
                                }
        if ($result1) {
            while ($ro = mysqli_fetch_assoc($result1)) {
                $tt = $ro['trangthai'];
                $t = $ro['time'];
                if ($tt == '5') {
                    //| <a class="badge badge rounded-pill badge-soft-success mb-3" href="?user='.$ro['user'].'&id='.$ro['id'].'&del=ok">Xoá ID</a>
                    $gh = '';
                } else {
                    $gh = '';
                }
                ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
                                        <td class="sv"><?php echo date('Y-m-d H:i:s', $ro['sve']); ?></td>
                                        <td class="user"><?php echo $ro['user']; ?></td>
                                        <td class="tt"><?php trangthai($tt); ?> <?= $gh; ?></td>
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