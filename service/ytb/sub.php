<?php

$page = 'sub_ytb';

require_once('../../_System/db.php');
$title = "Tăng Subscribe YouTube";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
require_once('../../module/autofbpro.php');
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
                    $sv = mysqli_real_escape_string($db, $_POST['sv']);
                    if ($sv == 1 || $sv == 2) {
                        if ($sv == 1) {
                            $tongtien = $sl * $gia;
                            $nse = 'Server Sub 1';
                        } elseif ($sv == 2) {
                            $tongtien = $sl * $gia2;
                            $nse = 'Server Sub 2';
                        }
                    if (empty($id)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Link cần tăng Subscribe!','warning');</script>";
                    } elseif (empty($sl)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập số lượng!','warning');</script>";
                    } elseif ($sl < $min) {
                        echo "<script>swal('OOPS!','Số lượng phải lớn hơn " . $min . "','warning');</script>";
                    } elseif ($sl > $max) {
                        echo "<script>swal('Cảnh Báo','Số lượng tối đa " . $max . " 1 lần ( Có thể order nhiều lần )!','warning');</script>";
                    } elseif ($row['vnd'] < $tongtien) {
                        echo "<script>swal('OOPS!','Bạn không đủ tiền!','warning');</script>";
                    } else {
                        if($sv == 1){
                        $order = $api->order(array('service' => 751, 'link' => '' . $id . '', 'quantity' => $sl));
                        //$buff = json_decode($order);
                        if (isset($order)) {
                            $nd1 = 'Tăng Subscribe YouTube ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '('.$sl.') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ytb_sub',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '$sl', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            echo "<script>swal('Hệ Thống!','Tăng Thành Công! Cảm ơn bạn!!','success');</script>";
                            echo '<script>setTimeout(function(){
                                  window.location="' . $url . '";
                                  }, 3000);</script>';
                        } else {
                            echo "<script>swal('OOPS!','" . $buff->message . "','warning');</script>";
                        }
                    }elseif($sv == 2){
                            $quan = youtube("'.$id.'", "'.$sl.'");
                            $q = json_decode($quan);
                            if($q->status == 200){
                                $nd1 = 'Tăng Subscribe YouTube ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '('.$sl.') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ytb_sub',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '$sl', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
                                echo "<script>swal('Hệ Thống!','Tăng Thành Công! Cảm ơn bạn!!','success');</script>";
                                echo '<script>setTimeout(function(){
                                      window.location="' . $url . '";
                                      }, 3000);</script>';
                            } else {
                                echo "<script>swal('OOPS!','" . $q->message . "','warning');</script>";
                            }
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
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng Subscribe YouTube</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <input type="hidden" name="action" value="validate_captcha">
                    <label>Chọn Server View:</label>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Sub 1 (<b><?= $gia; ?>₫</b>) (Tốc độ 100 - 200 sub/ngày ) </label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger">  <div class="panel-description">💗 Ưu điểm: An toàn 100%, tốc độ nhanh, giải quyết nhanh  nếu gặp trục trặc, không tụt hoặc tụt rất ít<br><br>( Chạy trên 10 kênh inbox hỗ trợ để có giá ưu đãi tốt nhất thị trường )<br>💗 Đặc điểm:<br>- YÊU CẦU KÊNH CÓ ÍT NHẤT 1 VIDEO TRỞ LÊN<br>- Sub chất lượng cao có thể kèm view, like và các tương tác tới kênh.<br>- Xử lý trong 0-1h ( 1-24h nếu quá tải )<br>- Tốc độ hiện tại 30 - 40 sub/ngày<br>- Bảo hành 30 ngày kể từ khi hoàn thành<br>- Hỗ trợ hủy theo yêu cầu<br>- Nếu tự ý ẩn sub, đổi tên kênh, kênh die thì hệ thống sẽ tự động báo hoàn thành<br><br>MỞ CÔNG KHAI SUB<br>ĐẶT LINK KÊNH: https://www.youtube.com/channel/xxxxxxx hoặc https://youtube.com/user/1020968 <br>------------------<br>Xin lưu ý: Nếu trong quá trình chạy sub mà số sub ban đầu bị tụt bất thường, tụt dưới bộ đếm của hệ thống sub hoặc chúng tôi phát hiện kênh chạy ở nguồn cung cấp khác thì đơn hàng đó sẽ không được bảo hành. <br>VD:<br>- Ban đầu: 100 sub<br>- Chạy 200 sub<br>Nhưng kênh tụt còn 50 sub.</div>   </div>
                        </div>  
                        <div class="collapse" id="sv1">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled  id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Sub 2 (<b><?= $gia2; ?>₫</b>) ( Tốc độ 500-1k / ngày) </label>
                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger">  - SUb đến từ nhiều quốc gia, tốc độ: 500 - 1000/ngày , từ 0-24h bắt đầu chạy kể từ lúc mua, có thể kèm view và tương tác ,bảo hành: Không tụt, bảo hành 30 ngày ,SUB đến từ người dùng thật , bật kiếm tiền được 100%!  </div>
                        </div>
                    </div><br>
                    <div class="mb-3">
                        <label>Nhập Link YouTube:</label>
                        <input type="text" oninput="calc()" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        💗 Đặc điểm:<br>
                        - YÊU CẦU KÊNH CÓ ÍT NHẤT 1 VIDEO TRỞ LÊN<br>
                        - Sub chất lượng cao có thể kèm view, like và các tương tác tới kênh.<br>
                        - Xử lý trong 0-1h ( Nếu quá tải xử lý trong 1-24h )<br>
                        - Nếu tự ý ẩn sub, đổi tên kênh, kênh die thì hệ thống sẽ tự động báo hoàn thành
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
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ytb_sub' ORDER BY id DESC LIMIT 0,1000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'ytb_sub' ORDER BY id DESC LIMIT 0,1000");
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