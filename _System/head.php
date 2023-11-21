<?php
//$page = 'login';
require_once('db.php');
if ($title) {
    $t = '' . $title . ' | ' . $s['title'];
} else {
    $t = $s['title'];
}
$titl = '' . $title . '';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipp = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipp = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipp = $_SERVER['REMOTE_ADDR'];
}
$ip = mysqli_query($db, "SELECT * FROM `online` WHERE `ip` = '$ipp' AND `site` = '$site'");
$ip = mysqli_num_rows($ip);
$timeon = time();
if ($login) {
    $onus = $login;
    mysqli_query($db, "UPDATE `member` SET `last_ip_login` = '$ipp', `last_time_login` = '$timeon' WHERE `username` = '$login' AND `site` = '$site'");
} else {
    $onus = '123';
}


//session_destroy();
if ($ip >= 1) {
    mysqli_query($db, "UPDATE `online` SET `time` = '$timeon', `user` = '$onus', `title` = '$titl' WHERE `ip` = '$ipp' AND `site` = '$site'");
} else {
    mysqli_query($db, "INSERT INTO `online` (`ip`, `user`, `time`, `title`, `site`) VALUES ('$ipp', '$onus', '$timeon', '$titl', '$site')");
}
if ($uif != '1') {
    if ($login) {
        if ($row['active'] == '1') {
            Header('Location:/user_update_info.php');
            die();
        }
    }
}
$ls = mysqli_query($db, "SELECT * FROM `lichsu` WHERE `user` = '" . $_SESSION['u'] . "' AND `site` = '$site'");
$ls = mysqli_num_rows($ls);
$dz = time() - 300;
$ckid = mysqli_query($db, "SELECT * FROM `online` WHERE `time` > '$dz' AND `site` = '$site'");
$ckid = mysqli_num_rows($ckid);
$dv = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `bh` = '1' AND `nse` < '3' AND `site` = '$site'");
$dv = mysqli_num_rows($dv);
$bh = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `bh` = '2' AND `nse` = '3' AND `site` = '$site'");
$bh = mysqli_num_rows($bh);
$cm = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Cmt' AND `site` = '$site'");
$cm = mysqli_num_rows($cm);
$pg = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_page' AND `nse` = 'Server Fanpage 2' AND `site` = '$site'");
$pg = mysqli_num_rows($pg);
$sv_4 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `site` = '$site' AND `nse`='444'");
$sv_4 = mysqli_num_rows($sv_4);
$sv_cmt = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_likecmt' AND `site` = '$site' AND `bh`='444'");
$sv_cmt = mysqli_num_rows($sv_cmt);
$vt = mysqli_query($db, "SELECT * FROM `video` WHERE `code` = '14' AND `site` = '$site'");
$vt = mysqli_num_rows($vt);
$sub = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `site` = '$site'");
$sub = mysqli_num_rows($sub);
$lt = mysqli_query($db, "SELECT * FROM `dichvu` WHERE (`bh` = '1' OR `bh` = '3') AND (`nse` = '4' OR `nse` = 'Server Share 3' OR `nse` = 'Server Share 4' OR `nse` = 'Server Follow 1') AND `site` = '$site'");
$lt = mysqli_num_rows($lt);
$tv = mysqli_query($db, "SELECT * FROM `member` WHERE `site` = '$site'");
$tv = mysqli_num_rows($tv);
$his = mysqli_query($db, "SELECT * FROM `lichsu` WHERE `site` = '$site'");
$his = mysqli_num_rows($his);
$vd = mysqli_query($db, "SELECT * FROM `video` WHERE `site` = '$site'");
$vd = mysqli_num_rows($vd);
$mm = mysqli_query($db, "SELECT * FROM `momo` WHERE `site` = '$site'");
$mm = mysqli_num_rows($mm);
$likettt = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like_tay'");
$likettt = mysqli_num_rows($likettt);
$viewtt = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `nse` = 'Server View 1'");
$viewtt = mysqli_num_rows($viewtt);
?>

