<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Quản Lý Thành Viên";
require_once('../_System/head.php');
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title" data-anchor="data-anchor">Quản Lý Thành Viên</h5>
    </div>
    <div class="card-body">
        <p class="mb-0">
            <?php
            if ($_GET['del']) {
                $id = $_GET['del'];
                $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$id' AND `site` = '$site'");
                $tko = mysqli_num_rows($tko);
                if ($tko != 0) {
                    $del = mysqli_query($db, "DELETE FROM `member`
WHERE `username` = '$id' AND `site` = '$site'");
                    if ($del) {
                        echo "<script>swal('Hệ Thống!','Xoá Thành Viên Thành Công!','success');</script>";
                        echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                    }
                }
            }

            if ($_GET['edit']) {
                $id = $_GET['edit'];
                $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$id' AND `site` = '$site'");
                $tko = mysqli_num_rows($tko);
                if ($tko != 0) {
                    $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$id' AND `site` = '$site'");
                    $u = mysqli_fetch_assoc($u);
                    if (isset($_POST['st'])) {

                        $user = $u['username'];
                        $vnd = mysqli_real_escape_string($db, $_POST['vnd']);
                        $cv = mysqli_real_escape_string($db, $_POST['cv']);
                        $gt = mysqli_real_escape_string($db, $_POST['gt']);
                        if (empty($gt)) {
                            echo "<script>swal('OOPS!','Vui lòng chọn giá trị tiền!','warning');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        } elseif (empty($cv)) {
                            echo "<script>swal('OOPS!','Vui lòng chọn Chức vụ!','warning');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        } else {
                            $nd1 = 'Bạn được thăng chức bởi Admin';
                            $bd = '0';
                            $time = time();
                            if (!$u['rule'] == $cv) {
                                $goc = $u['vnd'];
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$user',`time`='$time', `loai` = '3', `goc` = '$goc'");
                            }
                            mysqli_query($db, "UPDATE `member` SET `rule` = '$cv' WHERE `username` = '$user' AND `site` = '$site'");
                            if (!$gt == '0') {
                                $idgd = $vnd;
                                $dd = $u['vnd'];
                                if ($gt == '5') {
                                    $vn = $dd - $vnd;
                                    $nd1 = 'Trừ tiền vào tài khoản:';
                                    $gtls = '-';
                                } elseif ($gt == '10') {
                                    $vn = $dd + $vnd;
                                    $nd1 = 'Nạp tiền vào tài khoản:';
                                    $gtls = '+';
                                    if ($vnd > $s['minref']) {
                                        if ($u['ref'] !== '0') {
                                            $reff = $u['ref'];
                                        } else {
                                            $reff = 'dramasee';
                                        }
                                        if (isset($reff)) {
                                            $ref = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$reff' AND `site` = '$site' LIMIT 1");
                                            $ref = mysqli_fetch_assoc($ref);
                                            $ckref = $s['ckref'];
                                            $cref = $vnd / 100 * $ckref;
                                            $rbd = $ref['vnd'];
                                            $nd = 'Nhận tiền từ hoa hồng giới thiệu:';
                                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd',`bd` = '$cref',`user`='$reff',`time`='$time', `loai` = '2', `goc` = '$rbd', `idgd` = '$cref', `gt` = '+'");
                                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$cref' WHERE `username` = '$reff' AND `site` = '$site'");
                                            mysqli_query($db, "UPDATE `member` SET `vndgt` = `vndgt`+'$cref' WHERE `username` = '$user' AND `site` = '$site'");
                                        }
                                    }
                                } else {
                                    $vn = $vnd;
                                }
                                $bd = $vnd;
                                if ($gt == '10') {
                                    $tx = 'Nap Tiền Qua #Admin (' . $site . ' #' . rand(1000000, 9999999) . ')';
                                    $idr = rand(10000, 99999999);
                                    mysqli_query($db, "INSERT INTO `momo` SET `user` = '$user',`vnd` = '$vnd',`tranid`='$idr',`time`='$time', `text`='$tx',`app`='ADMIN', `site` = '$site'");
                                }
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$user',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$idgd', `gt` = '$gtls'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = '$vn' WHERE `username` = '$user' AND `site` = '$site'");
                            }
                            echo "<script>swal('Hệ Thống!','Chỉnh sửa thành viên thành công!','success');</script>";
                            echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
                        }
                    }
                    if ($u['rule'] == 99) {
                        $quandz = 'Admin';
                    } elseif ($u['rule'] == 66) {
                        $quandz = 'Đại Lý';
                    } elseif ($u['rule'] == 33) {
                        $quandz = 'Cộng Tác Viên';
                    } elseif ($u['rule'] == 10) {
                        $quandz = 'Block!';
                    } else {
                        $quandz = 'Thành Viên!';
                    }
                    if ($u['rule'] == 99) {
                        $sl9 = 'selected="selected"';
                        $sl0 = '';
                        $sl1 = '';
                        $sl2 = '';
                        $sl3 = '';
                    } elseif ($u['rule'] == 10) {
                        $sl0 = 'selected="selected"';
                        $sl9 = '';
                        $sl1 = '';
                        $sl2 = '';
                        $sl3 = '';
                    } elseif ($u['rule'] == 1) {
                        $sl1 = 'selected="selected"';
                        $sl9 = '';
                        $sl0 = '';
                        $sl2 = '';
                        $sl3 = '';
                    } elseif ($u['rule'] == 66) {
                        $sl2 = 'selected="selected"';
                        $sl9 = '';
                        $sl0 = '';
                        $sl1 = '';
                        $sl3 = '';
                    } elseif ($u['rule'] == 33) {
                        $sl3 = 'selected="selected"';
                        $sl9 = '';
                        $sl0 = '';
                        $sl1 = '';
                        $sl2 = '';
                    }
                    echo '
<div class="card border-success border-bottom border-3 border-0">
            <div class="card-header">
              <h6 class="mb-0" data-anchor="data-anchor">Chỉnh Sửa: ' . $u['username'] . '</h6>
            </div>
            <div class="card-body">
              <p class="mb-0">';
                    if ($_GET['resetpass']) {
                        $id = $_GET['resetpass'];
                        $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$id' AND `site` = '$site'");
                        $tko = mysqli_num_rows($tko);
                        if ($tko != 0) {
                            $nr = rand(100000, 999999);
                            $npass = md5($nr);
                            $del = mysqli_query($db, "UPDATE `member` SET `password` = '$npass'
WHERE `username` = '$id' AND `site` = '$site'");
                            if ($del) {
                                echo 'Thay đổi mật khẩu User thành công, pass mới: ' . $nr . '<br>';
                            }
                        }
                    }
                    if (isset($_GET['activated_km'])) {
                        $id = $_GET['activated_km'];
                        $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$id' AND `site` = '$site'");
                        $tko = mysqli_num_rows($tko);
                        if ($tko != 0) {
                            if ($u['activated_km'] == 'true') {
                                $del = mysqli_query($db, "UPDATE `member` SET `activated_km` = 'false' WHERE `username` = '$id' AND `site` = 'mlike.vn'");
                                if ($del) {
                                    echo '<script>swal("Hệ Thống!","Đã hủy khuyến mãi cho User: ' . $id . '","success");</script>';
                                    echo '<script>setTimeout(function(){ window.location="' . $url . '";}, 2000);</script>';
                                }
                            } else {
                                $del = mysqli_query($db, "UPDATE `member` SET `activated_km` = 'true' WHERE `username` = '$id' AND `site` = 'mlike.vn'");
                                if ($del) {
                                    echo '<script>swal("Hệ Thống!","Đã kích hoạt khuyến mãi cho User: ' . $id . '","success");</script>';
                                }
                            }
                        }
                    }
                    echo '- Trạng Thái: ' . $quandz . '<br>- Số Tiền: ' . $u['vnd'] . '<br>- Kích Hoạt Khuyến Mãi: ' . $u['activated_km'] . '';
                    echo '<form action="" id="info" method="POST" accept-charset="utf-8" class="user">
<div class="mb-3"><label>Chọn chức vụ :</label><select name="cv" class="form-select mb-3" required="">
<Option value="10" ' . $sl0 . '>Block</option>
<option value="1" ' . $sl1 . '>Thành Viên</option>
<option value="33" ' . $sl2 . '>Cộng Tác Viên</option>
<option value="66" ' . $sl3 . '>Đại Lý</option>
<Option value="99" ' . $sl9 . '>Admin</option></select></div>
<div class="mb-3"><label>Chọn giá trị tiền:</label><select name="gt" class="form-select mb-3" required="">
<Option value="0">Không</option>
<option value="10">Cộng</option>
<Option value="5">Trừ</option></select></div>
<div class="mb-3"><label>Nhập số tiền:</label><input type="number" class="form-control mb-3" name="vnd" placeholder="1000" value="0" required=""></div>
<button type="submit" class="btn btn-success btn-rounded btn-block me-1 mb-1" name="st"><i class="fa fa-lock"></i> Chỉnh Sửa </button></form>
<br>
<a class="btn btn-warning btn-rounded btn-block me-1 mb-1" href="user?edit=' . $id . '&resetpass=' . $id . '" role="button"><i class="fa fa-trash"></i> Thay Đổi Pass</a>
<br>
<a class="btn btn-warning btn-rounded btn-block me-1 mb-1" href="user?edit=' . $id . '&activated_km=' . $id . '" role="button"><i class="fa fa-trash"></i> Kích Hoạt/Hủy Khuyến Mãi</a>
<a class="btn btn-danger btn-rounded btn-block me-1 mb-1" href="user?del=' . $id . '" role="button"><i class="fa fa-trash"></i> Xoá Thành Viên</a>
</p></div></div></p></div></div>';

                    require_once('../_System/end.php');

                    die();
                }
            }

            ?>
        </p>
        <div class="table-responsive scrollbar">
            <table class="table table-striped table-bordered" id="example">
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort" data-sort="id"><b>#</b></th>
                        <th class="sort" data-sort="user">Tên Tài Khoản</th>
                        <th class="sort" data-sort="name">Họ Và Tên</th>
                        <th class="sort" data-sort="sdt">SĐT</th>
                        <th class="sort" data-sort="email">Email</th>
                        <th class="sort" data-sort="email">Trạng Thái</th>
                        <th class="sort" data-sort="cv">Chức Vụ</th>
                        <th class="sort" data-sort="vnd">Số Tiền</th>
                        <th class="sort" data-sort="sd">Số Tiền Đã Dùng</th>
                        <th class="sort" data-sort="sd">Đăng Ký Cách Đây</th>
                        <th class="sort" data-sort="ip">Last IP Login</th>
                        <th class="sort" data-sort="ip">Last Time Login</th>
                        <th class="sort" data-sort="cn">Chức Năng</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php
                    $result1 = mysqli_query($db, "SELECT * FROM `member` WHERE `site` = '$site' ORDER BY id DESC");
                    if ($result1) {
                        while ($ro = mysqli_fetch_assoc($result1)) {
                            if ($ro['rule'] == 99) {
                                $cv = "Admin!";
                            } elseif ($ro['rule'] == 66) {
                                $cv = "Đại Lý";
                            } elseif ($ro['rule'] == 33) {
                                $cv = "Cộng Tác Viên";
                            } else {
                                $cv = "Thành Viên";
                            }
                            $vnd = $ro['vnd'];

                            $formattedNum = number_format($vnd);

                            $vnd = $formattedNum;
                    ?>
                            <tr>
                                <td class="id"><?php echo $ro['id']; ?></td>
                                <td class="user"><?php echo $ro['username']; ?></td>
                                <td class="name"><?php echo $ro['hoten']; ?></td>
                                <td class="sdt"><?php echo $ro['sdt']; ?></td>
                                <td class="email"><?php echo $ro['email']; ?></td>
                                <td class="email"><?php if ($ro['is_verify_mail'] == 'true') {
                                                        echo 'Đã Xác Minh';
                                                    } else {
                                                        echo 'Chưa Xác Minh';
                                                    } ?></td>
                                <td class="cv"><?php echo $cv; ?></td>
                                <td class="vnd"><?php echo $vnd; ?> ₫</td>
                                <td class="sd"><?php $vnd = $ro['sd'];
                                                $formattedNum = number_format($vnd);
                                                $vnd = $formattedNum;
                                                echo $vnd; ?> ₫</td>
                                <td class="ip"><?= time_func($ro['time']); ?></td>
                                <td class="ip"><?= $ro['last_ip_login']; ?></td>
                                <td class="ip"><?= time_func($ro['last_time_login']); ?></td>
                                <td class="cn"><a class="btn btn-success" href="?edit=<?= $ro['username']; ?>"><i class="fa fa-edit"></i> Edit</a></td>
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

<?php
require_once('../_System/end.php');
?>