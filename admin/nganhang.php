<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Cài đặt ngân hàng";
require_once('../_System/head.php');

switch ($_GET['act']) {
    default:
?>
        <?php
        if (isset($_POST['add']) && isset($login)) {
                    $stk = mysqli_real_escape_string($db, $_POST['stk']);
                    $nh = mysqli_real_escape_string($db, $_POST['nh']);
                    $ten = mysqli_real_escape_string($db, $_POST['ten']);
                    if (empty($stk)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập STK','warning');</script>";
                    } elseif (empty($nh)) {
                        echo "<script>swal('OOPS!','Vui lòng nhập Tên Ngân Hàng!','warning');</script>";
                    } else {
                          mysqli_query($db, "INSERT INTO `stk` SET `stk` = '$stk',`nganhang` = '$nh', `name` = '$ten', `site`='$site'");
                          echo "<script>swal('Hệ Thóng!','Thêm thành công!','success');</script>";
                    }
                }
            
        ?>


        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title" data-anchor="data-anchor">Quản Lý & Thêm Tài Khoản ATM</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">
                <form action="" id="form_id" class="user" method="POST" accept-charset="utf-8">
                
                    <div class="mb-3">
                        <label><strong>SỐ TÀI KHOẢN:</strong></label>
                        <div class="input-group mb-3">
                            <input type="text" name="stk" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            
                        </div>
                    </div>
                    <div class="mb-3">
                        <label> <strong>Chủ Tài Khoản: </strong> </label>
                        <input type="text" name="ten" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label> <strong>Ngân Hàng: </strong> </label>
                        <input type="text" name="nh" class="form-control">
                    </div>

        
                    <center>
                        <button type="submit" name="add" class="btn btn-success btn-rounded me-1 mb-1" id="loading"><i class="fa fa-dollar-sign"></i> Thêm</button>
                    </center>
                </form>
                </p>
            </div>
            <div class="card-footer border-0 text-center py-4">
                <a href="?act=manager" class="btn btn-primary">Quản Lý STK <i class="fa fa-angle-double-down scale2 ml-2"></i></a>
            </div>
        </div>
    <?
        break;
    case 'manager':
    ?>
        <div class="card border-danger border-bottom border-3 border-0">
            <div class="card-header">
                <h5 class="card-title" data-anchor="data-anchor">Quản Lý STK</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive scrollbar" id="history" data-list='{"valueNames":["id","time","sl","goc","profile","tt","user"],"page":10,"pagination":true}'>

                    <table class="table table-striped table-bordered" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="id"><b>#</b></th>
                                <th class="sort" data-sort="time">STK</th>
                                <th class="sort" data-sort="sl">Ngân Hàng</th>
                                <th class="sort" data-sort="goc">Chủ Tài Khoản</th>
                               
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                          
                                $result1 = mysqli_query($db, "SELECT * FROM `stk` WHERE `site` = '" . $site . "'");
                            
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                  
                            ?>
                                    <tr>
                                        <td class="id"><b><?= $ro['id']; ?></b></td>
                                        <td class="sl"><?php echo $ro['stk']; ?></td>
                                        <td class="goc"><?php echo $ro['nganhang']; ?></td>
                                        <td class="profile"><?php echo $ro['name']; ?></td>
                                     
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

                <a href="?act=buy" class="btn btn-primary">Quay Lại Thêm STK <i class="fa fa-angle-double-down scale2 ml-2"></i></a>

            </div>
        </div>

<?php
}
require('../_System/end.php');
?>