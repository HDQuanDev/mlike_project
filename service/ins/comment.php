<?
$page = 'cmt_ig';
require_once('../../_System/db.php');
$title = "Tăng Comment Instagram";
require_once('../../_System/head.php');
include('../../module/tlc.php');
switch ($_GET['act']) {
    default:
        $gia = $gia1;
        $min = '20';
        $max = '5000';
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
                    $id = mysqli_real_escape_string($db, $_POST['id']);
                    $sl = mysqli_real_escape_string($db, $_POST['sl']);
                    $cmt = $_POST['sl'];
                    $qu = explode("\n", $cmt);
                    $qua = json_encode($qu);
                    $b = count($qu);
                    $tongtien = $b * $gia;
                    if (empty($id)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Link hoặc ID Bài Viết Instagram!','warning');</script>";
                    } elseif (empty($sl)) {
                        echo "<script>swal('OOPS!','Vui lòng điền nội dung Comment!','warning');</script>";
                    } elseif ($b < $min) {
                        echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . " Comment','warning');</script>";
                    } elseif ($b > $max) {
                        echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . " Comment 1 lần ( Có thể order nhiều lần )!','warning');</script>";
                    } elseif ($row['vnd'] < $tongtien) {
                        echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                    } else {
                        $nd1 = 'Tăng Comment Instagram ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(1) ' . $id . ' (' . $b . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $cm = preg_replace('/\r\n?/', "\n", $cmt);
                        $send_api = cmt_ins_tlc('' . $id . '', '' . $b . '', '' . $cm . '');
                        $send = json_decode($send_api);
                        if ($send->success == true) {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'cmt_ig',`sl` = '$b', `cmt`='$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '5', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            echo "<script>swal('Hệ Thống!','Tăng Comment Bài Viết Thành Công! Cảm ơn bạn!!','success');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        } else {
                            echo "<script>swal('OOPS!','" . $send->message . "','warning');</script>";
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
                var sv = document.querySelector('input[name="sv"]:checked').value;
                var gia = '<?= $gia; ?>';
                var t = 0;
                var q = sl.split('\n');
                var c = q.length;
                for (i = 0; i < c; i++) {
                    var t = t + 1;
                }
                var sl = t;
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                var dz = sl.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("total").innerHTML = quan;
                document.getElementById("giacmt").innerHTML = gia;
                document.getElementById("slmua").innerHTML = dz;
                document.getElementById("idbuff").innerHTML = idbuff;
            }
        </script>

        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Comment Ínstagram</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <div class="mb-3">
                        <label>Nhập Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link bài viết" required="" id="idbuff_like">
                            <div class="input-group-append">

                            </div>
                        </div>
                        <label>
                            <h5> <span style="color: red;">(*) Vui Lòng Đọc Lưu Ý trước khi dùng tránh mất tiền</span></h5>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label>Nhập Nội Dung Comment (Mỗi 1 dòng tương ứng với 1 comment):</label>
                        <textarea type="text" id="sl" oninput="calc()" class="form-control mb-3" rows="7" placeholder="Nhập nội dung comment, mỗi một dòng tương ứng với 1 comment
xin vui lòng không sử dụng kí tự đặc biệt hoặc icon để tránh lỗi, cảm ơn!" name="sl" required=""></textarea>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu Ý:</strong><br>
                        <p>
                            - Số lượng tăng tối thiểu 10 và tối đa 50.000. Nên tạo số lượng nhỏ để Test trước khi tăng.<br>
                            - Hãy tăng dư để đảm bảo đủ số lượng cho khách hàng, tránh khi bị Instagram ẩn Comment. <br>
                            - Hệ thống sử dụng các tài khoản 99% các tài khoản Tên Việt và có Avatar để tăng tương tác.<br>
                            - Một Object Id chỉ được phép tạo tối đa 30 lần để tránh Spam hệ thống.<br>
                            - Hệ thống chạy tương tác chéo giữa các User và auto nên sẽ có tỉ lệ tụt nhất định. <br>
                            - Không hỗ trợ hủy đơn và hoàn Xu tất cả các đơn đã mua Comment vì thuật toán Instagram ẩn hiện Comment bất thường.</p>

                    </div>

                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?=$gia1;?> VNĐ / 1 CMT<br>Thành Tiền: <span id="total">0</span> VNĐ</strong></center>
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
                <h4 class="card-title">Lịch Sử Tăng Comment</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="done">Đã Tăng</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="nd">Nội Dung Comment</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'cmt_ig' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'cmt_ig' ORDER BY id DESC LIMIT 0,1000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $cmt = $ro['cmt'];
                                    $t = $ro['time'];
                            ?>
                                    <tr>
                                        <td class="id"><?= $ro['id']; ?></td>
                                        <td class="time"><?php echo time_func($t); ?></td>
                                        <td class="sl"><?php echo $ro['sl']; ?></td>
                                        <td class="done"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                        <td class="nd"><?php echo limit_text($cmt, 10); ?></td>
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