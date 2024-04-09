<?php

$page = 'view_ytb';

require_once('../../_System/db.php');
$title = "Tăng View YouTube";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
        $min = '1000';
        $max = '5000000';
        $api = new Api();
        ?>

        <?php
                if (isset($_POST['add']) && isset($login)) {

                    $id = mysqli_real_escape_string($db, $_POST['id']);
                    $sl = mysqli_real_escape_string($db, $_POST['sl']);
                    $sv = mysqli_real_escape_string($db, $_POST['sv']);
                    if ($sv == 1 || $sv == 2 || $sv == 3) {
                        if ($sv == 1) {
                            $tongtien = $sl * $gia;
                            $nse = 'Server View 1';
                            $min = 10000;
                        } elseif ($sv == 2) {
                            $tongtien = $sl * $gia2;
                            $nse = 'Server View 2';
                            $min = 25000;
                        } elseif ($sv == 3) {
                            $tongtien = $sl * $gia3;
                            $nse = 'Server View 3';
                            $min = 5000;
                        }
                        if (empty($id)) {
                            echo "<script>
                                function sayHello() {
                                    swal('OOPS!','Vui lòng nhập Link cần tăng Subscribe!','warning');
                                }
                                setTimeout(sayHello, 500);</script>";
                        } elseif (empty($sl)) {
                            echo "<script>
                                function sayHello() {
                                    swal('OOPS!','Vui lòng nhập số lượng!','warning');
                                }
                                setTimeout(sayHello, 500);</script>";
                        } elseif ($sl < $min) {
                            echo "<script>
                    function sayHello() {
                        swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');
                    }
                    setTimeout(sayHello, 500);</script>";
                        } elseif ($sl > $max) {
                            echo "<script>
                    function sayHello() {
                        swal('Cảnh Báo','Số lượng tối đa " . $max . " 1 lần ( Có thể order nhiều lần )!','warning');
                    }
                    setTimeout(sayHello, 500);</script>";
                        } elseif ($row['vnd'] < $tongtien) {
                            echo "<script>
                    function sayHello() {
                        swal('OOPS!','Bạn không đủ tiền!','warning');
                    }
                    setTimeout(sayHello, 500);</script>";
                        } else {
                            if ($sv == 1) {
                                $order = $api->order(array('service' => 1811, 'link' => '' . $id . '', 'quantity' => $sl));
                            } elseif ($sv == 2) {
                                $order = $api->order(array('service' => 1776, 'link' => '' . $id . '', 'quantity' => $sl));
                            } elseif ($sv == 3) {
                                $order = $api->order(array('service' => 1778, 'link' => '' . $id . '', 'quantity' => $sl));
                            }
                            //$buff = json_decode($order);
                            if (isset($order)) {
                                $nd1 = 'Tăng View YouTube ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ytb_view',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '$sl', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                echo "<script>
                                function sayHello() {
                                    swal('Hệ Thống!','Tăng Thành Công! Cảm ơn bạn!!','success');
                                }
                                setTimeout(sayHello, 500);</script>";
                                echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                            } else {
                                echo "<script>swal('OOPS!','" . $buff->message . "','warning');</script>";
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
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                }
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng View YouTube</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <label>Chọn Server View:</label>
                    <div class="form-check">
                        <input class="form-check-input"=""  checked id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server View 1 (<b><?= $gia; ?>₫</b>) (Tốc độ 100k - 200k, xịn nhất nên dùng ib để dự kiến tốc độ  , Bảo hành 60 ngày , min 25k  ) </label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger">
                                - Bắt đầu trong 1h-24h<br> </div>
                        </div>
                        <div class="collapse" id="sv1">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server View 2 (<b><?= $gia2; ?>₫</b>) (Tốc độ 20k-50k view / ngày . Min 20k . Bảo hành 30 ngày) </label>
                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger"> Min: 25k - Max: 10 M.<br>- View chất lượng cao <br>- Thời gian khởi động : 12-24h mới bắt đầu lên <br>- Bảo hành 30 ngày </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server View 3 (<b><?= $gia3; ?>₫</b>) (Tốc độ 10k-100k / ngày, Bảo hành 30 ngày, min 100) </label>
                        <div id="sv3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger"> Thời gian bắt đầu: 0-1h</div>
                        </div>
                        <div class="collapse" id="sv3">
                        </div>
                    </div> 

                    <div class="mb-3">
                        <label>Nhập Link Video YouTube:</label>
                        <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - View nguồn từ đa quốc gia <br>
                        - Loại view này sẽ ổn định và không tụt hoặc tụt rất ít khi youtube không quét hoặc không thay đổi thuật toán, tuy nhiên nếu youtube quét lớn view sẽ giảm tốc độ và gặp sự cố tụt nhanh. <br>
                        - 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
                        - Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
                        - Hệ thống chỉ bảo hành khi view tụt dưới số view đã mua <br>
                    </div>
                    <!--<label style="font-size:18px;">Hướng dẫn Lấy id  <a href="https://findids.net/username-to-id-tiktok" target="_blank">Tại đây</a></label>
             </div>-->

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Chú Ý:</strong><br>
              <p>
            </p>
            </div>
                <div class="alert alert-warning" role="alert">
              <strong>Lưu ý:</strong><br>
            - Tốc độ tăng nhanh, người dùng việt thật đang hoạt động <br>
            - 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
            - Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
            - Có thể trong lúc chạy có thể like hoặc sub bị tụt vui lòng buff dư thêm 20 - 40% trên tổng số lượng để tránh tụt vì acc lấy ra chạy có thể bị checkpoint trong khi chạy ! <br>
            - Nếu khách hàng cố tình đổi Username trong quá trình Buff sẽ không được hoàn tiền<br>-->
                    <div class="mb-3">
                        <label>Số Lượng Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Cách Tính Giá: Giá x Số Lượng
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
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                if ($row['rule'] == 99) {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ytb_view' ORDER BY id DESC LIMIT 0,1000");
                                } else {
                                    $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ytb_view' ORDER BY id DESC LIMIT 0,1000");
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
                                        <td class="profile"><?php echo $ro['nse']; ?></td>
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