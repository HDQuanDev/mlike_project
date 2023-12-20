<?php
$u = 'login';
require_once('_System/db.php');
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $u = mysqli_real_escape_string($db, $_COOKIE["username"]);
    $p = mysqli_real_escape_string($db, $_COOKIE["password"]);
    $r = $_GET['redirect'];
    if (isset($r)) {
        $rr = $r;
    } else {
        $rr = '/index.php';
    }
    $query = "SELECT * FROM member WHERE username='$u' AND password='$p' AND site = '$site'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
        $_SESSION['u'] = $u;
        echo '<script>setTimeout(function(){
    window.location="' . $rr . '";
}, 5000);</script>';
    } else {
        setcookie('username', '', time() - 31556926);
        setcookie('password', '', time() - 31556926);
        header('location:/landing.php');
    }
}
?>
<!DOCTYPE html>
<html lang="vi-VN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="<?= $cdn; ?>/images/icon.png" type="image/png" />

    <!-- Ảnh đại diện -->
    <meta itemprop="image" content="<?= $cdn; ?>/images/top.png">

    <!-- Tác giả -->
    <meta name="author" content="Nguyễn Ngọc Thanh Sang">

    <!-- Mô tả -->
    <meta name="description" content="Nền Tảng Tăng Tương Tác Cho Các Dịch Vụ Truyền Thông Mạng Xã Hội. Uy Tín, Nhanh Chóng, Chất Lượng, Giá Rẻ. Những Gì Bạn Cần Tăng - Chúng Tôi Có Cung Cấp. Phát triển ngay mọi nền tảng mạng xã hội của bạn với dịch vụ của chúng tôi. Trở Thành Idol Mạng Xã Hội Không Khó">

    <!-- SEO Facebook -->
    <meta property="og:url" content="<?= $url; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="MLIKE.VN - Nhà cung cấp dịch vụ mạng xã hội hàng đầu Việt Nam" />
    <meta property="og:description" content="Cung cấp Dịch vụ fb, instagram, tiktok, youtube siêu rẻ, ở đâu rẻ hơn Mlike rẻ hơn nữa" />
    <meta name="revisit-after" content="1 days" />
    <meta property="og:image" content="<?= $cdn; ?>/images/top.png" />

    <!-- Plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/style.css">
    <link id="color" rel="stylesheet" href="<?= $cdn; ?>/css/color-1.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/responsive.css">

    <!-- Tiêu đề trang -->
    <title>MLIKE.VN - Nhà cung cấp dịch vụ mạng xã hội hàng đầu Việt Nam</title>
</head>


