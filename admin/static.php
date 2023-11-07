<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Thống Kê Hệ Thống";
require_once('../_System/head.php');
require_once('../_System/function.php'); //gọi function hỗ trợ thống kê

date_default_timezone_set('Asia/Ho_Chi_Minh');
$tz = new DateTimeZone('Asia/Ho_Chi_Minh');
$tomorrow = date("Y-m-d 00:00:00", strtotime("yesterday") + 86400);
$tomorrow = strtotime($tomorrow);

$yesterday = $tomorrow - 86400;

$firstDay = new DateTime('first day of this month', $tz);
$firstDay = $firstDay->format("Y-m-d");
$firstDay = strtotime($firstDay);


?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Thống Kê Chi Tiêu </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="mb-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="card-title text-primary">
                                Tổng Số Dư Thành Viên:
                            </div>
                            <p class="card-text">
                                <?php $res = mysqli_query($db, 'SELECT sum(vnd) FROM member');
                                $row = mysqli_fetch_row($res);
                                $sum = $row[0];
                                echo number_format($sum); ?>₫
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="mb-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="card-title text-primary">
                                Tổng Số Tiền Thành Viên Đã Dùng:
                            </div>
                            <p class="card-text">
                                <?php $res = mysqli_query($db, 'SELECT sum(sd) FROM member');
                                $row = mysqli_fetch_row($res);
                                $sum = $row[0];
                                echo number_format($sum); ?>₫
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">Facebook Like</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("Like", $tomorrow, "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("Like", $firstDay, "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("Like", $tomorrow, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("Like", $yesterday, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("Like", $firstDay, "dichvu"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">Facebook Follow</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Follow Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("Sub", "$tomorrow", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Follow Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("Sub", "$firstDay", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("Sub", $tomorrow, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("Sub", $yesterday, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("Sub", $firstDay, "dichvu"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">Facebook Comment</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Cmt Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("Cmt", "$tomorrow", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Cmt Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("Cmt", "$firstDay", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("Cmt", $tomorrow, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("Cmt", $yesterday, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("Cmt", $firstDay, "dichvu"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook Share</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Share Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("Share", "$tomorrow", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Share Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("Share", "$firstDay", "sl", "dichvu"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("Share", $tomorrow, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("Share", $yesterday, "dichvu"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("Share", $firstDay, "dichvu"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook View Video</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("view", "$tomorrow", "sl", "video"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("view", "$firstDay", "sl", "video"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("view", $tomorrow, "video"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("view", $yesterday, "video"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("view", $firstDay, "video"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook Mắt Video</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Mắt Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("mat", "$tomorrow", "sl", "video"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Mắt Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("mat", "$firstDay", "sl", "video"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("mat", $tomorrow, "video"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("mat", $yesterday, "video"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("mat", $firstDay, "video"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook Member Group</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Member Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("fb_group", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Member Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("fb_group", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("fb_group", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("fb_group", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("fb_group", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook Like Fanpage</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("fb_page", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("fb_page", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("fb_page", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("fb_page", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("fb_page", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook Like Cảm Xúc</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("fb_feeling", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("fb_feeling", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("fb_feeling", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("fb_feeling", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("fb_feeling", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Facebook View Story</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("fb_viewstory", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("fb_viewstory", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("fb_viewstory", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("fb_viewstory", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("fb_viewstory", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Instagram Follow</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Follow Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ins_follow", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Follow Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ins_follow", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ins_follow", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ins_follow", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ins_follow", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Instagram Like</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ins_like", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ins_like", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ins_like", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ins_like", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ins_like", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">TikTok Follow</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Follow Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_follow", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Follow Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_follow", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("tiktok_follow", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("tiktok_follow", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("tiktok_follow", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">TikTok Like</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_like", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_like", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("tiktok_like", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("tiktok_like", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("tiktok_like", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">TikTok Like Tay</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Like Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_like_tay", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Like Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_like_tay", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("tiktok_like_tay", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("tiktok_like_tay", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("tiktok_like_tay", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">TikTok View</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_view", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("tiktok_view", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("tiktok_view", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("tiktok_view", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("tiktok_view", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Instagram View</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ins_view", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ins_view", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ins_view", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ins_view", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ins_view", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">YouTube Subscribe</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số Sub Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ytb_sub", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Sub Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ytb_sub", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ytb_sub", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ytb_sub", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ytb_sub", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">YouTube View</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ytb_view", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ytb_view", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ytb_view", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ytb_view", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ytb_view", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Website View</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Số View Hôm Nay<span class="badge bg-primary rounded-pill"><? echo fb("ws_view", "$tomorrow", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng View Tháng Này<span class="badge bg-primary rounded-pill"><? echo fb("ws_view", "$firstDay", "sl", "dv_other"); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= total("ws_view", $tomorrow, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= total("ws_view", $yesterday, "dv_other"); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= total("ws_view", $firstDay, "dv_other"); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Tổng Số Doanh Thu</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Nay <span class="badge bg-primary rounded-pill"><?= totalall($tomorrow); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Hôm Qua <span class="badge bg-primary rounded-pill"><?= totalall($yesterday); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Lãi Tháng Này <span class="badge bg-primary rounded-pill"><?= totalall($firstDay); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-4">

                <h6 class="mb-0 text-uppercase">Thông Tin Thêm</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <p class="list-group">- Code By: <strong>Hứa Đức Quân</strong><br>- Code được viết bằng <?= 256 + 529; ?> dòng, giá mỗi dòng là 1.000 vnđ, đề nghị <big><strong>Đại Gia</strong></big> thanh toán đúng thời hạn, xin cảm ơn!!!!!!</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php
require_once('../_System/end.php');
?>