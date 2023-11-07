<?php
/*
$admin = 1;

$title = "Set Giá Thành Viên";
require_once('../_System/head.php');

foreach ($_POST as $key => $value) {
    $$key = htmlspecialchars($value);
}
echo $quan;

$res = mysqli_query($db, "DESCRIBE setgia");
while($row = mysqli_fetch_array($res)) {
    echo "`{$row['Field']}`='!{$row['Field']}', ";
}
*/
?>
<?php

$admin = '1';
$title = "Set Giá Thành Viên";
require_once('../_System/head.php');
?>

<?php

switch ($_GET['act']) {
    case 'edit':
        if (isset($_POST['st'])) {
            foreach ($_POST as $key => $value) {
                $$key = htmlspecialchars($value);
            }
            mysqli_query($db, "UPDATE `setgia` SET `fbl_1`='$fbl_1', `fbl_2`='$fbl_2', `fbl_3`='$fbl_3', `fbl_4`='$fbl_4', `fbl_5`='$fbl_5', `fbl_6`='$fbl_6', `fbl_7`='$fbl_7', `fbl_8`='$fbl_8', `fblv2_1`='$fblv2_1', `fblv2_2`='$fblv2_2', `fblv2_3`='$fblv2_3', `fblv2_4`='$fblv2_4', `fbcx_1`='$fbcx_1', `fbcx_2`='$fbcx_2', `fbcmt_1`='$fbcmt_1', `fblikecmt_1`='$fblikecmt_1', `fblikecmt_2`='$fblikecmt_2', `fbshare_1`='$fbshare_1', `fbshare_2`='$fbshare_2', `fbshare_3`='$fbshare_3', `fblive_1`='$fblive_1', `fblive_2`='$fblive_2', `fblive_3`='$fblive_3', `fblive_4`='$fblive_4', `fbview_1`='$fbview_1', `fbview_2`='$fbview_2', `fbfollow_1`='$fbfollow_1', `fbfollow_2`='$fbfollow_2', `fbfollow_3`='$fbfollow_3', `fbfollow_4`='$fbfollow_4', `fbfollow_5`='$fbfollow_5', `fbfollow_6`='$fbfollow_6', `fbfollow_7`='$fbfollow_7', `fbfollow_8`='$fbfollow_8', `fbfollow_9`='$fbfollow_9', `fbfollow_10`='$fbfollow_10', `fbpage_1`='$fbpage_1', `fbpage_2`='$fbpage_2', `fbpage_3`='$fbpage_3', `fbpage_4`='$fbpage_4', `fbgroup_1`='$fbgroup_1', `fbgroup_2`='$fbgroup_2', `fbgroup_3`='$fbgroup_3', `fbviplike_1`='$fbviplike_1', `fbstory_1`='$fbstory_1', `iglike_1`='$iglike_1', `iglike_2`='$iglike_2', `iglike_3`='$iglike_3', `igfollow_1`='$igfollow_1', `igfollow_2`='$igfollow_2', `igfollow_3`='$igfollow_3', `igview_1`='$igview_1', `igview_2`='$igview_2', `igcmt_1`='$igcmt_1', `ttlike_1`='$ttlike_1', `ttlike_2`='$ttlike_2', `ttlike_3`='$ttlike_3', `ttlike_4`='$ttlike_4', `ttfollow_1`='$ttfollow_1', `ttfollow_2`='$ttfollow_2', `ttfollow_3`='$ttfollow_3', `ttview_1`='$ttview_1', `ttview_2`='$ttview_2', `ttview_3`='$ttview_3', `ttlive_1`='$ttlive_1', `ttshare_1`='$ttshare_1', `ttcmt_1`='$ttcmt_1', `otweb_1`='$otweb_1', `ytbview_1`='$ytbview_1', `ytbview_2`='$ytbview_2', `ytbview_3`='$ytbview_3', `ytbsub_1`='$ytbsub_1', `ytbsub_2`='$ytbsub_2', `ytblike_1`='$ytblike_1' WHERE `user` = '$user' AND `id` = '$id' AND `site` = '$site'");
            echo "<script>swal('Hệ Thống!','Chỉnh sửa giá thành viên thành công!','success');</script>";
            echo '<script>setTimeout(function(){
    window.location="";
}, 3000);</script>';
        }
