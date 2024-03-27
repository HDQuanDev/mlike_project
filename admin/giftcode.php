<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Mẫ Giảm Giá";
require_once('../_System/head.php');

switch ($_GET['act']) {
    default:
        ?>
        <?php
                if (isset($_POST['add']) && isset($login)) {
                    $dis = mysqli_real_escape_string($db, $_POST['dis']);
                    $ex = mysqli_real_escape_string($db, $_POST['ex']);
                    $code = mysqli_real_escape_string($db, $_POST['code']);
                    $use = mysqli_real_escape_string($db, $_POST['use']);
                    if (empty($code)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Mã giảm giá','warning');</script>";
                    } elseif (empty($dis)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Chiết khấu mã giảm giá!','warning');</script>";
                    } elseif (empty($ex)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Thời gian hết hạn mã giảm giá!','warning');</script>";
                    } elseif (empty($use)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập số lần sử dụng mã giảm giá/user/ngày!','warning');</script>";
                    } else {
                        mysqli_query($db, "INSERT INTO `giftcode` SET `dis` = '$dis',`ex` = '$ex', `code` = '$code', `use`='$use', `site` = '$site'");
                        echo "<script>swal('Hệ Thóng!','Thêm mã giản giá thành công!','success');</script>";
                    }
                }

        ?>


        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title" data-anchor="data-anchor">Quản Lý & Thêm Mã Giảm Giá</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                
                    <div class="mb-3">
                        <label><strong>MÃ GIẢM GIÁ:</strong></label>
                        <div class="input-group mb-3">
                            <input type="text" name="code" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            
                        </div>
                    </div>
                    <div class="mb-3">
                        <label> <strong>CHIẾT KHẤU MÃ GIẢM GIÁ: </strong> </label>
                        <input type="text" name="dis" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label> <strong>SỐ LẦN SỰ DỤNG/USER/NGÀY: </strong> </label>
                        <input type="text" name="use" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label> <strong>HẠN SỬ DỤNG: </strong> </label>
                        <input type="text" name="ex" class="form-control">
                        <label class="note">(*) Sử dụng timestramp, lấy tại <a href="https://www.epochconverter.com/">Đây</a></label>
                    </div>

        
                    <center>
                        <button type="submit" name="add" class="btn btn-success btn-rounded me-1 mb-1" id="loading"><i class="fa fa-dollar-sign"></i> Thêm</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=manager" class="btn btn-primary">Quản Lý Mã Giảm Giá <i class="fa fa-angle-double-down scale2 ml-2"></i></a>
            </div>
        </div>
    <?php
        break;
    case 'manager':
        ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title" data-anchor="data-anchor">Quản Lý Mã Giảm Giá</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar" id="history" data-list='{"valueNames":["id","time","sl","goc","profile","tt","user"],"page":10,"pagination":true}'>

                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">Mã</th>
                                <th class="sort" data-sort="sl">Giảm</th>
                                <th class="sort" data-sort="goc">Lượt Sử Dụng</th>
                                <th class="sort" data-sort="goc">Ngày Hết Hạn</th>
                               
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php

                                    $result1 = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `site` = '" . $site . "'");

        if ($result1) {
            while ($ro = mysqli_fetch_assoc($result1)) {
                $t = $ro['ex'];
                ?>
                                    <tr>
                                        <td class="id"><b><?= $ro['id']; ?></b></td>
                                        <td class="sl"><?php echo $ro['code']; ?></td>
                                        <td class="goc"><?php echo $ro['dis']; ?>%</td>
                                        <td class="profile"><?php echo $ro['use']; ?></td>
                                        <td class="profile"><?php echo date("Y-m-d H:i:s", $t); ?></td>
                                     
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

                <a href="?act=buy" class="btn btn-primary">Quay Lại Thêm Mã Giảm Giá <i class="fa fa-angle-double-down scale2 ml-2"></i></a>

            </div>
        </div>

<?php
}
require('../_System/end.php');
?>