<?

$page = "like_fb";
//$admin = "1";
require_once('../_System/db.php');
$title = "Tăng Like Facebook";
require_once('../_System/head.php');

// function send mail


// token check server 5
$token = $s['token'];
if (!isset($_SESSION['bugdi'])) {
    $mane = rand(1, 9999999999);
    $_SESSION['bugdi'] = $mane;
}
?>
<?php
switch ($_GET['act']) {
    default:
?>

        <script>
            function calc() {
                var sl = document.getElementById("sl").value;
                var idbuff = document.getElementById("idbuff_like").value;
                var sv = document.querySelector('input[name="sv"]:checked').value;
                var gift = document.getElementById("gift").value;
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
                } else if (sv == '11') {
                    var gia = '<?= $gia11; ?>';
                } else if (sv == '12') {
                    var gia = '<?= $gia12; ?>';
                }
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;
                <?
                $gt = time();
                $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '$site' AND `ex` > '$gt'");
                while ($ro = mysqli_fetch_assoc($result1)) {
                ?>
                    if (gift == '<?= $ro['code']; ?>') {
                        var dis = '<?= $ro['dis']; ?>';

                    }
                <? } ?>

                var giam = (sl * gia) - ((sl * gia) * dis / 100);
                var dz = giam.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("giamgia").innerHTML = dz;


            }
        </script>
        <!-- thong bao -->
        <!-- <? if (!isset($_POST['add'])) { ?>
<script>var sangml = document.createElement("sangml");
sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> 1 số máy chủ đang gặp sự cố , hiện tại sv1 đang rất chậm. Rẻ chậm kiên nhẫn chờ đợi nha 24h cũng sẽ lên đủ.  </center></big></b>";
swal({
    content: sangml,
    buttons: false
});</script>
 <? } ?>-->
        <!--end-->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header ">
                <h4>Tăng Like Bài Viết</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" value="<?= $row['token']; ?>" id="token">
                    <label>Chọn Server Like:</label>
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv1" aria-expanded="false" aria-controls="sv1" /><label class="form-check-label" for="flexRadioDefault1">Server Like 1 (Tốc độ nhanh, chất lượng tốt tụt ít, cấm album, Max 5k ) </span> <span style="color:red;"><?= $gia1; ?>₫</span> <span class="badge bg-success">ổn định</span></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="2" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 2 ( Tốc độ nhanh <span style="color: red;">Album dể lỗi</span> Max 100k ) <span style="color:red;"><?= $gia2; ?>₫</span> <span class="badge bg-warning">Trung bình</span></label>
                    </div>
                    <!--    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="3" data-bs-toggle="collapse" data-bs-target="#sv3" aria-expanded="false" aria-controls="sv3" /><label class="form-check-label" for="flexRadioDefault1">Server Like 3 (Tốc độ nhanh , nên cài bài viết k có like gốc, Bảo Hành tự động 1 tháng, <span style="color: red;">,max 10k </span> ) <span style="color:red;"><?= $gia3; ?>₫</span> <span class="badge bg-success">Hoạt động</span></label> 

                    </div> -->
                    <div class="form-check">
                        <input class="form-check-input"  checked id="flexRadioDefault1" type="radio" name="sv" value="4" data-bs-toggle="collapse" data-bs-target="#sv4" aria-expanded="false" aria-controls="sv4" /><label class="form-check-label" for="flexRadioDefault1">Server Like 4 (<span style="color: Darkorange;"> Tốc độ nhanh, like BETA gần như k tụt,mỗi ID chỉ được mua 1 lần , chạy được album, Max 3k) <span style="color:red;"><?= $gia4; ?>₫</span> <? if ($sv4 == 'off') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-danger">Quá tải</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo '<span class="badge bg-primary">Đang mở</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?></label>
                        <div id="sv4" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#sv4">
                            <div class="accordion-body alert alert-success"> Hạn chế chia nhỏ nhiều lần tránh lỗi, lên thiếu </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 5 ( Tốc độ ưu tiên nhanh, <span style="color: red;">Album dể lỗi</span> <span style="color: red;"> max 10k </span> ) <span style="color:red;"><?= $gia5; ?>₫</span> <span class="badge bg-success">Nhanh</span></label>
                    </div>
                    <!--
                   <div class="form-check">
                        <input class="form-check-input"   id="flexRadioDefault1" type="radio" name="sv" value="6" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server Like 6 ( Tốc độ chậm - trùng bình. <span style="color: red;">CẤM ALBUM</span>.  max 10k like) <span style="color:Blue;"><?= $gia6; ?>₫</span> <span class="badge bg-warning">Trung bình</span></label>
                    </div> -->
                    <!--    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="7" data-bs-toggle="collapse" data-bs-target="#sv7" aria-expanded="false" aria-controls="sv" /><label class="form-check-label" for="flexRadioDefault1">Server Like 7 ( Tốc độ rất chậm không ổn định test ít cảm nhận, cài sẽ load báo thành công hơi lâu kiên nhẫn chờ đợi, CẤM ALBUM <span style="color: red;"> ,max 10k </span>) <span style="color:Blue;"><?= $gia7; ?>₫</span> <span class="badge bg-danger">Rẻ Chậm</span></label>
                    </div>-->
                    <!--  
                    <div class="form-check">
                    </div>
                    <input class="form-check-input" id="flexRadioDefault5" type="radio" name="sv" value="5" data-bs-toggle="collapse" data-bs-target="#sv5" aria-expanded="false" aria-controls="sv5" onclick="window.location='/service/likev2.php'" /><label class="form-check-label" for="flexRadioDefault1">Server Like Kênh 2 ( Không chạy được link share) <span style="color:Blue;"> 5đ</b></mark></label>
            </div>
           -->
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="8" data-bs-toggle="collapse" data-bs-target="#sv8" aria-expanded="false" aria-controls="sv8" /><label class="form-check-label" for="flexRadioDefault1">Server Like 8 ( Tốc độ trung bình - nhanh, tạm ổn) <span style="color:Blue;"><?= $gia8; ?>₫</span> <span class="badge bg-success">Tạm ổn</span></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="9" data-bs-toggle="collapse" data-bs-target="#sv9" aria-expanded="false" aria-controls="sv9" /><label class="form-check-label" for="flexRadioDefault1">Server Like 9 ( Tốc độ chậm - trung bình, test ít cảm nhận ) <span style="color:Blue;"><?= $gia9; ?>₫</span> <span class="badge bg-success">Trung bình</span></label>
                    </div>
                    <!-- <div class="form-check">
                         <input class="form-check-input"  disabled  id="flexRadioDefault1" type="radio" name="sv" value="10" data-bs-toggle="collapse" data-bs-target="#sv9" aria-expanded="false" aria-controls="sv10" /><label class="form-check-label" for="flexRadioDefault1">Server Like 10 ( Tốc độ nhanh, mẹo chia nhỏ nhiều sẽ lên nhanh hơn vidu 1k chia 5 đơn 200. <span style="color: red;">Max 100k</span>) <span style="color:Blue;"><?= $gia10; ?>₫</span> <span class="badge bg-warning">Thử nghiệm</span></label>
                    </div> -->
                    <!-- <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="11" data-bs-toggle="collapse" data-bs-target="#sv9" aria-expanded="false" aria-controls="sv11" /><label class="form-check-label" for="flexRadioDefault1">Server Like 11 ( Tốc độ chậm Sale thường quá tải có thể chậm bất chợt. Chạy được album <span style="color: red;">Max 10k</span>) <span style="color:Blue;"><?= $gia11; ?>₫</span> <span class="badge bg-danger">Rất Chậm</span></label>
                    </div>  -->
                    <div class="form-check">
                        <input class="form-check-input"  id="flexRadioDefault1" type="radio" name="sv" value="12" data-bs-toggle="collapse" data-bs-target="#sv12" aria-expanded="false" aria-controls="sv11" /><label class="form-check-label" for="flexRadioDefault1">Server Like 12 ( Tốc độ cực nhanh tuy nhiên hay chậm bất chợt, test ít thấy lên nhanh thì dùng <span style="color: red;">max 100k</span>) <span style="color:Blue;"><?= $gia12; ?>₫</span> <span class="badge bg-success">Siêu Nhanh</span></label>
                    </div>
                    <div class="form-group">
                        <label>Nhập ID Hoặc Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Hoặc ID Bài Viết" required="" id="idbuff_like">
                        </div>
                        <label>
                            <!-- thong bao -->
                            <!--  <? if (!isset($_POST['add'])) { ?>
                                <script>
                                    function sayHello() {
                                        var sangml = document.createElement("sangml")
                                        sangml.innerHTML = "<img class='card-img-top' src='https://daotao.ulis.vnu.edu.vn/files/uploads/2018/04/thong-bao660x350-600x350.png'><hr><big><center style='color:#3794ff;'> Fb đang quét tài nguyên die có thể tụt like nhiều, tốc độ 1 số sv sẽ rất chậm </big></b>";
                                        swal({
                                            content: sangml,
                                            buttons: false
                                        });
                                    }
                                    setTimeout(sayHello, 1500);
                                </script>
                            <? } ?> -->
                            <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        </label>
                    </div>
                    <div class="mb-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Lưu Ý:</strong><br>
                            <p> - Cách lấy link trên máy tính vui lòng kích vào thời gian đăng bài, kích vào ảnh là sai nhé <br>
                                - Riêng với avt bìa vui lòng lấy bằng máy tính kích vào hình ảnh rồi copy link có chữ photo mới đúng<br>
                                *<span style="color: red;"> Chú ý </span> : bật nút like ở trong cài đặt ra trước khi cài (Vào cài đặt => bài viết công khai => bật công khai hết ra nhé <br>
                                - Đối với bài viết chia sẽ trên điện thoại thường lấy nhầm vào link gốc vui lòng dùng máy tính để lấy <br>
                                - Cài số lượng nhỏ lên được hãy cài tiếp tránh cài sll ko lên được sẽ k hỗ trợ hủy, có thể gửi riêng admin hỗ trợ chạy nhanh hơn <br>
                                - Không đọc lưu ý và mô tả , nhập Sai ID sẽ k hoàn tiền. <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số Lượng Like Muốn Mua:</label>
                        <input type="number" id="sl" oninput="calc()" class="form-control mb-3" placeholder="Nhập số Like" name="sl" value="" required="">
                    </div>

                    <div class="form-group">
                        <select class="form-select mb-3" name="gift" id="gift" oninput="calc()">
                            <option selected>Chọn Mã Giảm Giá</option>
                            <?php
                            $gt = time();
                            $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '$site' AND `ex` > '$gt'");

                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                            ?>
                                    <option value="<?= $ro['code']; ?>"><b>Mã: <span style="color:red;"><?= $ro['code']; ?></span></b> giảm <i><?= $ro['dis']; ?></i>%</option>
                            <?
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="alert alert-success" role="alert">
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ</strong><br>
                            <strong>Giảm Giá: <span id="giamgia">0</span> VNĐ</strong>
                        </center>
                    </div>
                    <center>
                        <button type="button" id="button" class="btn btn-primary btn-rounded me-1 mb-1" onclick="send_order()"><i class="fa fa-dollar-sign"></i> Thanh Toán</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=history" class="btn btn-primary">Lịch Sử Mua Đơn <i class="fa fa-angle-double-down scale2 ml-2"></i></a>

            </div>
        </div>
        <script>
            function send_order() {
                var id = $('#idbuff_like').val();
                var sv = $("input[name='sv']:checked").val();
                var sl = $('#sl').val();
                var gift = $('#gift').val();
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $.ajax({
                    url: "/api/buy/facebook/like.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id,
                        sv,
                        sl,
                        gift,
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
    ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h4 class="card-title">Lịch Sử Tăng Like</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thời Gian</th>
                                <th>Số Lượng</th>
                                <th>Đã Tăng</th>
                                <th>ID BUFF</th>
                                <th>Server Like</th>
                                <th>Người Mua</th>
                                <th>Trạng Thái</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($row['rule'] == 99) {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' ORDER BY id DESC LIMIT 0,3000");
                            } else {
                                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Like' ORDER BY id DESC LIMIT 0,3000");
                            }
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $tt = $ro['trangthai'];
                                    $t = $ro['time'];
                                    $done = $ro['done'];
                                    if ($done == 14102003) {
                                        $done = 'Không áp dụng';
                                    } else {
                                        $done = $done;
                                    }
                            ?>
                                    <tr>
                                        <td><?= $ro['id']; ?></td>
                                        <td><?php echo time_func($t); ?></td>
                                        <td><?php echo $ro['sl']; ?></td>
                                        <td><?php echo $done; ?></td>
                                        <td><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                        <td><?php echo $ro['sve']; ?></td>
                                        <td><?php echo $ro['user']; ?></td>
                                        <td><?php trangthai($tt); ?></td>
                                        <?php
                                        if ($tt == '7') {
                                            echo '<td><form><input id="id_order_' . $ro["id"] . '" value="' . $ro['id'] . '" type="hidden"><input id="token" value="' . $row['token'] . '" type="hidden"><button type="button" id="button_' . $ro["id"] . '" class="btn btn-primary btn-rounded" onclick="huy_order_' . $ro["id"] . '()">Hủy & Hoàn Tiền</button></form></td>';
                                        } else {
                                            echo '<td>NULL</td>';
                                        }
                                        ?>
                                    </tr>
                                    <script>
                                        function huy_order_<?= $ro["id"]; ?>() {
                                            var id_order = $('#id_order_<?= $ro["id"]; ?>').val();
                                            var token = $('#token').val();
                                            $('#button_<?= $ro["id"]; ?>')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                                            $("#button_<?= $ro["id"]; ?>")
                                                .prop("disabled", true);
                                            $.ajax({
                                                url: "/api/buy/facebook/like.php?act=cancel_order",
                                                type: "post",
                                                dataType: "json",
                                                data: {
                                                    id_order,
                                                    token,
                                                },
                                                success: function(response) {
                                                    if (response.status === 'success') {
                                                        swal('Hệ Thống!', response.msg, 'success');
                                                    } else {
                                                        swal('Hệ Thống!', response.msg, 'warning');
                                                        $("#button_<?= $ro["id"]; ?>")
                                                            .prop("disabled", false)
                                                    }
                                                    $('#button_<?= $ro["id"]; ?>')['html']('Hủy & Hoàn Tiền');
                                                }
                                            });
                                        }
                                    </script>
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
?>

<?php
require('../_System/end.php');
?>
