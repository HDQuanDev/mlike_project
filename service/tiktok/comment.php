<?
$page = 'cmt_tt';
require_once('../../_System/db.php');
$title = "Tăng Comment TikTok";
require_once('../../_System/head.php');
include('../../module/tds.php');
switch ($_GET['act']) {
    default:
        $gia = $gia1;
        $min = '10';
        $max = '200';
?>

        <?php
        if (isset($_POST['add']) && isset($login)) {
           
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $sl = mysqli_real_escape_string($db, $_POST['sl']);
            $cmt = $_POST['sl'];
            $quan = explode("\n", $cmt);
            $b = count($quan);
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
                $qua = json_encode($quan);
                $nd1 = 'Tăng Comment TikTok ID:';
                $bd = $tongtien;
                $gt = '-';
                $idgd = '' . $id . ' (' . $b . ')';
                $goc = $row['vnd'];
                $time = time();
                $user = $s['user'];
                $pass = $s['pass'];
                $login_tds = json_decode(login($user, urlencode($pass)));
                if ($login_tds->success == 'true') {
                    $date_create =  date("Y-m-d H:i:s");
                    $send_api = send_tds_ttcmt(trim($id), trim($b), '', $date_create, $qua);
                    usleep(1000);
                    if (strpos($send_api, 'nh công') !== false) {
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                        mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'cmt_tt',`sl` = '$b', `cmt`='$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '$b', `sttdone` = '1'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                        echo "<script>swal('Hệ Thống!','Tăng Comment TikTok Thành Công! Cảm ơn bạn!!','success');</script>";
                        echo '<script>setTimeout(function(){
                            window.location="' . $url . '";
                        }, 3000);</script>';
                    } else {
                        echo "<script>swal('OOPS!','Đã xảy ra lỗi không xác định, vui lòng liên hệ Admin hoặc Chát với Support góc dưới màn hình!','warning');</script>";
                    }
                } else {
                    echo "<script>swal('OOPS!','Lỗi server comment vui lòng thử lại sau!','warning');</script>";
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
<!-- thong bao -->
                    <? if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Tiktok ẩn cmt nên rất khó chạy, dịch vụ chỉ mở thử nghiệm giá rẻ,ngày chỉ lên 1-2 cmt hoặc không lên. Cân nhắc trươc khi dùng </big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <? } ?>  
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Comment TikTok</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <div class="mb-3">
                        <label>Nhập ID Video:</label>
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
                        <strong>Lưu Ý: </strong> <br>
                        - Không chạy được nội dung có dấu <br>
                        - Có thể bị trùng nội dung trong khi chạy nên nhập nội dung càng nhiều thì tỉ lệ random ít bị trùng lập hơn nhé . Tối thiểu 10 cmt<br>
                        - Tốc độ cực chậm ngày 1-2 cái. Nên cài 10 cmt lên được hãy cài tiếp. Ko hỗ trợ hủy đơn <br>
                        - Dịch vụ đang trong giai đoạn thử nghiệm có thể không ổn định 
                        <p>

                        </p>

                    </div>

                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <?= $gia1; ?> VNĐ / 1 CMT<br>Thành Tiền: <span id="total">0</span> VNĐ</strong></center>
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
                                <th class="sort" data-sort="sv">Server CMT</th>
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
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'cmt_tt' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'cmt_tt' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="sv"><?php echo $ro['sve']; ?></td>
                                        <td class="done"><?php echo $ro['done']; ?></td>
                                        <td class="profile"><?php echo $ro['profile']; ?></td>
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