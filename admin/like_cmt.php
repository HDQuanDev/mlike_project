<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Quản Lý Like CMT SV3";
require_once('../_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Danh Sách Đơn Hàng Like CMT SV3 </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive scrollbar">
            <div class="mb-3">
                <div class="list-group-item">
                    <p class="list-group-item-text text-center"><span class="w3-opacity text-center"><a href="?status=1"><span class="btn btn-primary btn-rounded btn-sm">Đang Xử Lý</span></a> <a href="?status=2"><span class="btn btn-success btn-rounded btn-sm">Hoàn Thành</span></a> <a href="?status=3"><span class="btn btn-warning btn-rounded btn-sm">Đang Chạy</span></a> <a href="?status=4"><span class="btn btn-danger btn-rounded btn-sm">Bị Hủy</span></a></span></p>
                </div>
            </div>
            <?php
            if ($_GET['action']) {
                $id = $_GET['id'];
                $tt = $_GET['action'];
                $dn = $_GET['sl'];
                if ($tt == 2) {
                    mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '$tt', `done` = '$dn' WHERE `id` = '$id'");
                } else {
                    mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '$tt' WHERE `id` = '$id'");
                }
                echo "<script>swal('Hệ Thống!','Chỉnh sửa trạng thái ID " . $id . " thành công!','success');</script>";
                echo '<script>setTimeout(function(){
    window.location="' . $url . '#' . $id . '";
}, 3000);</script>';
            }

if ($_POST['dn']) {
    $dn = $_POST['dn'];
    $id = $_GET['id'];
    $c = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `id`='$id'");
    $c = mysqli_fetch_assoc($c);
    $done = $c['done'];
    if ($done <= $dn && $c['trangthai'] == 3) {
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$dn' WHERE `id` = '$id'");
        echo "<script>swal('Hệ Thống!','Chỉnh sửa số lượng hoàn thành ID " . $id . " thành công!','success');</script>";
        echo '<script>setTimeout(function(){
    window.location="' . $url . '#' . $id . '";
}, 3000);</script>';
    } else {
        echo "<script>swal('Hệ Thống!','ID " . $id . " không tồn tại hoặc ID này không ở trạng thái Đang Chạy, vui lòng kiểm tra lại!','warning');</script>";
        echo '<script>setTimeout(function(){
    window.location="' . $url . '#' . $id . '";
}, 3000);</script>';
    }
}
?>
            <table class="table table-striped table-bordered" id="example">
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort" data-sort="id"><b>#</b></th>
                        <th class="sort" data-sort="dv">Dịch Vụ</th>
                        <th class="sort" data-sort="user">Người Mua</th>
                        <th class="sort" data-sort="sl">Số Lượng</th>
                        <th class="sort" data-sort="profile">ID Buff</th>
                        <th class="sort" data-sort="sv">Đã Tăng</th>
                        <th class="sort" data-sort="time"> Thời Gian</th>
                        <th class="sort" data-sort="tt">Trạng Thái</th>
                        <th class="sort" data-sort="cn">Chức Năng</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php
        if ($_GET['status']) {
            $dv = $_GET['status'];
            $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `trangthai` = '$dv' AND `bh` = '444' ORDER BY id DESC LIMIT 1500");
        } else {
            $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `bh` = '444' ORDER BY id DESC LIMIT 1500");
        }
if ($result1) {


    while ($ro = mysqli_fetch_assoc($result1)) {
        $dv = $ro['dv'];
        $tt = $ro['trangthai'];
        if ($ro['api'] == '') {
            $api = 'Không Có';
        } else {
            $api = $ro['api'];
        }
        $t = $ro['time'];
        ?>
                            <tr>
                                <td class="id"><span id="<?= $ro['id']; ?>"><?php echo $ro['id']; ?></span></td>
                                <td class="dv"><?php dichvut($dv);  ?></td>
                                <td class="user"><a href="/admin/user.php?edit=<?php echo $ro['user']; ?>"><?php echo $ro['user']; ?></a></td>
                                <td class="sl"><?php echo $ro['sl']; ?></td>
                                <td class="profile"><a href="https://facebook.com/<?php echo $ro['profile']; ?>" target="_blank"><?php echo $ro['profile']; ?></a></td>
                                <?php
                    if ($tt == 3) {
                        ?>
                                    <td class="done">
                                        <form method="post" action="?id=<?= $ro['id']; ?>">
                                            <div class="form-group"><input value="<?= $ro['done']; ?>" type="text" name="dn" class="form-control"></div>
                                            <div class="mb-3"><button type="submit" name="add" class="btn btn-success btn-rounded"><i class="fas fa-save"></i> Lưu</button></div>
                                        </form>
                                    </td>
                                <?php
                    } else {
                        echo '<td class="done">Không thể chỉnh sửa</td>';
                    }
        ?>
                                <td><?php echo time_func($t); ?></td>
                                <td><?php trangthai($tt); ?></td>
                                <?php
        if ($tt == 1 || $tt == 3) {
            ?>
                                    <td class="cn"><a href="?action=3&id=<?= $ro['id']; ?>">Đang Chạy</a> | <a href="?action=4&id=<?= $ro['id']; ?>">Bị Hủy</a> | <a href="?action=2&id=<?= $ro['id']; ?>&sl=<?= $ro['sl']; ?>">Hoàn Thành</a></td>
                                <?php
        } else {
            echo '<td class="cn"></td>';
        }
        ?>
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
</div>
</div>

<?php
require_once('../_System/end.php');
?>