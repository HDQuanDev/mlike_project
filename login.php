<?
$u = 'login';
require_once('_System/db.php');
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    header('location: /landing.php?redirect=' . $_GET['redirect']);
}
?>
<!doctype html>
<html lang="vn">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="https://mlike.vn/assets/images/top.png" type="image/png" />
    <meta itemprop="image" content="https://mlike.vn/assets/images/top.png">
    <meta name="author" content="Nguyễn Ngọc Thanh Sang">
    <!-- seo facebook -->
    <meta property="og:url" content="<?= $url; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Đănh Nhập Tài Khoản MLIKE" />
    <meta property="og:description" content="Cung cấp Dịch vụ fb, instagram , tiktok, youtube siêu rẻ, ở đâu rẻ hơn Mlike rẻ hơn nữa" />
    <meta name="revisit-after" content="1 days" />
    <meta property="og:image" content="https://mlike.vn/assets/images/top.png" />
    <!--plugins-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/style.css">
    <link id="color" rel="stylesheet" href="<?= $cdn; ?>/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/responsive.css">

    <title>Đăng Nhập Tài Khoản</title>


</head>


<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="login-card">
                <div>
                    <div id="result"></div>
                    <div><a class="logo" href="/"><img class="img-fluid for-light" src="<?= $cdn; ?>/images/logo/logo2.png" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form">
                            <h4 class="text-center">Đăng Nhập Tài Khoản</h4>
                            <p class="text-center">Vui lòng nhập tên tài khoản và mật khẩu</p>
                            <p class="mt-4 mb-0 text-center">Bạn quên mật khẩu?<a class="ms-2" href="forgot_password.php">Lấy lại ngay</a></p><br>
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
                            <div class="login-social-title">
                                <h6>Hoặc đăng nhâp bằng </h6>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li><a href="#" target="_blank"><i data-feather="linkedin"></i></a></li>
                                    <li><a href="#" target="_blank"><i data-feather="twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i data-feather="facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i data-feather="instagram"></i></a></li>
                                </ul>
                            </div>
                            <p class="mt-4 mb-0 text-center">Bạn chưa có tài khoản?<a class="ms-2" href="reg.php">Đăng ký ngay</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="/assets/js/config.js"></script>
    <!-- Template js-->
    <script src="/assets/js/script.js"></script>
    <!-- login js-->
    </div>
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