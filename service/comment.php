<?
$page = 'cmt_fb';
require_once('../_System/db.php');
$title = "Tăng Comment Facebook";
require_once('../_System/head.php');
require_once('../module/baostar.php');
switch ($_GET['act']) {
    default:
        $gia = $gia1;
        $min = '20';
        $max = '5000';
        $qcmt = $gia2;
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
            $sv = mysqli_real_escape_string($db, $_POST['sv']);
            if ($sv == '2') {
                $cmt = $_POST['sl'];
                $qu = explode("\n", $cmt);
                $qua = json_encode($qu);
                $b = count($qu);
                $tongtien = $b * $qcmt;
                if (empty($id)) {
                    echo "<script>swal('OOPS!','Vui lòng nhập Link hoặc ID Bài Viết Facebook!','warning');</script>";
                } elseif (empty($sl)) {
                    echo "<script>swal('OOPS!','Vui lòng điền nội dung Comment!','warning');</script>";
                } elseif ($b < '10') {
                    echo "<script>swal('OOPS!','Số lượng phải lớn hơn 10 Comment','warning');</script>";
                } elseif ($row['vnd'] < $tongtien) {
                    echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                } else {
                    $nd1 = 'Tăng Comment Bài Viết ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) ' . $id . ' (' . $b . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    $sve = 'Server CMT 2';
                    $cm = str_replace("\r\n", "\\n", $cmt);
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-binh-luan/buy',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
    "object_id": "' . $_POST['id'] . '",
    "package_name": "facebook_comment_sv10",
    "list_message":"' . $cm . '"
}',
                        CURLOPT_HTTPHEADER => array(
                            'api-key: MTExNjkwbm93MzgxM2ZlOGVhYjk0YjgwNDg0YzA4M2NlNA==',
                            'Content-Type: application/json'
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $send = json_decode($response);
                    if ($send->status == '200') {
                        mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Cmt',`sl` = '$b', `cmt`='$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '10', `sve`='$sve'");
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                        echo "<script>swal('Hệ Thống!','Tăng Comment Bài Viết Thành Công! Cảm ơn bạn!!','success');</script>";
                        echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                    } else {
                        echo "<script>swal('Hệ Thống!','" . $send->message . "','warning');</script>";
                        echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
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
                var sv = document.querySelector('input[name="sv"]:checked').value;
                if (sv == '1') {
                    var gia = '<?= $gia; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $qcmt; ?>';
                }
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
        <!-- thong bao -->
        <? if (!isset($_POST['add'])) { ?>
            <script>
                var sangml = document.createElement("sangml");
                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Bảo trì dich vụ cmt . Admin nhận riêng cmt tay 500đ </center></big></b>";
                swal({
                    content: sangml,
                    buttons: false
                });
            </script>
        <? } ?>
        <!--end-->

        <!--end-->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title" data-anchor="data-anchor">Tăng Comment Bài Viết</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <label>Chọn Server Comment:</label>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server CMT 1 (<b><?= $gia; ?>₫</b>) (BẢO TRÌ) </label>
                        <div class="collapse" id="sv1">
                            <div class="alert alert-danger" role="alert">Không bị giới hạn nội dung , đa số đều được auto duyệt.<br>
                                Không chạy được link share , avt , bìa , album...<br>
                                Chạy được cho fanpage, không chạy được link share, avt bìa</div>
                        </div>
                    </div>
                   <!-- <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2"><label class="form-check-label" for="flexRadioDefault1">Server CMT 2 (<b><?= $qcmt; ?>₫</b>) (Tốc độ nhanh, chạy được live , album, group)</label>
                    </div>-->


                    <div class="mb-3">
                        <label>Nhập Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Hoặc ID Bài Viết" required="" id="idbuff_like">
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
                            - Buff dư ra 30-50% tránh tụt, vì acc clone chạy có thể die trong quá trình chạy dẫn đến hụt là chuyện bình thường.<br>
                            - Cách lấy link kích vào thời gian đăng bài, kích vào hình ảnh là sai nhé<br>
                            - Vui lòng vào cài đặt => bài viết công khai => ai có thể bình luận vào bài viết của tôi bật mọi người ra trước khi cài <br>
                            - Nên soạn trước cmt rồi copy lại tránh cài lỗi bị mất nội dung <br>
                            - Admin nhận cmt tay acc thật siêu tốc, chạy được tất cả các loại . Ai cần inbox gửi riêng nhé. Sll có giá tốt.</p>

                    </div>

                    <div class="alert alert-success" role="alert">
                        <center><strong>Giá: <span id="giacmt">0</span> VNĐ / 1 CMT<br>Thành Tiền: <span id="total">0</span> VNĐ</strong></center>
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
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Cmt' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Cmt' ORDER BY id DESC LIMIT 0,1000");
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
require('../_System/end.php');
?>