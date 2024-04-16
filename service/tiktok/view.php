<?php
$page = 'view_tt';
require_once('../../_System/db.php');
$title = "Tăng View TikTok";
require_once('../../_System/head.php');
require_once('../../module/viewyt.php');
switch ($_GET['act']) {
    default:
        // Điều Chỉnh Giá
        $gia = $gia1;
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
                    var gia = '<?= $gia1; ?>';
                } else if (sv == '2') {
                    var gia = '<?= $gia2; ?>';
                } else if (sv == '3') {
                    var gia = '<?= $gia3; ?>';
                } else if (sv == '4') {
                    var gia = '<?= $gia4; ?>';
                } else if (sv == '5') {
                    var gia = '<?= $gia5; ?>';
                } else if (sv == '6') {
                    var gia = '<?= $gia6; ?>';
                } else if (sv == '7') {
                    var gia = '<?= $gia7; ?>';
                } else if (sv == '8') {
                    var gia = '<?= $gia8; ?>';
                } else if (sv == '9') {
                    var gia = '<?= $gia9; ?>';
                } else if (sv == '10') {
                    var gia = '<?= $gia10; ?>';
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
                <h4 class="card-title" data-anchor="data-anchor">Tăng View TikTok</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" id="token" value="<?= $row['token']; ?>">
                    <label>Chọn Server View:</label>
                
                    <div class="form-check">
                        <input class="form-check-input" Checked id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server View 1 (<b><?= $gia; ?>₫</b>) ( <span style="color: red;">Min 50k, </span> <span style="color: blue;">View thủ công , inbox để duyệt chạy nhanh hơn<span style="color: red;"> </span> ) <?php if ($sv1 == 'on') {
                            echo '<span class="badge bg-success">Hoạt động</span>';
                        } else {
                            echo '<span class="badge bg-danger">Quá tải mở lại sau</span>';
                        } ?></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv1">
                            <div class="accordion-body alert alert-danger">*Rẻ tốc độ không ổn định</div>
                        </div>
                   <!--  </div> 
                     <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server View 2 (<b><?= $gia2; ?>₫</b>) ( <span style="color: red;">Min 1k </span>.Tố độ lúc nhanh lúc chậm tùy đơn bị delay <span style="color: red;">đôi khi delay 6h-24h </span> <span style="color: red;"> </span>.rẻ có thể bị tụt tùy video. KBH) <?php if ($sv2 == 'on') {
                            echo '<span class="badge bg-warning">Trung bình</span>';
                        } else {
                            echo '<span class="badge bg-danger">Delay dự kiến done 24-48h</span>';
                        } ?></label>

                        <div id="sv2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv2">
                            <div class="accordion-body alert alert-danger">Sale tốc độ không ổn định</div>
                        </div>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server View 3 (<b><?= $gia3; ?>₫</b>) ( <span style="color: red;">Min 1k </span> Tốc độ lúc nhanh lúc chậm, test ít thấy nhanh thì dùng, <span style="color: red;"> đôi khi delay 6h-24h </span>, rẻ có thể bị tụt tùy video. KBH ) <?php if ($sv3 == 'on') {
                            echo '<span class="badge bg-success">Thử nghiệmn</span>';
                        } else {
                            echo '<span class="badge bg-danger">Bảo trì</span>';
                        } ?></label>
                        <div id="sv1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv3">
                            <div class="accordion-body alert alert-danger"> Nếu delay lâu sẽ hủy hoàn sau 7 ngày</div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" disabled id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv4" /><label class="form-check-label" for="flexRadioDefault1">Server View 4 (<b><?= $gia4; ?>₫</b>) ( <span style="color: red;">Min 1k </span> Các đơn đã cài tụt gửi admin bảo hành<span style="color: red;"> </span> <span style="color: red;">BẢO HÀNH 30 NGÀY </span> ) <span class="badge bg-danger">Bảo trì</span></label>
                        <div id="sv4" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv4">
                            <div class="accordion-body alert alert-danger">Chỉ bảo hành đối với video có gốc thấp , tránh trường hợp mua rẻ rồi qua mua bảo hành sẽ không được bảo hành</div>
                        </div>
                    </div> 
                     <div class="form-check">
                        <input class="form-check-input"    id="flexRadioDefault1" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv5" aria-expanded="false" aria-controls="sv5" /><label class="form-check-label" for="flexRadioDefault1">Server View 5 (<b><?= $gia5; ?>₫</b>) ( <span style="color: red;">Min 1k </span> Tốc độ nhanh thường lên ngay <span style="color: red;">vài giây - vài phút</span>.  Test ít để cảm nhận có bị delay hay không nhé, ổn thì dùng) <span class="badge bg-success">Hoạt động</span></label>
                        <div id="sv5" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv5">
                            <div class="accordion-body alert alert-danger">Test ít để biết có delay ko, nhanh thì dùng nhá</div>
                        </div>
                    </div> 
                  
                    <div class="form-check">
                        <input class="form-check-input"  disabled id="flexRadioDefault1" type="radio" name="sv" value="6" data-bs-toggle="collapse" data-bs-target="#sv6" aria-expanded="false" aria-controls="sv6" /><label class="form-check-label" for="flexRadioDefault1">Server View 6 (<b><?= $gia6; ?>₫</b>) ( <span style="color: red;">Min 20k </span> Tốc độ dự kiến bắt đầu từ vài giờ - 24h . Thường delay 24h ) <span class="badge bg-danger">Delay 12h-24h</span></label>
                        <div id="sv6" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv6">
                            <div class="accordion-body alert alert-danger">Nếu delay lâu sẽ hủy hoàn sau 7 ngày </div>
                        </div>
                    </div> 
                      <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1"  type="radio" name="sv" value="7" data-bs-toggle="collapse" data-bs-target="#sv7" aria-expanded="false" aria-controls="sv7" /><label class="form-check-label" for="flexRadioDefault1">Server View 7 (<b><?= $gia7; ?>₫</b>) ( <span style="color: red;">Min 1k </span> Tốc độ nhanh, view dạng mới ít tụt hoặc không tụt. Bảo hành 30 ngày ) <span class="badge bg-success">Thử nghiệm</span></label>
                        <div id="sv7" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv7">
                            <div class="accordion-body alert alert-danger">Bảo hành 30 ngày </div>
                        </div>
                    </div> 
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="8" data-bs-toggle="collapse" data-bs-target="#sv8" aria-expanded="false" aria-controls="sv8" /><label class="form-check-label" for="flexRadioDefault1">Server View 8 (<b><?= $gia8; ?>₫</b>) ( <span style="color: red;">Min 1k </span> Tốc độ nhanh dự dòng ít delay, test ít lên ổn thì dùng nhé. KBH ) <span class="badge bg-success">Thử nghiệm</span></label>
                        <div id="sv8" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv8">
                            <div class="accordion-body alert alert-danger">Không bảo hành</div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="9" data-bs-toggle="collapse" data-bs-target="#sv9" aria-expanded="false" aria-controls="sv9" /><label class="form-check-label" for="flexRadioDefault1">Server View 9 (<b><?= $gia9; ?>₫</b>) ( <span style="color: red;">Min 1k . View dạng mới ít tụt hoặc không tụt, tốc độ ổn, có nút bảo hành </span> ) <span class="badge bg-info">Bảo hành 60 Ngày</span></label>
                        <div id="sv9" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv9">
                            <div class="accordion-body alert alert-danger">Bảo hành 60 ngày </div>
                        </div>
                    </div> -
                    <div class="form-check">
                        <input class="form-check-input" checked id="flexRadioDefault1" type="radio" name="sv" value="10" data-bs-toggle="collapse" data-bs-target="#sv10" aria-expanded="false" aria-controls="sv10" /><label class="form-check-label" for="flexRadioDefault1">Server View 10 (<b><?= $gia10; ?>₫</b>) ( <span style="color: red;">Min 50k . View thủ công, inbox để duyệt đơn nhanh hơn.</span> ) <span class="badge bg-success">Hoạt động</span></label>
                        <div id="sv10" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv10">
                            <div class="accordion-body alert alert-danger">Không bảo hành </div>
                        </div>
                    </div> ->
                    <div class="mb-3">
                        <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        <label>Nhập Link Video TikTok:</label>
                        <input type="text" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link" required="" id="idbuff_like">
                    </div>
                    <input type="hidden" id="view" value="">
                    <input type="hidden" id="uid" value="">
                    <input type="hidden" id="link" value="">
                    <div id="detailServer"></div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lưu ý:</strong><br>
                        - DÙNG LINK RÚT GỌN Ở ĐIỆN THOẠI HOẶC MÁY TÍNH ĐỀU ĐƯỢC <BR>
                        - ĐƠN CŨ HOÀN THÀNH MỚI ĐƯỢC CÀI ĐƠN MỚI. NẾU CÀI ĐÈ ĐƠN CÓ BỊ THIẾU BÊN MÌNH KHÔNG HỖ TRỢ. HOÀN THÀNH = GỐC + SỐ MUA <BR>
                        - ĐƠN ĐANG CHẠY TRÊN MLIKE MÀ BẠN VẪN CHẠY Ở CHỖ KHÁC NẾU CÓ TÌNH TRẠNG HỤT SỐ LƯỢNG BÊN MÌNH SẼ KHÔNG XỬ LÝ.<BR>
                        - <mark style="color:red;"><strong> CHÍNH SÁCH BẢO HÀNH :</strong></mark> Bảo hành theo từng đơn hàng, khi bấm bảo hành sẽ chạy lại số lượng đã mua. <BR>
                        - KHI BỊ TỤT VIEW MỌI NGƯỜI VÀO LỊCH SỬ MUA ĐƠN BẤM NÚT BẢO HÀNH ( MỖI ĐƠN HÀNG CHỈ ĐƯỢC BẤM NÚT BẢO HÀNH SAU 24H KỂ TỪ LẦN BẢO HÀNH CUỐI) <br>
                    </div>
                    <!-- thong bao 
                    <?php if (!isset($_POST['add'])) { ?>
                        <script>
                            function sayHello() {
                                var sangml = document.createElement("sangml")
                                sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Tốc độ các sv có thể thay đổi liên tục, test ít cảm nhận thấy nhanh thì dùng nhé. Quá 24h mới hỗ trợ</big></b>";
                                swal({
                                    content: sangml,
                                    buttons: false
                                });
                            }
                            setTimeout(sayHello, 1500);
                        </script>
                    <?php } ?> 
                    <!-- <label style="font-size:18px;">Hướng dẫn Lấy id  <a href="https://findids.net/username-to-id-tiktok" target="_blank">Tại đây</a></label> 
 </div>-->

                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Chú Ý:</strong><br>
  <p>
</p>
</div>
    <div class="alert alert-warning" role="alert">
  <strong>Lưu ý:</strong><br>
- 1 ID không cài 2 đơn cùng 1 lúc, đợi xong đơn cũ mới cài đơn mới, nếu cố tình sẽ không xử lý <br>
- Nếu ID đang chạy trên hệ thống Mlike mà bạn vẫn mua id đó các hệ thống bên khác, nếu có tình trạng hụt số lượng giữa 2 bên thì sẽ không được xử lý<br>
- Có thể trong lúc chạy có thể like hoặc sub bị tụt vui lòng buff dư thêm 20 - 40% trên tổng số lượng để tránh tụt vì acc lấy ra chạy có thể bị checkpoint trong khi chạy ! <br>
- Nếu khách hàng cố tình đổi Username trong quá trình Buff sẽ không được hoàn tiền<br>-->
                    <div class="mb-3">
                        <label>Số Lượng Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số..." name="sl" value="" required="">
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>
                                Cách Tính Giá: Giá x Số View
                                <hr>Thành Tiền: <span id="total">0</span> VNĐ
                            </strong></center>
                    </div>
                    <center>
                        <button type="button" id="button" name="add" class="btn btn-primary btn-rounded me-1 mb-1" onclick="send_order()"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4"> <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a></div>
        </div>
        <script>
            function send_order() {
                var id = $('#idbuff_like').val();
                var sv = $("input[name='sv']:checked").val();
                var sl = $('#sl').val();
                var view = $('#view').val();
                var uid = $('#uid').val();
                var link = $('#link').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/tiktok/view.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
                        view,
                        uid,
                        link,
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
        if (isset($_GET['id']) && isset($_GET['user']) && isset($_GET['st']) && $row["rule"] == '99') {
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
                $nd1 = 'Hoàn tiền tăng view Tiktok (#' . $id . '):';
                $gtls = '+';
                $bd = $st;
                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$us',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$st' WHERE `username` = '$us' AND `site` = '$site'");
                echo '<script>
                alert("Huy thanh cong, vui long cho load lai trang");
                setTimeout(function() {
    window.location = "/service/tiktok/view.php?act=history";
},
1500);</script>';
            }
        }
        ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">

                <h4 class="card-title">Lịch Sử</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <table class="table table-striped table-bordered" id="data-source">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Thời Gian</th>
                                <th class="sort" data-sort="sl">Số Lượng</th>
                                <th class="sort" data-sort="profile">View Gốc</th>
                                <th class="sort" data-sort="profile">Đã Chạy (View Hiện Tại)</th>
                                <th class="sort" data-sort="profile">ID BUFF</th>
                                <th class="sort" data-sort="profile">Server BUFF</th>
                                <th class="sort" data-sort="user">Người Mua</th>
                                <th class="sort" data-sort="tt">Trạng Thái</th>
                                <th class="sort" data-sort="tt">Chức Năng</th>
                                <th class="sort" data-sort="tt">Thao Tác</th>
                            </tr>
                        </thead>
                    </table>
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
