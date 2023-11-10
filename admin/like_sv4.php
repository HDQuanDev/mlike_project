<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Quản Lý Like Tay SV4";
require_once('../_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Danh Sách Đơn Hàng Thủ Công SV4 </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive scrollbar">
            <div class="mb-3">
                <div class="list-group-item">
                    <p class="list-group-item-text text-center"><span class="w3-opacity text-center"><a href="?status=1"><span class="btn btn-primary btn-rounded btn-sm">Đang Xử Lý</span></a> <a href="?status=2"><span class="btn btn-success btn-rounded btn-sm">Hoàn Thành</span></a> <a href="?status=3"><span class="btn btn-warning btn-rounded btn-sm">Đang Chạy</span></a> <a href="?status=4"><span class="btn btn-danger btn-rounded btn-sm">Bị Hủy</span></a></span></p>
                </div>
            </div>
            <?php
            if (isset($_GET['id']) && isset($_GET['user']) && isset($_GET['st'])) {
                $id = $_GET['id'];
                $us = $_GET['user'];
                $st = $_GET['st'];
                $tko = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `id` = '$id' AND `trangthai` != '4'");
                $tko = mysqli_num_rows($tko);
                if ($tko == '1') {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '4' WHERE `id` = '$id'");
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$us' AND `site` = '$site'");
                    $u = mysqli_fetch_assoc($u);
                    $time = time();
                    $dd = $u['vnd'];
                    $nd1 = 'Hoàn tiền tăng like Facebook (#' . $id . '):';
                    $gtls = '+';
                    $bd = $st;
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$us',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$st' WHERE `username` = '$us' AND `site` = '$site'");
                    echo '<script>
                    alert("Huy thanh cong, vui long cho load lai trang");
                    setTimeout(function() {
        window.location = "/admin/like_sv4.php";
    },
    1500);</script>';
                }
            }

            if ($_GET['action']) {
                $id = $_GET['id'];
                $tt = $_GET['action'];
                $dn = $_GET['sl'];
                if ($tt == 2) {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '$tt', `done` = '$dn' WHERE `id` = '$id'");
                } else {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '$tt' WHERE `id` = '$id'");
                }
                echo "<script>swal('Hệ Thống!','Chỉnh sửa trạng thái ID " . $id . " thành công!','success');</script>";
                echo '<script>setTimeout(function(){
    window.location="' . $url . '#' . $id . '";
}, 3000);</script>';
            }

            if ($_POST['dn']) {
                $dn = $_POST['dn'];
                $id = $_GET['id'];
                $c = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `id`='$id'");
                $c = mysqli_fetch_assoc($c);
                $done = $c['done'];
                if ($done <= $dn && $c['trangthai'] == 3) {
                    mysqli_query($db, "UPDATE `dichvu` SET `done` = '$dn' WHERE `id` = '$id'");
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
                        <th class="sort" data-sort="done">Gốc</th>
                        <th class="sort" data-sort="sv">Đã Tăng</th>
                        <th class="sort" data-sort="time"> Thời Gian</th>
                        <th class="sort" data-sort="tt">Trạng Thái</th>
                        <th class="sort" data-sort="cn">Chức Năng</th>
                        <th class="sort" data-sort="tt">QUANDZVL</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php
                    if ($_GET['status']) {
                        $dv = $_GET['status'];
                        $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `trangthai` = '$dv' AND `nse` = '444' ORDER BY id DESC LIMIT 200");
                    } else {
                        $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `nse` = '444' ORDER BY id DESC LIMIT 200");
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
                                <td class="api"><?php echo $ro['bh']; ?></td>
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
                                <td colspan="time"><?php echo time_func($t); ?></td>
                                <td class="tt"><?php trangthai($tt); ?></td>
                                <?php
                                if ($tt == 1 || $tt == 3) {
                                ?>
                                    <td class="cn"><a href="?action=3&id=<?= $ro['id']; ?>">Đang Chạy</a> | <a href="?action=7&id=<?= $ro['id']; ?>">Bị Hủy</a> | <a href="?action=2&id=<?= $ro['id']; ?>&sl=<?= $ro['sl']; ?>">Hoàn Thành</a></td>
                                <?php
                                } else {
                                    echo '<td class="cn"></td>';
                                }
                                ?>
                                <?php
                                if ($tt != '4' && $tt != '2') {
                                    echo '<td class="tt"><a href="?act=history&id=' . $ro['id'] . '&user=' . $ro['user'] . '&st=' . $ro['sotien'] . '">Hủy Đơn</a></td>';
                                } else {
                                    echo '<td class="tt">NULL</td>';
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