<!doctype html>

<html lang="vi-VN">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
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
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/bootstrap.css?v=<?= time(); ?>">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/style.css?v=<?= time(); ?>">
    <link id="color" rel="stylesheet" href="<?= $cdn; ?>/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/responsive.css">
    <script src="<?= $cdn; ?>/js/jquery-3.6.0.min.js"></script>
    <title><?= $t; ?></title>



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
                                    if ($loai == '1') {
                                        $sloai = 'Mua Dịch Vụ ' . $kyhieu . '' . number_format($sotien) . 'đ';
                                        $icon = 'shopping-cart';
                                    } elseif ($loai == '2') {
                                        $sloai = 'Nạp Tiền ' . $kyhieu . '' . number_format($sotien) . 'đ';
                                        $icon = 'shopping-bag';
                                    } elseif ($loai == '3') {
                                        $sloai = 'Thay Đổi Thông Tin';
                                        $icon = 'edit-3';
                                    } else {
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
                                        <div class="message-img bg-light-primary"><img src="https://graph.facebook.com/100050332187651/picture?width=60&amp;height=60&amp;access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1"><a href="https://www.facebook.com/quancp72h" target="_blank" data-bs-original-title="" title=""><span style="color:red;">Hứa Đức Quân</span> (Lập Trình Viên)</style="color:red;"></a></h5>
                                            <p>Đang ở: <strong>[Admin Privacy Protection]</strong></p>
                                        </div>

                                    </div>
                                </li>
                                <?php
                                $ipp = mysqli_query($db, "SELECT * FROM `online` WHERE `time` >= '$dz' AND `site` = '$site' AND `user` != 'dramasee' ORDER BY id LIMIT 8");
                                while ($ip = mysqli_fetch_assoc($ipp)) {
                                    if ($ip['user'] !== '123') {
                                        $name = $ip['user'];
                                        $onl = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$name' AND `site` = '$site'");
                                        $ttonl = mysqli_fetch_assoc($onl);

                                        if ($ttonl['rule'] == '99') {
                                            $rule = '99';
                                            $img = 'https://graph.facebook.com/' . $ttonl['idfb'] . '/picture?width=60&height=60&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662';
                                        } else {
                                            $rule = '1';
                                            $img = 'https://ui-avatars.com/api/?background=random&name=' . $name . '';
                                        }
                                    } else {
                                        $name = 'Khách ghé thăm';
                                        $img = 'https://ui-avatars.com/api/?background=random&name=' . $name . '';
                                        $rule = '1';
                                    }
                                ?>

                                    <li>
                                        <div class="d-flex align-items-start">
                                            <div class="message-img bg-light-primary"><img src="<?= $img; ?>" alt=""></div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1"><a href="#"><? if ($rule == '99') {
                                                                                    echo '<span style="color:red;">';
                                                                                } ?><?= $name; ?> <? if ($rule == '99') {
                                                                                                        if ($name == 'dramasee') {
                                                                                                            echo '(Lập Trình Viên)';
                                                                                                        } else {
                                                                                                            echo '(Quản Trị Viên)';
                                                                                                        }
                                                                                                    } ?></span></a></h5>
                                                <p>Đang ở: <?php
                                                            if ($ttonl['rule'] == 99 && ($ttonl['username'] == 'dramasee' || $ttonl['username'] == 'BossSang')) {
                                                                echo '<strong>[Admin Privacy Protection]</strong>';
                                                            } else {
                                                                echo $ip['title'];
                                                            } ?></p>
                                            </div>

                                        </div>
                                    </li>
                                <?
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
                                                            <li><a href="/admin/managerjs/index"><i class="bx bx-right-arrow-alt"></i>Quản lý tệp tin</a></li>
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
                                        Dịch Vụ Facebook:facebook#Tăng Like Post Kênh 1|/service/like.php!Tăng Like Post Kênh 2|/service/likev2.php!Tăng Cảm Xúc Bài Viết|/service/like_feeling.php!Tăng Like Comment Facebook|/service/likecmt.php!Tăng Comment Bài Viết|/service/comment.php!Tăng Share Bài Viết|/service/share.php!Tăng Follow Facebook|/service/follow.php!Tăng Mắt Livestream|/service/live.php!Tăng Mắt Livestream V2|/service/live_v2.php!Tăng Like Fanpage|/service/page.php!Tăng Member Group|/service/group.php!Tăng View Video|/service/view.php!Vip Like Facebook|/service/viplike.php!Tăng View Story|/service/view_story.php
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
                                                            <img src="https://graph.facebook.com/<?= $row['idfb']; ?>/picture?width=110&height=110&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" width="110" height="110" class="rounded-circle shadow" alt="">
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
                    <div id="check_payment"></div>
                    <?php
                    if ($login != 'BossSang') {
                    ?>
                        <script>
                            setInterval(function() {
                                $('#check_payment').load('/api/check_payment.php?act=check');
                            }, 10000)
                        </script>

                    <?
                    }
                    ?>
                    <script type="text/JavaScript">
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
                    /*if ($row['is_email_disposable'] == 'false') {
                        $email = $row['email'];
                        $validmail = json_decode(checkMail($email));
                        $checkmail = mysqli_query($db, "SELECT * FROM `member` WHERE `email` = '$email'");
                        $checkmail = mysqli_num_rows($checkmail);
                        if ($checkmail > 1) {
                            $show = true;
                            $color = 'danger';
                            $msg = 'Email của bạn đã được sử dụng bởi người khác, vui lòng đổi email khác để bảo mật tài khoản và sửa dụng được các chức năng quên mật khẩu,...';
                        } elseif ($validmail->disposable == 'false') {
                            $show = true;
                            $color = 'danger';
                            $msg = 'Email của bạn đang là email ảo, vui lòng đổi email khác để bảo mật tài khoản và sửa dụng được các chức năng quên mật khẩu,...';
                        } elseif ($row['is_verify_mail'] == 'false') {
                            $show = true;
                            $color = 'warning';
                            $msg = 'Email của bạn chưa được xác minh, vui lòng xác minh email để bảo mật tài khoản và sửa dụng được các chức năng quên mật khẩu,...';
                            $show_modal = true;
                        } else {
                            $show = false;
                        }
                    }
                    if ($show == true) {
                    ?>
                        <div class="alert alert-<?= $color; ?> outline fade show" role="alert">
                            <p><b> Thông Báo! </b><?= $msg; ?></p>
                        </div>
                    <?php
                    }
                    */
                    ?>

                    <?php
                    #Phần kết nối đến server thông báo, vui lòng không chỉnh sửa nếu bạn không muốn bỏ lỡ thông báo từ hệ thống
                    if ($row['rule'] == 99) { //kiểm tra chức vụ để hiển thị thông báo;
                        $get_notification = file_get_contents("https://huaducquan.id.vn/mlike/mlike.php?act=notification"); //lấy dữ liệu thông báo
                        $decode_notification = json_decode($get_notification, true); // giải mã nội dung
                        if ($decode_notification["show"] == true) { //kiểm tra loại thông báo
                            $count_notification = count($decode_notification["data"]); // đếm nội dung thống báo
                            for ($i = 0; $i < $count_notification; $i++) { //lặp lại để lấy tất cả nội dung thông báo nếu nhiều hơn 1
                                echo '<div class="alert alert-' . $decode_notification["data"][$i]["class"] . ' outline fade show" role="alert">
<p><b> System Notification! </b>' . $decode_notification["data"][$i]["msg"] . '</p>
</div>';
                            }
                        }
                    }                        
#kết thúc phần thông báo server