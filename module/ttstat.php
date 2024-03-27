<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thống Kê LOG TikTok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        $hdq = "ok";
        require_once('../_System/db.php');
        ?>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TIKTOK VIEW</h5>
                        <p class="card-text">
                            <?php
                            $ctime = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `profile` > '0' AND `time` > '1703955600' AND (`trangthai` = '1' OR `trangthai` = '3')");
        $ctime = mysqli_num_rows($ctime);
        $stat = mysqli_query($db, "SELECT * FROM `ttstat` WHERE `id` = '1'");
        $stat = mysqli_fetch_assoc($stat);
        $luong = $stat['luong'];
        $ltime = $stat['time'];
        $sleep = $stat['sleep'];
        $rtime = $stat['timerun'];
        $success = $stat['success'];
        $error = $stat['error'];
        $time = time();
        $gtime = $ctime / $luong * $ltime * 60;
        $mtime = $gtime + $time + $sleep;
        echo '- Số đơn còn lại: <b>' . $ctime . '</b> (Đơn)<br>
                - Luồng đang chạy: <b>' . $luong . '</b> (Threads)<br>
                - Thời gian cách mỗi lần chạy: <b>' . $ltime . '</b> (Phút)<br>
                - Thời gian để chạy hết 1 vòng đơn: <b>' . $gtime . '</b> (Giây)<br>
                - Thời gian nghỉ khi chạy hết 1 vòng đơn: <b>' . $sleep . '</b> (Giây)<br>
                - Thời gian chạy gần nhất: <b>' . date('H:i:s - d/m', $rtime) . '</b> (Thời Gian)<br>
                - Số đơn đã chạy thành công: <b>' . $success . '</b> (Đơn)<br>
                - Số đơn đã chạy không thành công: <b>' . $error . '</b> (Đơn)';
        ?>
                            <center>
                                <h4>Log Run:</h4>
                            </center>
                            <iframe src="/tiktok_mod/logview.txt?v=<?= time(); ?>" width="100%" height="300" scrolling="auto" style="border:1px solid black;">
                            </iframe>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TIKTOK LIKE</h5>
                        <p class="card-text">
                            <?php
        $ctime = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like' AND `profile` > '0' AND `time` > '1703955600' AND (`trangthai` = '1' OR `trangthai` = '3')");
        $ctime = mysqli_num_rows($ctime);
        $stat = mysqli_query($db, "SELECT * FROM `ttstat` WHERE `id` = '2'");
        $stat = mysqli_fetch_assoc($stat);
        $luong = $stat['luong'];
        $ltime = $stat['time'];
        $sleep = $stat['sleep'];
        $rtime = $stat['timerun'];
        $success = $stat['success'];
        $error = $stat['error'];
        $time = time();
        $gtime = $ctime / $luong * $ltime * 60;
        $mtime = $gtime + $time + $sleep;
        echo '- Số đơn còn lại: <b>' . $ctime . '</b> (Đơn)<br>
                - Luồng đang chạy: <b>' . $luong . '</b> (Threads)<br>
                - Thời gian cách mỗi lần chạy: <b>' . $ltime . '</b> (Phút)<br>
                - Thời gian để chạy hết 1 vòng đơn: <b>' . $gtime . '</b> (Giây)<br>
                - Thời gian nghỉ khi chạy hết 1 vòng đơn: <b>' . $sleep . '</b> (Giây)<br>
                - Thời gian chạy gần nhất: <b>' . date('H:i:s - d/m', $rtime) . '</b> (Thời Gian)<br>
                - Số đơn đã chạy thành công: <b>' . $success . '</b> (Đơn)<br>
                - Số đơn đã chạy không thành công: <b>' . $error . '</b> (Đơn)';
        ?>
                            <center>
                                <h4>Log Run:</h4>
                            </center>
                            <iframe src="/tiktok_mod/loglike.txt?v=<?= time(); ?>" width="100%" height="300" scrolling="auto" style="border:1px solid black;">
                            </iframe>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>