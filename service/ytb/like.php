<?php
$page = 'like_ytb';
require_once('../../_System/db.php');
$title = "Tăng Like Video YouTube";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
        $min = '100';
        $max = '5000000';
        $api = new Api();
        ?>

        <?php
                if (isset($_POST['add']) && isset($login)) {
                    if (isset($_POST['g-recaptcha-response'])) {
                        $captcha = $_POST['g-recaptcha-response'];
                    } else {
                        $captcha = false;
                    }
                    if (!$captcha) {
                        echo "<script>swal('Bảo Mật!','Lỗi Bảo Mật, Vui Lòng Load Lại Trang Và Thử Lại!!','warning');</script>";
                        exit('<script>setTimeout(function(){
window.location="' . $url . '";
}, 3000);</script>');
                    } else {
                        $secret   = '6Ldz7YwhAAAAAFnYKoYSR1IBjI8pWLeZ6paOGIS2';
                        $response = file_get_contents(
                            "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
                        );
                        $response = json_decode($response);
                        if ($response->success === false) {
                            echo "<script>swal('Bảo Mật!','Phát Hiện Robot, Vui Lòng Load Lại Trang Và Thử Lại!!','warning');</script>";
                            exit('<script>setTimeout(function(){
    window.location="' . $url . '";
    }, 3000);</script>');
                        }
                    }
                    if ($response->success == true && $response->score <= 0.5) {
                        echo "<script>swal('Bảo Mật!','Lỗi Hệ Thống, Vui Lòng Load Lại Trang Và Thử Lại!!','warning');</script>";
                        exit('<script>setTimeout(function(){
window.location="' . $url . '";
}, 3000);</script>');
                    }
                    $id = mysqli_real_escape_string($db, $_POST['id']);
                    $sl = mysqli_real_escape_string($db, $_POST['sl']);
                    $tongtien = $sl * $gia;
                    if (empty($id)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Link cần tăng Like!','warning');</script>";
                    } elseif (empty($sl)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập số lượng!','warning');</script>";
                    } elseif ($sl < $min) {
                        echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');</script>";
                    } elseif ($sl > $max) {
                        echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . " 1 lần ( Có thể order nhiều lần )!','warning');</script>";
                    } elseif ($row['vnd'] < $tongtien) {
                        echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                    } else {
                        $order = $api->order(array('service' => 516, 'link' => '' . $id . '', 'quantity' => $sl));
                        //$buff = json_decode($order);
                        if (isset($order)) {
                            $nd1 = 'Tăng Like Video YouTube ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ytb_like',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '$sl', `sotien` = '$tongtien', `done` = '$sl'");
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Like Video YouTube</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <input id="gia" oninput="calc()" type="hidden" value="<?= $gia; ?>">
                    <div class="mb-3">
                        <label>Nhập Link YouTube:</label>
                        <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - 💗Ưu điểm: Chất lượng cao, tốc độ cao, giữ like tốt.<br>
                        - 💗Nhược điểm: Quy mô 200k like/ngày, do vậy nếu hết tài nguyên đơn hàng like sẽ tự động dừng và chúng tôi sẽ nạp lại tài nguyên trong vòng 6h<br
                        - Khuyến nghị: Với từ khóa thông thường bạn nên chạy từ 500 like trở lên hoặc đặt dò số lượng like để biết được lượng like mà từ khóa cần để tạo đề xuất<br>
                        - Đặt bội số của 50<br>
                        - Like từ user thật<br>
                        - Chất lượng cao, bảo hành 30 ngày<br>
                        - Tốc độ 1k-10k/ngày<br>
                        - Chú ý: Dịch vụ này có thể không tự động chuyển trạng thái khi hoàn thành, vì vậy bạn hãy kiểm tra số like thực tế
                    </div>
                    <div class="mb-3">
                    </div>
                    <label>Số Lượng Muốn Mua:</label>
                    <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
            </div>
            <div class="alert alert-success" role="alert">
                <center><strong>Giá: <?= $gia; ?> ₫ / 1 <br>Cách Tính Giá: Giá x Số Lượng
                        <hr>Thành Tiền: <span id="total">0</span> VNĐ
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
                                <th class="sort" data-sort="user">Người Mua</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                if ($row['rule'] == 99) {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ytb_like' ORDER BY id DESC LIMIT 0,1000");
                                } else {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ytb_like' ORDER BY id DESC LIMIT 0,1000");
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
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=buy" class="btn btn-primary">Quay Lại Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>

            </div>
        </div>
<?php
        break;
}
require('../../_System/end.php');
?>