?>
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Set Giá Thành Viên: <?= $_GET['user']; ?></h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <p>
                <form method="POST">
                    <?php
                    $user = $_GET['user'];
                    $u = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user`='$user' AND `site` = '$site'");
                    $u = mysqli_fetch_assoc($u);
                    $res = mysqli_query($db, "DESCRIBE setgia");
                    while ($row = mysqli_fetch_array($res)) {
                        $key = $row['Field'];
                    ?>
                        <div class="mb-3">
                            <label class="form-label"><?= $key; ?></label>
                            <input name="<?= $key; ?>" value="<?= $u[$key]; ?>" class="form-control" <? if ($key == 'id' || $key == 'user') {
                                                                                                        echo 'readonly=""';
                                                                                                    } ?>>
                        </div>
                    <?
                    }
                    ?>
                    <button type="submit" class="btn btn-success btn-rounded btn-block me-1 mb-1" name="st"><i class="fa fa-pencil-square-o"></i> Chỉnh Sửa </button>
                </form>
                </p>
            </div>
        </div>
    <?php
        break;
    case 'creat':
        $user = $_GET['user'];
    ?>
        <script>
            swal({
                title: 'Vui Lòng Đọc Kĩ Thông Báo Này?',
                text: 'Bạn đang thực hiện thao tác TẠO BẢNG set giá cho thành viên <?= $user; ?>, vui lòng kiểm tra xem thành viên <?= $user; ?> có đang online không, chỉ SET GIÁ khi chắc chắn thành viên <?= $user; ?> không online, thao tác này chỉ hiện thị 1 lần khi bạn SET GIÁ những thành viên chưa có trên CSDL, để hủy thao tác vui lòng ẤN VÀO KHOẢNG TRỐNG hoặc QUAY LẠI TRANG TRƯỚC, cảm ơn!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tạo Bảng',
                cancelButtonText: 'Hủy Bỏ',
                showCloseButton: true,
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.value) {
                    swal('Deleted', 'You successfully deleted this file', 'success')
                } else {
                    window.location = "?act=create&user=<?= $user; ?>";
                }
            })
        </script>
    <?php
        break;
    case 'create':
        $user = $_GET['user'];
        $sg = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '" . $user . "' AND `site` = '$site'");
        $sg = mysqli_num_rows($sg);
        if ($sg == 0) {
            mysqli_query($db, "INSERT INTO `setgia` SET `user` = '$user', `site` = '$site'");
        }
        header('location:?act=edit&user=' . $user);
    default:
    ?>
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Set Giá Thành Viên</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <p>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped" id="example">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th>#</th>
                                <th>Tên Tài Khoản</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result1 = mysqli_query($db, "SELECT * FROM `member` WHERE `site` = '$site' ORDER BY id DESC");
                            if ($result1) {
                                while ($ro = mysqli_fetch_assoc($result1)) {
                                    $sg = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '" . $ro['username'] . "' AND `site` = '$site'");
                                    $sg = mysqli_num_rows($sg);
                                    if ($ro['rule'] == 99) {
                                        $cv = "Admin!";
                                    } elseif ($ro['rule'] == 66) {
                                        $cv = "Cộng Tác Viên";
                                    } else {
                                        $cv = "Thành Viên";
                                    }
                                    $vnd = $ro['vnd'];

                                    $formattedNum = number_format($vnd);

                                    $vnd = $formattedNum;
                            ?>
                                    <tr>
                                        <td><?php echo $ro['id']; ?></td>
                                        <td><?php echo $ro['username']; ?></td>
                                        <td><a class="btn btn-success" href="<?php if ($sg == 1) {
                                                                                    echo '?act=edit&user=' . $ro['username'] . '';
                                                                                } else {
                                                                                    echo '?act=creat&user=' . $ro['username'] . '';
                                                                                } ?>"><i class="fa fa-edit"></i> Edit</a></td>
                                    </tr>
                            <?php
                                }
                                echo '</tbody>
</table>
';
                            }
                            ?>
                            </p>
                </div>
            </div>
        </div>
        </div>

<?php
        break;
}
require_once('../_System/end.php');


?>