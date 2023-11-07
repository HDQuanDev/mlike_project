<?php
require_once('../../_System/db.php');
$title = "Tăng Tim Sản Phẩm Shopee";
require_once('../../_System/head.php');
require_once('../../module/autofbpro.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = '50';
        $min = '100';
        $max = '2000';
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
                $secret   = '6LeOmxcaAAAAACHVlh3lcvCFNaCyb19iZgoeRVtW';
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
            if ($response->success==true && $response->score <= 0.5) {
                echo "<script>swal('Bảo Mật!','Lỗi Hệ Thống, Vui Lòng Load Lại Trang Và Thử Lại!!','warning');</script>";
                exit('<script>setTimeout(function(){
window.location="' . $url . '";
}, 3000);</script>'); 
            }
                    $id = mysqli_real_escape_string($db, $_POST['id']);
                    $sl = mysqli_real_escape_string($db, $_POST['sl']);
                    $tongtien = $sl * $gia;
                    if (empty($id)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Link sản phẩm cần tăng Tim','warning');</script>";
                    } elseif (empty($sl)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập số lượng!','warning');</script>";
                    } elseif ($sl < $min) {
                        echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');</script>";
                    } elseif ($sl > $max) {
                        echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . " 1 lần ( Có thể order nhiều lần )!','warning');</script>";
                    } elseif ($row['vnd'] < $tongtien) {
                        echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                    } else {
                        $buff = shopee("$id", "$sl", "like");
                        $buff = json_decode($buff);
                        if ($buff->status == 200) {
                            $nd1 = 'Tăng Tim SP Shopee ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'shopee_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            echo "<script>swal('Hệ Thống!','Tăng Tim Thành Công! Cảm ơn bạn!!','success');</script>";
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
                <h5 class="card-title" data-anchor="data-anchor">Tăng Tim SP Shopee</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <input id="gia" oninput="calc()" type="hidden" value="<?= $gia; ?>">
                    <div class="mb-3">
                        <label><b> CÁCH LẤY LINK NHƯ HÌNH BÊN DƯỚI </b></label>
                        <hr><img class="img-fluid rounded" src="https://i.imgur.com/DG9l67z.png" alt="" />
                        <hr class="md-1">
                        <label><b>Nhập Link Sản Phẩm:</b></label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link!" required="" id="idbuff_like">
                        </div>
                        <!--<label>(*) Nếu nhập <code>link</code> vui lòng ấn vào <code>"GET ID"</code></label>-->
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
                        - Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó cá hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
                        - Nếu khách hàng cố tình đổi Username trong quá trình Buff sẽ không được hoàn tiền<br>
                    </div>
                    <div class="mb-3">
                        <label><b>Số lượng tim muốn mua:</b></label>
                        <input type="number" id="sl" oninput="calc()" class="form-control" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?= $gia; ?> ₫ / 1 Tim<br>Cách Tính Giá: Giá x Số Tim
                                <hr>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong></center>
                    </div>
                    <center>
                        <button type="submit" name="add" class="btn btn-success btn-rounded me-1 mb-1" id="loading"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>
            </div>
        </div>
    <?
        break;
    case 'history':
    ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title" data-anchor="data-anchor">Lịch Sử Tăng Tim SP</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar" id="history" data-list='{"valueNames":["id","time","sl","goc","profile","tt","user"],"page":10,"pagination":true}'>
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="goc">Đã Tăng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'shopee_like' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'shopee_like' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                            ?>
                                    <tr>
                                        <td class="id"><b><?= $ro['id']; ?></b></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="goc"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
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