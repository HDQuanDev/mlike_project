<?

$page = "cmt_fb";
//$admin = "1";
require_once('../_System/db.php');
$title = "Tăng Comment Facebook";
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
                if (sv == '1') {
                    var gia = '<?= $gia1; ?>';
                }
                var tien = sl * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;
            }
        </script>
        <!--end-->
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header ">
                <h4>Tăng Like Bài Viết</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form>
                    <input type="hidden" value="<?= $row['token']; ?>" id="token">
                    <label>Chọn Server Comment:</label>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="sv" value="1" data-bs-toggle="collapse" data-bs-target="#sv2" aria-expanded="false" aria-controls="sv2" /><label class="form-check-label" for="flexRadioDefault1">Server CMT 1 ( <span style="color:red;"><?= $gia1; ?>₫</span> <span class="badge bg-success">test</span></label>
                    </div>

                    <div class="form-group">
                        <label>Nhập ID Hoặc Link Bài Viết:</label>
                        <div class="input-group mb-3">
                            <input type="text" oninput="getIDP('id');" name="id" class="form-control mb-3" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Nhập Link Hoặc ID Bài Viết" required="" id="idbuff_like">
                        </div>
                        <label>
                            <h4> <span style="color: red;">(*) Hãy đọc lưu ý trước khi dùng tránh mất tiền</span></h4>
                        </label>
                    </div>
                    <div id="notine">
                    </div>
                    <div class="mb-3">
                        <label>Nhập Nội Dung Comment (Mỗi 1 dòng tương ứng với 1 comment):</label>
                        <textarea type="text" id="sl" oninput="countLines()" class="form-control mb-3" rows="7" placeholder="Nhập nội dung comment, mỗi một dòng tương ứng với 1 comment
xin vui lòng không sử dụng kí tự đặc biệt hoặc icon để tránh lỗi, cảm ơn!" name="sl" required=""></textarea>
                    </div>
                    <div class="alert alert-info" role="alert">Bạn đã nhập: <span id="total_cmt">0</span> Comment
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
                        <center><strong>Thành Tiền: <span id="total">0</span> VNĐ</strong>
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
            function countLines() {
                var textarea = document.getElementById('sl');
                var text = textarea.value;
                var originalText = text;

                // Loại bỏ các ký tự đặc biệt
                text = text.replace(/[\u{1F600}-\u{1F64F}]/gu, ''); // loại bỏ các biểu tượng cảm xúc
                text = text.replace(/\|/g, ''); // loại bỏ dấu |

                // Kiểm tra xem nội dung đã được thay đổi hay không
                if (text !== originalText) {
                    // Cập nhật nội dung của textarea
                    textarea.value = text;

                    // Hiển thị thông báo swal
                    swal("Đã loại bỏ các ký tự không hợp lệ!", "Bạn đã nhập một hoặc nhiều ký tự không hợp lệ, chúng đã được tự động loại bỏ.", "warning");
                }

                var lines = text.split('\n');
                var lineCount = lines.length;

                // Cập nhật số dòng vào thẻ div
                var div = document.getElementById('total_cmt');
                div.textContent = lineCount;
                var gia = '<?= $gia1; ?>';
                var tien = lineCount * gia;
                var quan = tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                document.getElementById("total").innerHTML = quan;

            }

            function send_order() {
                var id = $('#idbuff_like').val();
                var sv = $("input[name='sv']:checked").val();
                var cmt = $('#sl').val();
                var count_cmt = cmt.split(/\r\n|\r|\n/).length;
                var token = $('#token').val();
                $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                $("#button")
                    .prop("disabled", true);
                $('#button').addClass('spinning');
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
                            .prop("disabled", false);
                        $('#button').removeClass('spinning');

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