<body class="landing-page">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper">
        <!-- Page Body Start-->
        <!-- header start-->
        <header class="landing-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand"> <img class="img-fluid img-90" src="<?= $cdn; ?>/images/logo/logo3.png" alt=""></a>
                            <ul class="landing-menu nav nav-pills">
                                <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                                <li class="nav-item"><a class="nav-link" href="#home">Trang Chủ</a></li>
                                <li class="nav-item"><a class="nav-link" href="#dichvu">Dịch Vụ</a></li>
                                <li class="nav-item"><a class="nav-link" href="#thanhtoan">Thanh Toán</a></li>
                                <li class="nav-item"><a class="nav-link" href="#lienhe">Liên Hệ</a></li>
                                <li class="nav-item"><a class="nav-link" href="#thongke">Thống Kê</a></li>
                            </ul>
                            <div class="buy-block"><a class="btn-landing btn-white" href="/reg.php">Đăng ký </a>
                                <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end-->
        <!-- landing home start-->
        <section class="landing-home" id="home"><img class="img-fluid bg-img-cover" src="<?= $cdn; ?>/images/landing/landing-home/home-bg.webp" alt="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="landing-home-contain">
                            <div>
                                <div><img class="img-fluid" src="<?= $cdn; ?>/images/logo/logo3.png" alt=""></div>
                                <h2>Nền Tảng Tăng Tương Tác Cho Các Dịch Vụ Truyền Thông Mạng Xã Hội.</h2>
                                <h3>Uy Tín, Nhanh Chóng, Chất Lượng, Giá Rẻ</h3>
                                <p> Những Gì Bạn Cần Tăng - Chúng Tôi Có Cung Cấp<br>
                                    Phát triển ngay mọi nền tảng mạng xã hội của bạn với dịch vụ của chúng tôi.<br>
                                    <b>Trở Thành Idol Mạng Xã Hội "Không Khó"</b>
                                </p>
                                <ul class="btn-home-list">
                                    <li><a class="btn btn-success" href="/login.php">Đăng Nhập</a></li>
                                    <li><a class="btn btn-danger" href="/reg.php">Đăng Ký</a></li>
                                </ul>
                                <p class="mt-4 mb-0">Bạn quên mật khẩu?<a class="btn btn-warning" href="forgot_password.php">Lấy lại ngay</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <? if (check_isMobile()) {
                            echo '';
                        } else {
                            echo '<div class="landing-home-contain">';
                        } ?>
                        <?php
                        if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
                        ?>
                            <div class="loader-box">
                                <div class="loader-32"></div>
                                <br>
                                <b>
                                    <h4>
                                        Vui Lòng Chờ...
                                    </h4>
                                </b>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="card bg-light text-dark">
                                <div class="card-body">
                                    <div id="result"></div>
                                    <form>
                                        <h4 class="text-center">Đăng Nhập Tài Khoản</h4>
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Tên Tài Khoản</label>
                                            <input type="text" class="form-control" id="user" placeholder="Tên tài khoản...">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label"> Mật Khẩu</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="pass" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="text-end mt-3">
                                                <button class="btn btn-primary btn-block w-100" type="button" onclick="load_ajax()" id="button">Đăng Nhập</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?
                        }
                        if (check_isMobile()) {
                            echo '';
                        } else {
                            echo '</div>';
                        } ?>

                    </div>
                </div>
            </div>
        </section>
        <!-- landing home end-->

        <!-- frameworks start-->
        <section class="framework section-py-space bg-white" id="dichvu">
            <div class="custom-container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="title">
                            <h2>Các Nền Tảng Chúng Tôi Cung Cấp Dịch Vụ<i class="fa fa-circle"></i></h2>
                        </div>
                    </div>
                    <div class="col-sm-12 framworks">
                        <ul class="framworks-list">
                            <li class="bounceIn wow">
                                <div> <img src="<?= $cdn; ?>/images/icon/facebook.png" alt="" width="43%"></div>
                                <h6>Facebook</h6>
                            </li>
                            <li class="bounceIn wow">
                                <div> <img src="<?= $cdn; ?>/images/icon/instagram.png" alt="" width="43%"></div>
                                <h6>Instagram</h6>
                            </li>
                            <li class="bounceIn wow">
                                <div> <img src="<?= $cdn; ?>/images/icon/tiktok.png" alt="" width="31%"></div>
                                <h6>TikTok</h6>
                            </li>
                            <li class="bounceIn wow">
                                <div> <img src="<?= $cdn; ?>/images/icon/youtube.png" alt="" width="59%"></div>
                                <h6>Youtube</h6>
                            </li>
                            <li class="bounceIn wow">
                                <div> <img src="<?= $cdn; ?>/images/landing/icon/html/apps.png" alt=""></div>
                                <h6>1+ Các Dịch Vụ Khác</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--frameworks end-->
        <!--Applications start-->
        <section class="demo-section section-py-space light-bg application-section" id="thanhtoan">
            <div class="title">
                <h2>Hỗ Trợ Thanh Toán Qua<i class="fa fa-circle"></i></h2>
            </div>
            <div class="container">
                <div class="row demo-block">
                    <div class="col-lg-6 col-sm-6 wow pulse">
                        <div class="demo-box">
                            <div class="img-wrraper"><img class="img-fluid" src="<?= $cdn; ?>/images/icon/vietcombank.webp" alt=""></div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 wow pulse">
                        <div class="demo-box">
                            <div class="img-wrraper"><img class="img-fluid" src="<?= $cdn; ?>/images/icon/momo.webp" alt=""></div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Applications end-->
        <!-- unique-cards start-->
        <!--Core Feature end-->
        <!-- layout section start-->
        <section class="section-py-space layout-section" id="lienhe">
            <div class="container">
                <div class="row layout-block">
                    <div class="col-sm-12 wow pulse">
                        <div class="title">
                            <h2>Liên Hệ Admin<i class="fa fa-circle"></i></h2>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs layout-list" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="https://zalo.me/0987777059" target="_blank"><i data-feather="mail"></i>
                                    Liên hệ Zalo Admin</a></li>
                            <li class="nav-item"><a class="nav-link active" href="https://mlike.vn/sanginfo/index.php" target="_blank"><i data-feather="briefcase"></i>
                                    <span>Liên Hệ FB Admin</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!--layout section end-->
    <!-- counter-section start-->
    <?php
    $dv_other_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `dv_other`");
    $dv_other_row = mysqli_fetch_assoc($dv_other_result);
    $dvo = $dv_other_row['count'];

    $dichvu_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `dichvu`");
    $dichvu_row = mysqli_fetch_assoc($dichvu_result);
    $dv = $dichvu_row['count'];

    $video_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `video`");
    $video_row = mysqli_fetch_assoc($video_result);
    $dvv = $video_row['count'];

    $totaldv = $dvo + $dv + $dvv;

    $member_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `member`");
    $member_row = mysqli_fetch_assoc($member_result);
    $user = $member_row['count'];

    $lichsu_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `lichsu`");
    $lichsu_row = mysqli_fetch_assoc($lichsu_result);
    $history = $lichsu_row['count'];

    $online_result = mysqli_query($db, "SELECT COUNT(*) as count FROM `online`");
    $online_row = mysqli_fetch_assoc($online_result);
    $online = $online_row['count'];
    ?>

    <section class="counter-sec section-py-space" id="thongke">
        <div class="custom-container">
            <div class="row counter-block">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div>
                            <div class="count-number">
                                <h3><?= number_format($totaldv); ?></h3>
                            </div>
                            <div class="count-detail">
                                <h4>Đơn Hàng </h4>
                                <p>Tổng số đơn hàng đã được đặt trên hệ thống.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div>
                            <div class="count-number">
                                <h3><?= number_format($user); ?></h3>
                            </div>
                            <div class="count-detail">
                                <h4>Thành viên</h4>
                                <p>Tổng số thành viên trên hệ thống của chúng tôi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div>
                            <div class="count-number">
                                <h3><?= number_format($history); ?></h3>
                            </div>
                            <div class="count-detail">
                                <h4>Lượt Đánh Giá</h4>
                                <p>Các khách hàng hài lòng với dịch vụ của chúng tôi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div>
                            <div class="count-number">
                                <h3><?= number_format($online); ?></h3>
                            </div>
                            <div class="count-detail">
                                <h4>Lượt Truy Cập</h4>
                                <p>Lưu lượng truy cập website hằng ngày của chúng tôi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter-section end-->
    <!--footer start-->
    <section class="landing-footer section-py-space light-bg" id="footer">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-contain"><img class="img-fluid" src="<?= $cdn; ?>/images/logo/logo2.png" alt="">
                        <h2>Bạn còn băn khoăn gì nữa? Hãy sử dụng ngay</h2>
                        <ul class="star-rate">
                            <li><i class="fa fa-star font-warning"></i></li>
                            <li><i class="fa fa-star font-warning"></i></li>
                            <li><i class="fa fa-star font-warning"></i></li>
                            <li><i class="fa fa-star font-warning"></i></li>
                            <li><i class="fa fa-star font-warning"></i></li>
                        </ul>
                        <div class="btn-footer"><a class="btn btn-lg btn-primary" href="/login.php" data-bs-original-title="" title="">Đăng Nhập</a><a class="btn btn-lg btn-secondary" href="/reg.php" data-bs-original-title="" title="">Đăng Ký</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--footer end-->
    </div>
    <!-- latest jquery-->
    <script src="<?= $cdn; ?>/js/jquery-3.6.0.min.js" async defer></script>
    <!-- Bootstrap js-->
    <script src="<?= $cdn; ?>/js/bootstrap/bootstrap.bundle.min.js" async defer></script>
    <!-- Sidebar jquery-->
    <script src="<?= $cdn; ?>/js/config.js" async defer></script>
    <script src="<?= $cdn; ?>/js/landing_sticky.js" async defer></script>
    <script src="<?= $cdn; ?>/js/landing.js" async defer></script>
    <!-- SweetAlert js-->
    <script src="<?= $cdn; ?>/js/sweet-alert/sweetalert.min.js" async defer></script>
    <!-- Template js-->
    <script src="<?= $cdn; ?>/js/script.js" async defer></script>

    <!-- login js-->
    <script>
        function load_ajax() {
            var id = $('#idbuff_like').val();
            $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
            $.ajax({
                url: "/api/login.php",
                type: "post",
                dataType: "text",
                data: {
                    username: $('#user').val(),
                    password: $('#pass').val(),
                    login: 'ok',
                    redirect: '<?= $_GET['redirect']; ?>',
                },
                success: function(result) {
                    $('#button')['html']('<i class="bx bxs-lock-open"></i>Đăng Nhập');
                    $("#result").html(result);

                }
            });
        }
    </script>
    <script async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <noscript><img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>
</body>

</html>