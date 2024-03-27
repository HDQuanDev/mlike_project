<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Chỉnh Sửa WebSite";
require_once('../_System/head.php');

if (isset($_POST['web'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $des = mysqli_real_escape_string($db, $_POST['des']);
    $key = mysqli_real_escape_string($db, $_POST['key']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
    $link = mysqli_real_escape_string($db, $_POST['linkfb']);
    $thongbao = mysqli_real_escape_string($db, $_POST['thongbao']);
    $tbshare = mysqli_real_escape_string($db, $_POST['tbshare']);
    $noteref = mysqli_real_escape_string($db, $_POST['noteref']);
    $user = mysqli_real_escape_string($db, $_POST['user']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $tlc = mysqli_real_escape_string($db, $_POST['tlc']);
    $auto = mysqli_real_escape_string($db, $_POST['auto']);
    $tlcsv = mysqli_real_escape_string($db, $_POST['tlcsv']);
    $ndck = mysqli_real_escape_string($db, $_POST['ndck']);
    $ttck = mysqli_real_escape_string($db, $_POST['ttck']);
    $tdssv = mysqli_real_escape_string($db, $_POST['tdssv']);
    $svviewfb = mysqli_real_escape_string($db, $_POST['svviewfb']);
    $svfollowfb = mysqli_real_escape_string($db, $_POST['svfollowfb']);
    /*$quan = text(''.$thongbao.'');
$hi = json_decode($quan);
$lin = $hi->async;
sleep(10);
$data = file_get_contents($lin);
$name = rand(1,9999999999);
$myFile = "../voice/quan-$name.mp3";
    $fh = fopen($myFile, 'w');
    fwrite($fh, $data);
    fclose($fh);*/
    mysqli_query($db, "UPDATE `system` SET `title`= '$title',`des`='$des',`key`='$key',`thongbao`='$thongbao',`linkfb`='$link', `mail` = '$mail', `user`='$user', `pass`='$pass', `noteref`='$noteref', `tbshare`='$tbshare', `token`='$token', `tlc`='$tlc', `xule_or_banlike`='$auto', `tlc6_or_tlc10`='$tlcsv', `tds_or_xule`='$tdssv', `ndck`='$ndck', `ttck`='$ttck', `congtac_viewfb`='$svviewfb', `congtac_followfb`='$svfollowfb' WHERE `site` = '$site'");
    echo "<script>swal('Hệ Thống!','Cập nhật Website Thành Công!','success');</script>";
    echo '<script>setTimeout(function(){
    window.location="' . $url . '";
}, 3000);</script>';
}
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="mb-0" data-anchor="data-anchor">Cài Đặt Website</h5>
    </div>
    <div class="card-body">
        <p class="mb-0">
        <form action="" id="info" method="POST" accept-charset="utf-8" class="user">
            <div class="mb-3">
                <label>Tiêu Đề Trang:</label>
                <input type="text" class="form-control mb-3" name="title" value="<?= $s['title']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Mô Tả :</label>
                <input type="text" class="form-control mb-3" name="des" value="<?= $s['des']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Keywords:</label>
                <input type="text" class="form-control mb-3" name="key" value="<?= $s['key']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Link Facebook:</label>
                <input type="text" class="form-control mb-3" name="linkfb" value="<?= $s['linkfb']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Nội Dung Chuyẻn Khoản (Nội dung + user):</label>
                <input type="text" class="form-control mb-3" name="ndck" value="<?= $s['ndck']; ?>" required="">
            </div>
            
            <div class="mb-3">
                <label>Địa chỉ Email Admin:</label>
                <input type="email" class="form-control mb-3" name="mail" value="<?= $s['mail']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Sửa Lưu Ý Nạp Tiền:</label>
                <textarea class="form-control mb-3" name="ttck" rows="5"><?= $s['ttck']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Sửa Thông Báo:</label>
                <textarea class="form-control mb-3" name="thongbao" rows="5"><?= $s['thongbao']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Sửa Nội Dung Giới Thiệu:</label>
                <textarea class="form-control mb-3" name="noteref" rows="5"><?= $s['noteref']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Sửa Lưu Ý Buff Share:</label>
                <textarea class="form-control mb-3" name="tbshare" rows="5"><?= $s['tbshare']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Tài Khoản TDS:</label>
                <input type="text" class="form-control mb-3 " name="user" value="<?= $s['user']; ?>" required="">
            </div>
            <div class="mb-3">
                <label>Mật Khẩu TDS:</label>
                <input type="password" class="form-control mb-3" name="pass" value="<?= $s['pass']; ?>" required="">
            </div>
            <div class="form-group">
                <label>Chọn server chạy đại lý/limited</label>
                <select class="form-select" aria-label="Default select example" name="auto" required="">
                    <option value="xule" selected="">Chạy bằng xu lẻ</option>
                    <option value="bao">Bao Star</option>
                    <option value="tlc">TangLikeCheo</option>
                    <option value="tds">TraoDoiSub</option>
                </select>
                <b>Hiện tại đang là: <?=$s['xule_or_banlike'];?></b><br>
            </div>
            <div class="form-group">
                <label>Chọn server like 1 chạy:</label>
                <select class="form-select" aria-label="Default select example" name="tdssv" required="">
                    <option value="tds" selected="">TraoDoiSub</option>
                    <option value="xule">Xu Lẻ</option>
                    <option value="bao">Bao Star</option>
                    <option value="tlc">TangLikeCheo</option>
                </select>
                <b>Hiện tại đang là: <?=$s['tds_or_xule'];?></b><br>
            </div>
            <div class="form-group">
                <label>Chọn server tlc chạy server 2:</label>
                <select class="form-select" aria-label="Default select example" name="tlcsv" required="">
                    <option value="tlc6" selected="">Server 4đ</option>
                    <option value="tlc10">Server 10đ</option>
                </select>
                <b>Hiện tại đang là: <?=$s['tlc6_or_tlc10'];?></b><br>
            </div>
            <div class="form-group">
                <label>Chọn server View fb</label>
                <select class="form-select" aria-label="Default select example" name="svviewfb" required="">
                    <option value="tay" selected="">Chạy bằng Tay</option>
                    <option value="uutien">Server ưu tiên</option>
                    <option value="autofb">Server Autofb</option>
                </select>
                <b>Hiện tại đang là: <?=$s['congtac_viewfb'];?></b><br>
            </div>
            <div class="form-group">
                <label>Chọn server follow fb</label>
                <select class="form-select" aria-label="Default select example" name="svfollowfb" required="">
                    <option value="tay" selected="">Chạy bằng Tay</option>
                    <option value="sgr">Server SGR</option>
                </select>
                <b>Hiện tại đang là: <?=$s['congtac_followfb'];?></b><br>
            </div>
                    <div class="mb-3">
                        <label>Token Facebook:</label>
                        <textarea class="form-control mb-3" name="token" rows="5"><?= $s['token']; ?></textarea>
                        <label><strong>(*)</strong> Chỉ nhập 1 token</label>
                    </div>
                    <div class="mb-3">
                        <label>Token TangLikeCheo:</label>
                        <textarea class="form-control mb-3" name="tlc" rows="5"><?= $s['tlc']; ?></textarea>
                        <label><strong>(*)</strong> Update bằng 1 lần paste</label>
                    </div>
                    <button type="submit" class="btn btn-info btn-rounded btn-block" name="web"><i class="fas fa-edit"></i> Lưu</button>
                    </p>
            </div>
    </div>
    <?php
    require_once('../_System/end.php');
?>