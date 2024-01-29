<?php
require_once('db.php');

// Get IP address of the client
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipp = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipp = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipp = $_SERVER['REMOTE_ADDR'];
}

// Function to perform a count query
function countRows($db, $table, $condition = '')
{
    $query = "SELECT COUNT(*) as count FROM `$table` $condition";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Update online users or insert if not exists
$timeon = time();
$onus = $login ? $login : '123';
$titl = $title ? "$title | {$s['title']}" : $s['title'];
$ipCount = countRows($db, 'online', "WHERE `ip` = '$ipp' AND `site` = '$site'");
if ($login) {
    mysqli_query($db, "UPDATE `member` SET `last_ip_login` = '$ipp', `last_time_login` = '$timeon' WHERE `username` = '$login' AND `site` = '$site'");
}

if ($ipCount >= 1) {
    mysqli_query($db, "UPDATE `online` SET `time` = '$timeon', `user` = '$onus', `title` = '$titl' WHERE `ip` = '$ipp' AND `site` = '$site'");
} else {
    mysqli_query($db, "INSERT INTO `online` (`ip`, `user`, `time`, `title`, `site`) VALUES ('$ipp', '$onus', '$timeon', '$titl', '$site')");
}

// Redirect users to update info page if necessary
if ($uif != '1' && $login && $row['active'] == '1') {
    header('Location: /user_update_info.php');
    die();
}

// Count rows for various tables
$ls = countRows($db, 'lichsu', "WHERE `user` = '" . $_SESSION['u'] . "' AND `site` = '$site'");
$dz = time() - 300;
$ckid = countRows($db, 'online', "WHERE `time` > '$dz' AND `site` = '$site'");
if ($row['rule'] == '99') {
    $dv = countRows($db, 'dichvu', "WHERE `bh` = '1' AND `nse` < '3' AND `site` = '$site'");
    $bh = countRows($db, 'dichvu', "WHERE `bh` = '2' AND `nse` = '3' AND `site` = '$site'");
    $cm = countRows($db, 'dichvu', "WHERE `dv` = 'Cmt' AND `site` = '$site'");
    $pg = countRows($db, 'dv_other', "WHERE `dv` = 'fb_page' AND `nse` = 'Server Fanpage 2' AND `site` = '$site'");
    $sv_4 = countRows($db, 'dichvu', "WHERE `dv` = 'Like' AND `site` = '$site' AND `nse`='444'");
    $sv_cmt = countRows($db, 'dv_other', "WHERE `dv` = 'fb_likecmt' AND `site` = '$site' AND `bh`='444'");
    $vt = countRows($db, 'video', "WHERE `code` = '14' AND `site` = '$site'");
    $sub = countRows($db, 'dichvu', "WHERE `dv` = 'Sub' AND `site` = '$site'");
    $lt = countRows($db, 'dichvu', "WHERE (`bh` = '1' OR `bh` = '3') AND (`nse` IN ('4', 'Server Share 3', 'Server Share 4', 'Server Follow 1')) AND `site` = '$site'");
    $tv = countRows($db, 'member', "WHERE `site` = '$site'");
    $his = countRows($db, 'lichsu', "WHERE `site` = '$site'");
    $vd = countRows($db, 'video', "WHERE `site` = '$site'");
    $mm = countRows($db, 'momo', "WHERE `site` = '$site'");
    $likettt = countRows($db, 'dv_other', "WHERE `dv` = 'tiktok_like_tay'");
    $viewtt = countRows($db, 'dv_other', "WHERE `dv` = 'tiktok_view' AND `nse` = 'Server View 1'");
}
?>


<!doctype html>

<html lang="vi-VN">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= $cdn; ?>/images/icon.png" type="image/png" />
    <meta itemprop="image" content="<?= $cdn; ?>/images/top.png">
    <meta name="author" content="Nguyễn Ngọc Thanh Sang">
    <!-- seo facebook -->
    <meta property="og:url" content="<?= $url; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Đănh Nhập Tài Khoản MLIKE" />
    <meta property="og:description" content="Cung cấp Dịch vụ fb, instagram , tiktok, youtube siêu rẻ, ở đâu rẻ hơn Mlike rẻ hơn nữa" />
    <meta name="revisit-after" content="1 days" />
    <meta property="og:image" content="<?= $cdn; ?>/images/top.png" />
    <!--plugins-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?t=<?= time(); ?>" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/quan.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/vector-map.css">
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/datatables.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/style.css">
    <link id="color" rel="stylesheet" href="<?= $cdn; ?>/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/responsive.css">
    <script src="<?= $cdn; ?>/js/jquery-3.6.0.min.js"></script>
    <!-- manifest meta -->
    <link rel="manifest" href="/manifest.json">
    <title><?= $titl; ?></title>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</head>


<body onload="startTime()">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Tivo .." name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
                    <div class="logo-header-main"><a href="/"><img class="img-fluid for-light img-100" src="<?= $cdn; ?>/images/logo/logo2.png" alt=""><img class="img-fluid for-dark" src="<?= $cdn; ?>/images/logo/logo.png" alt=""></a></div>
                </div>
                <div class="left-header col horizontal-wrapper ps-0">
                    <div class="left-menu-header">
                    </div>
                </div>
                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li>
                            <div class="right-header ps-0">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text mobile-search"><i class="fa fa-search"></i></span></div>
                                    <input class="form-control" type="text" placeholder="Search Here........">
                                </div>
                            </div>
                        </li>
                        <li class="serchinput">
                            <div class="serchbox"><i data-feather="search"></i></div>
                            <div class="form-group search-form">
                                <input type="text" placeholder="Search here...">
                            </div>
                        </li>
                        <li>
                            <div class="mode"><i class="fa fa-lightbulb-o"></i></div>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box"><span class="badge rounded-pill badge-primary"> <?= $ls; ?></span><i data-feather="bell"></i></div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li><i data-feather="bell"> </i>
                                    <h6 class="f-18 mb-0">Lịch Sử Hoạt Động</h6>
                                </li>
                                <?php
                                $hiss = mysqli_query($db, "SELECT * FROM `lichsu` WHERE `user` = '$login' AND `site` = '$site' ORDER BY id DESC LIMIT 8");
                                while ($his = mysqli_fetch_assoc($hiss)) {
                                    $loai = $his['loai'];
                                    $sotien = $his['bd'];
                                    $kyhieu = $his['gt'];
                                    $tim = $his['time'];

                                    switch ($loai) {
                                        case '1':
                                            $sloai = 'Mua Dịch Vụ ' . $kyhieu . '' . number_format($sotien) . 'đ';
                                            $icon = 'shopping-cart';
                                            break;
                                        case '2':
                                            $sloai = 'Nạp Tiền ' . $kyhieu . '' . number_format($sotien) . 'đ';
                                            $icon = 'shopping-bag';
                                            break;
                                        case '3':
                                            $sloai = 'Thay Đổi Thông Tin';
                                            $icon = 'edit-3';
                                            break;
                                        default:
                                            $sloai = 'Dịch Vụ Không Xác Định';
                                            $icon = 'help-circle';
                                    }
                                ?>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0"><i data-feather="<?= $icon; ?>"></i></div>
                                            <div class="flex-grow-1">
                                                <p><a href="#"><?= $sloai; ?></a><span class="pull-right"><?php echo time_func($tim); ?></span></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>

                                <li><a class="btn btn-primary" href="/history.php">Xem Chi Tiết & Tất Cả</a></li>
                            </ul>
                        </li>

                        <li class="maximize"><a href="#" onclick="javascript:toggleFullScreen()"><i data-feather="maximize-2"></i></a></li>
                        <li class="onhover-dropdown">
                            <div class="message"><span class="badge rounded-pill badge-success"> <?= $ckid; ?></span><i data-feather="star"></i>
                            </div>
                            <ul class="message-dropdown onhover-show-div">
                                <li><i data-feather="star"> </i>
                                    <h6 class="f-18 mb-0">Thành Viên Trực Tuyến</h6>
                                </li>
                                <li>
                                    <div class="d-flex align-items-start">
                                        <div class="message-img bg-light-primary"><img src="https://ui-avatars.com/api/?background=random&name=QDEVS" alt="QUANDEV"></div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1"><a href="https://www.facebook.com/quancp72h" target="_blank" data-bs-original-title="" title=""><span style="color:red;">Hứa Đức Quân</span> (Lập Trình Viên)</style="color:red;"></a></h5>
                                            <p>Đang ở: <strong>[Admin Privacy Protection]</strong></p>
                                        </div>

                                    </div>
                                </li>
                                <?php
                                $ipp = mysqli_query($db, "SELECT * FROM `online` WHERE `time` >= '$dz' AND `site` = '$site' AND `user` != 'dramasee' ORDER BY id LIMIT 5");
                                while ($ip = mysqli_fetch_assoc($ipp)) {
                                    $name = ($ip['user'] !== '123') ? $ip['user'] : 'Khách ghé thăm';

                                    if ($name !== 'Khách ghé thăm') {
                                        $onl = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$name' AND `site` = '$site'");
                                        $ttonl = mysqli_fetch_assoc($onl);

                                        $rule = ($ttonl['rule'] == '99') ? '99' : '1';
                                        $img = 'https://ui-avatars.com/api/?background=random&name=' . $name;
                                    } else {
                                        $rule = '1';
                                        $img = 'https://ui-avatars.com/api/?background=random&name=' . $name;
                                    }
                                ?>
                                    <li>
                                        <div class="d-flex align-items-start">
                                            <div class="message-img bg-light-primary"><img src="<?= $img; ?>" alt=""></div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1"><a href="#">
                                                        <?php
                                                        if ($rule == '99') {
                                                            echo '<span style="color:red;">';
                                                        }
                                                        ?>
                                                        <?= $name; ?>
                                                        <?php
                                                        if ($rule == '99') {
                                                            if ($name == 'dramasee') {
                                                                echo '(Lập Trình Viên)';
                                                            } else {
                                                                echo '(Quản Trị Viên)';
                                                            }
                                                        }
                                                        ?>
                                                        </span></a></h5>
                                                <p>Đang ở: <?php
                                                            echo ($ttonl['rule'] == 99 && in_array($ttonl['username'], ['dramasee', 'BossSang'])) ? '<strong>[Admin Privacy Protection]</strong>' : $ip['title'];
                                                            ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </li>
                        <li class="profile-nav onhover-dropdown">
                            <div class="account-user"><i data-feather="user"></i></div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="/profile.php"><span>Trang cá nhân</span></a></li>
                                <li><a href="/payment.php"><span>Nạp tiền vào tài khoản</span></a></li>
                                <li><a href="/history.php"><span>Lịch sử hoạt động</span></a></li>
                                <li><a href="/logout.php"><span>Đăng Xuất</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper"><a href="/"><img class="img-fluid for-light" src="<?= $cdn; ?>/images/logo/logo.png" alt=""></a>
                        <div class="back-btn"><i data-feather="grid"></i></div>
                        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="/">
                            <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
                        </a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="menu-box">
                                    <ul>
                                        <li class="sidebar-list"><a class="sidebar-link" href="/"><i data-feather="home"></i><span>Trang Chủ</span></a></li>
                                        <?php
                                        if ($row['rule'] == 99) {
                                        ?>
                                            <li class="menu-box">
                                                <ul>
                                                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="monitor"> </i> <span>Bảng Điều Khiển</span></a>
                                                        <ul class="sidebar-submenu" style="font-size:10px;">
                                                            </a>
                                                            <li><a href="<?= $domain; ?>/admin/user.php"><i class="bx bx-right-arrow-alt"></i>Quản Lý Thành Viên <span class="badge bg-danger"><?= $tv; ?></span></a></li>
                                                            <li> <a href="/admin/dichvu.php"><i class="bx bx-right-arrow-alt"></i>Quản lý dịch vụ <span class="badge bg-danger"><?= $dv; ?></span></a></li>
                                                            <li> <a href="/admin/baohanh.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng bảo hành <span class="badge bg-danger"><?= $bh; ?></span></a></li>
                                                            <li> <a href="/admin/liketay.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng thủ công<span class="badge bg-danger"><?= $lt; ?></span></a></li>
                                                            <li><a href="/admin/comment.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng Comment<span class="badge bg-danger"><?= $cm; ?></span></a></li>
                                                            <li> <a href="/admin/like_sv4.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng Like SV4<span class="badge bg-danger"><?= $sv_4; ?></span></a></li>
                                                            <li> <a href="/admin/like_cmt.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng Like Cmt SV3<span class="badge bg-danger"><?= $sv_cmt; ?></span></a></li>
                                                            <li> <a href="/admin/viewtay.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng View Tay<span class="badge bg-danger"><?= $vt; ?></span></a></li>
                                                            <li> <a href="/admin/like_tiktok_tay.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng Like TikTok Tay<span class="badge bg-danger"><?= $likettt; ?></span></a></li>
                                                            <li> <a href="/admin/page.php"><i class="bx bx-right-arrow-alt"></i>Đơn hàng Like Page FB<span class="badge bg-danger"><?= $pg; ?></span></a></li>
                                                            <li> <a href="/admin/history.php"><i class="bx bx-right-arrow-alt"></i>Hoạt động của thành viên <span class="badge bg-danger"><?= $his; ?></span></a></li>
                                                            <li> <a href="/admin/setgia.php"><i class="bx bx-right-arrow-alt"></i>Set giá thành viên <span class="badge bg-warning">New</span></a></li>
                                                            <li><a href="/admin/momo.php"><i class="bx bx-right-arrow-alt"></i>Thống Kê Nạp Tiền MoMo <span class="badge bg-danger"><?= $mm; ?></span></a></li>
                                                            <li><a href="/admin/setting.php"><i class="bx bx-right-arrow-alt"></i>Cài đặt website</a></li>
                                                            <li><a href="/admin/nganhang.php"><i class="bx bx-right-arrow-alt"></i>Cài đặt ngân hàng</a></li>
                                                            <li><a href="/admin/control_panel"><i class="bx bx-right-arrow-alt"></i>Quản lý hệ thống</a></li>
                                                            <li><a href="/admin/gia.php"><i class="bx bx-right-arrow-alt"></i>Chỉnh giá dịch vụ</a></li>
                                                            <li> <a href="/admin/ref.php"><i class="bx bx-right-arrow-alt"></i>Thống kê giới thiệu</a></li>
                                                            <li><a href="/admin/static.php"><i class="bx bx-right-arrow-alt"></i>Thống kê chi tiêu</a></li>
                                                            <li> <a href="/admin/sieunhan.php"><i class="bx bx-right-arrow-alt"></i>Reset chức vụ</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li class="sidebar-list"><a class="sidebar-link" href="https://documenter.getpostman.com/view/17576313/VV4zNuAb"><i data-feather="edit-3"></i><span>Tài Liệu API</span></a></li>
                                        <li class="sidebar-list"><a class="sidebar-link" href="/payment.php"><i data-feather="folder-plus"></i><span>Nạp Tiền</span></a></li>
                                        <?php
                                        $list = 'Tiện Ích:list#Trang Cá Nhân|/profile.php!Lịch Sử Hoạt Động|/history.php!Tạo SITE CON|/sitecon.php
                                        Dịch Vụ Facebook:facebook#Tăng Like Post Kênh 1|/service/like.php!Bảo trì|/service/likev2.php!Tăng Cảm Xúc Bài Viết|/service/like_feeling.php!Tăng Like Comment Facebook|/service/likecmt.php!Bảo trì|/service/comment.php!Tăng Share Bài Viết|/service/share.php!Tăng Follow Facebook|/service/follow.php!Tăng Mắt Livestream|/service/live.php!Tăng Mắt Livestream V2|/service/live_v2.php!Tăng Like Fanpage|/service/page.php!Tăng Member Group|/service/group.php!Tăng View Video|/service/view.php!Vip Like Facebook|/service/viplike.php!Tăng View Story|/service/view_story.php
                                       Dịch Vụ Instagram:instagram#Tăng Like Bài Viết|/service/ins/like.php!Tăng Comment Instagram|/service/ins/comment.php!Tăng Follow Instagram|/service/ins/follow.php!Tăng View Instagram|/service/ins/view.php
                                       Dịch Vụ TikTok:trending-up#Tăng View Video|/service/tiktok/view.php!Tăng Tim TikTok|/service/tiktok/like.php!Bảo trì|/service/tiktok/like_v2.php!Tăng Save TikTok|/service/tiktok/save.php!Tăng Share TikTok|/service/tiktok/share.php!Tăng Follow TikTok|/service/tiktok/follow.php!Tăng Comment TikTok|/service/tiktok/comment.php!BẢO TRÌ|/service/tiktok/live.php
                                       Dịch Vụ YouTube:youtube#Tăng Like Video|/service/ytb/like.php!Tăng View Video|/service/ytb/view.php!Tăng Subscribe Kênh|/service/ytb/sub.php
                                       Dịch Vụ Khác:thumbs-up#Tăng traffic website .|/service/other/website.php';
                                        $arr = explode("\n", $list);
                                        foreach ($arr as $key => $value) {
                                            $quan = explode("#", $value);
                                            $main = $quan[0];
                                            $tach = explode(":", $main);
                                            $ten = $tach[0];
                                            $icon = $tach[1];
                                            $child = $quan[1];
                                            echo '
                                                <li class="menu-box">
                                            <ul>
                                                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="' . $icon . '"></i> <span>' . $ten . '</span></a>
                                                    <ul class="sidebar-submenu">';
                                            $arr = explode("!", $child);
                                            foreach ($arr as $key => $value) {
                                                $quan = explode("|", $value);
                                                $name = $quan[0];
                                                $link = $quan[1];
                                                echo '
                                                    <li><a href="' . $domain . '' . $link . '">' . $name . '</a></li>';
                                            }
                                            echo '</ul>
                                                </li>
                                            </ul>
                                        </li>';
                                        }
                                        ?>
                                        <li class="sidebar-list">
                                            <a href="https://zalo.me/0987777059" class="sidebar-link" target="_blank">
                                                <i data-feather="mail"></i>
                                                <span>Liên hệ Zalo Admin</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-list">
                                            <a href="https://mlike.vn/sanginfo/index.php" class="sidebar-link" target="_blank">
                                                <i data-feather="briefcase"></i>
                                                <span>Liên Hệ FB Admin</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-list">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-body text-center bg-dark border-card">
                                                        <p class="mb-0">
                                                            <img src="https://ui-avatars.com/api/?background=random&name=<?= $login; ?>" width="110" height="110" class="rounded-circle shadow" alt="">
                                                        <h5 class="mb-0 mt-5"><?= $login; ?></h5>
                                                        <p class="mb-3"><?= $cv; ?></p>
                                                        <div class="list-inline contacts-social mt-3 mb-3">
                                                        </div>
                                                        <div class="d-grid" style="color:white;"><span class="btn btn-outline-primary"><?= number_format($row['vnd']); ?>đ</a>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid dashboard-default">
                    <noscript>
                        <meta http-equiv="refresh" content="0; URL=/nojavascript.html">
                    </noscript>
                    <script type="text/JavaScript">
                        setInterval(() => {
    fetch('/api/check_payment.php?act=check', {
        method: 'POST'
    })
    .then(res => res.json())
    .then(data => {
        if (data.status == 'success' && data.show == '1'){
            swal({
                title: 'Thông Báo',
                text: data.message,
                icon: 'success',
                button: 'Đóng',
            }).then((value) => {
                location.reload();
            });
        }else if(data.show == '2'){
            window.location.href = '/landing.php';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}, 5000);
    function getCookie(name){
    var pattern = RegExp(name + "=.[^;]*");
    var matched = document.cookie.match(pattern);
    if(matched){
        var cookie = matched[0].split('=');
        return cookie[1];
    };
    return false;
    };
</script>
                    <div class="alert alert-success outline fade show" role="alert">
                        <p><b> Thông Báo! </b>Vui lòng đọc lưu ý trước khi dùng tránh mất tiền oan</p>
                    </div>
                    <?php
                    if ($row['active'] == '2' && $row['is_verify_mail'] == 'false' && $row['is_email_disposable'] == 'false') {
                        $email = $row['email'];
                        $validmail = json_decode(file_get_contents('https://mlike.vn/module/checkmail.php?mail=' . $email));
                        $checkmailCount = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `member` WHERE `email` = '$email' AND `is_verify_mail` = 'true'"));

                        $notificationMsg = '';
                        $notificationColor = '';
                        $modalId = '';

                        if ($checkmailCount > 1 || $validmail->data->disposable == true || $validmail->data->deliverable == false) {
                            $notificationMsg = 'Email của bạn đã được sử dụng bởi người khác, vui lòng <a style="color:green;" data-bs-toggle="modal" data-original-title="test" data-bs-target="#change_email" data-bs-original-title="" title="">Click tại đây</a> để đổi email khác để bảo mật tài khoản và sử dụng các chức năng quên mật khẩu,...';
                            $notificationColor = 'danger';
                            $modalId = 'change_email';
                        } elseif ($validmail->data->disposable == true) {
                            $notificationMsg = 'Email của bạn đang là email ảo, vui lòng <a style="color:green;" data-bs-toggle="modal" data-original-title="test" data-bs-target="#change_email" data-bs-original-title="" title="">Click tại đây</a> để đổi email khác để bảo mật tài khoản và sử dụng các chức năng quên mật khẩu,...';
                            $notificationColor = 'danger';
                            $modalId = 'change_email';
                        } elseif ($validmail->data->deliverable == false) {
                            $notificationMsg = 'Địa chỉ email của bạn hiện đang không thể nhận được thư, vui lòng <a style="color:green;" data-bs-toggle="modal" data-original-title="test" data-bs-target="#change_email" data-bs-original-title="" title="">Click tại đây</a> để đổi email khác để bảo mật tài khoản và sử dụng các chức năng quên mật khẩu,...';
                            $notificationColor = 'danger';
                            $modalId = 'change_email';
                        } elseif ($row['is_verify_mail'] == 'false') {
                            $notificationMsg = 'Email của bạn chưa được xác minh, vui lòng <a style="color:green;" data-bs-toggle="modal" data-original-title="test" data-bs-target="#verify_email" data-bs-original-title="" title="">Click tại đây</a> để xác minh email để bảo mật tài khoản và sử dụng các chức năng quên mật khẩu,...';
                            $notificationColor = 'warning';
                            $modalId = 'verify_email';
                        }

                        if (!empty($notificationMsg)) {
                            $showNotification = true;
                        }
                    }

                    if ($showNotification) {
                    ?>
                        <div class="alert alert-<?= $notificationColor; ?> outline fade show" role="alert">
                            <p><b> Thông Báo! </b><?= $notificationMsg; ?></p>
                        </div>
                    <?php
                    }
                    if ($modalId == 'verify_email') {
                    ?>
                        <div class="modal fade" id="verify_email" tabindex="-1" role="dialog" aria-labelledby="verify_emailLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác Minh Email Của Bạn</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="theme-form">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="inputEmailAddress" class="form-label">Địa chỉ email của bạn</label>
                                                    <input type="email" class="form-control" id="email" value="<?= $row['email']; ?>" readonly>
                                                </div>
                                                <button class="btn btn-secondary btn-block w-100" type="button" onClick="send_mail()" id="button_send_mail">Gửi Code</button>
                                            </div>
                                            <div class="col-12">
                                                <span id="mail_code"></span>
                                            </div>
                                            <div class="col-12">
                                                <span id="result_send_mail"></span>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Đóng</button>
                                        <button class="btn btn-secondary" type="button" onclick="verify()" id="button_send_hi">Xác Nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function send_mail() {
                                $('#button_send_mail')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                                $("#button_send_mail").prop("disabled", true);
                                $.ajax({
                                    url: "/module/sendmail.php",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        email: "<?= $row["email"]; ?>",
                                        name: "<?= $row["hoten"]; ?>",
                                    },
                                    success: function(response) {
                                        if (response.status == 200) {
                                            $("#button_send_mail").prop("disabled", true);
                                            swal("Thông Báo", response.message, "success");
                                            $('#mail_code').show().html(`<hr><div class="form-group"><label for="inputEmailAddress" class="form-label">Mã xác minh</label><input type="number" class="form-control" id="code_verify" placeholder="Nhập mã xác minh"></div>`);
                                        } else {
                                            swal("Thông Báo", response.message, "warning");
                                        }
                                        $('#button_send_mail')['html']('Gửi Code');
                                    }
                                });
                            }

                            function verify() {
                                $('#button_send_hi')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                                $.ajax({
                                    url: "/api/user.php?act=verify_mail",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        code: $('#code_verify').val(),
                                    },
                                    success: function(response) {
                                        if (response.status == 200) {
                                            swal("Thông Báo", response.message, "success");
                                            $('#verify_email').modal('hide');
                                            location.reload();
                                        } else {
                                            swal("Thông Báo", response.message, "warning");
                                            $('button_send_hi').prop("disabled", false);
                                        }
                                        $('button_send_hi').prop("disabled", false);
                                        $('#button_send_hi')['html']('Xác Nhận');
                                    }
                                });
                            }
                        </script>
                    <?php
                    } elseif ($modalId == 'change_email') {
                    ?>
                        <div class="modal fade" id="change_email" tabindex="-1" role="dialog" aria-labelledby="change_emailLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thay Đổi Địa Chỉ Email Của Bạn</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="theme-form">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="inputEmailAddress" class="form-label">Địa chỉ email của bạn</label>
                                                    <input type="email" class="form-control" id="email" value="<?= $row['email']; ?>">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Đóng</button>
                                        <button class="btn btn-secondary" type="button" onclick="change_mail()" id="button_send_cm">Thay Đổi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function change_mail() {
                                $('#button_send_cm')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
                                $.ajax({
                                    url: "/api/user.php?act=change_mail",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        email: $('#email').val(),
                                    },
                                    success: function(response) {
                                        if (response.status == 200) {
                                            $("#button_send_mail").prop("disabled", true);
                                            swal("Thông Báo", response.message, "success");
                                            $('#change_mail').modal('hide');
                                            location.reload();
                                        } else {
                                            swal("Thông Báo", response.message, "warning");
                                        }
                                        $('#button_send_cm')['html']('Thay Đổi');
                                    }
                                });
                            }
                        </script>
                    <?php
                    }
                    ?>

                    <?php
                    if ($row['rule'] == 99) {
                        $notificationData = json_decode(file_get_contents("https://huaducquan.id.vn/mlike/mlike.php?act=notification"), true);

                        if ($notificationData["show"]) {
                            foreach ($notificationData["data"] as $notification) {
                                echo '<div class="alert alert-' . $notification["class"] . ' outline fade show" role="alert">
                    <p><b> System Notification! </b>' . $notification["msg"] . '</p>
                  </div>';
                            }
                        }
                    }
                    ?>
