<?php
$admin = '1';
require_once('../_System/db.php');
$title = "Thống Kê Hệ Thống";
require_once('../_System/head.php');


function total($dv, $type, $num = 0)
{
    global $db;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
    $tomorrow = date("Y-m-d 00:00:00", strtotime("yesterday") + 86400);
    $tomorrow = strtotime($tomorrow);

    $yesterday = $tomorrow - 86400;

    $firstDay = new DateTime('first day of this month', $tz);
    $firstDay = $firstDay->format("Y-m-d");
    $firstDay = strtotime($firstDay);

    // Initialize stats array
    $stats = array(
        'todayPurchases' => 0,
        'monthPurchases' => 0,
        'todayProfit' => 0,
        'yesterdayProfit' => 0,
        'monthProfit' => 0
    );

    // Query to get all purchases for this service
    $result = mysqli_query($db, "SELECT * FROM `$type` WHERE `dv` = '$dv'");

    while ($ro = mysqli_fetch_assoc($result)) {
        $purchaseTime = $ro['time'];
        $sotien = $ro['sotien'];
        $sl = $ro['sl'];
        $so = $sotien;

        if ($purchaseTime >= $tomorrow) {
            $stats['todayPurchases'] += $sl;
            $stats['todayProfit'] += $so;
        }

        if ($purchaseTime >= $yesterday && $purchaseTime < $tomorrow) {
            $stats['yesterdayProfit'] += $so;
        }

        if ($purchaseTime >= $firstDay) {
            $stats['monthPurchases'] += $sl;
            $stats['monthProfit'] += $so;
        }
    }

    return json_encode($stats);
}

function totalall()
{
    global $db;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
    $tomorrow = date("Y-m-d 00:00:00", strtotime("yesterday") + 86400);
    $tomorrow = strtotime($tomorrow);
    $yesterday = $tomorrow - 86400;
    $firstDay = new DateTime('first day of this month', $tz);
    $firstDay = $firstDay->format("Y-m-d");
    $firstDay = strtotime($firstDay);
    $stats = [
        'todayProfit' => 0,
        'yesterdayProfit' => 0,
        'monthProfit' => 0
    ];

    $tables = ['dichvu', 'dv_other', 'video'];

    foreach ($tables as $table) {
        $result = mysqli_query($db, "SELECT * FROM `$table`");

        while ($ro = mysqli_fetch_assoc($result)) {
            $purchaseTime = $ro['time'];
            $sotien = $ro['sotien'];

            if ($purchaseTime >= $tomorrow) {
                $stats['todayProfit'] += $sotien;
            }

            if ($purchaseTime >= $yesterday && $purchaseTime < $tomorrow) {
                $stats['yesterdayProfit'] += $sotien;
            }

            if ($purchaseTime >= $firstDay) {
                $stats['monthProfit'] += $sotien;
            }
        }
    }

    return json_encode($stats);
}

$listdv = 'Like,dichvu,Tăng Like Facebook|Sub,dichvu,Tăng Follow Facebook|Cmt,dichvu,Tăng Comment Facebook|Share,dichvu,Tăng Share Facebook|view,video,Tăng View Video Facebook|mat,video,Tăng Mắt Video Facebook|fb_group,dv_other,Tăng Member Group Facebook|fb_page,dv_other,Tăng Like Fanpage Facebook|fb_feeling,dv_other,Tăng Like Cảm Xúc Facebook|fb_viewstory,dv_other,Tăng View Story Facebook|ins_follow,dv_other,Tăng Follow Instagram|ins_like,dv_other,Tăng Like Instagram|ins_view,dv_other,Tăng View Instagram|tiktok_follow,dv_other,Tăng Follow TikTok|tiktok_like,dv_other,Tăng Like TikTok|tiktok_like_tay,dv_other,Tăng Like Tay TikTok|tiktok_view,dv_other,Tăng View TikTok|ytb_sub,dv_other,Tăng Sub YouTube|ytb_view,dv_other,Tăng View YouTube';
?>
<div class="card border-danger border-bottom border-3 border-0">
    <div class="card-header">
        <h5 class="card-title">Thống Kê Chi Tiêu </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="mb-4">
                    <div class="card">
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
                    <div class="card">
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
            <?php
            $ex = explode('|', $listdv);
            foreach ($ex as $dv) {
                $ex2 = explode(',', $dv);
                $dichvu = $ex2[0];
                $table = $ex2[1];
                $name = $ex2[2];
                $res = total($dichvu, $table);
                $get = json_decode($res, true);
                $todayPurchases = $get['todayPurchases'];
                $monthPurchases = $get['monthPurchases'];
                $todayProfit = $get['todayProfit'];
                $yesterdayProfit = $get['yesterdayProfit'];
                $monthProfit = $get['monthProfit'];
            ?>
                <div class="col-12 col-xl-4">
                    <h6 class="mb-0 text-uppercase"><?= $name; ?></h6>
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Số Lượng Mua Hôm Nay<span class="badge bg-primary rounded-pill"><?= number_format($todayPurchases); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Số Lượng Mua Tháng Này<span class="badge bg-primary rounded-pill"><?= number_format($monthPurchases); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tiền Hôm Nay <span class="badge bg-primary rounded-pill"><?= number_format($todayProfit); ?>₫</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tiền Hôm Qua <span class="badge bg-primary rounded-pill"><?= number_format($yesterdayProfit); ?>₫</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tháng Tháng Này <span class="badge bg-primary rounded-pill"><?= number_format($monthProfit); ?>₫</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php
            }
            $get = json_decode(totalall(), true);
            $todayProfit = $get['todayProfit'];
            $yesterdayProfit = $get['yesterdayProfit'];
            $monthProfit = $get['monthProfit'];
            ?>
            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">Tổng Số Doanh Thu</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tiền Hôm Nay <span class="badge bg-primary rounded-pill"><?= number_format($todayProfit); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tiền Hôm Qua <span class="badge bg-primary rounded-pill"><?= number_format($yesterdayProfit); ?>₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng Tiền Tháng Này <span class="badge bg-primary rounded-pill"><?= number_format($monthProfit); ?>₫</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <h6 class="mb-0 text-uppercase">Thông Tin</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Phiên Bản <span class="badge bg-primary rounded-pill">1.0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">PHP Vesrion <span class="badge bg-primary rounded-pill"><?= phpversion(); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">MySQL Version <span class="badge bg-primary rounded-pill"><?= mysqli_get_server_info($db); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('../_System/end.php');
?>