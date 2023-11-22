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
    <meta property="og:title" content="Quên Mật Khẩu Tài Khoản MLIKE" />
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

    <title>Quên Mật Khẩu Tài Khoản</title>


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
                            <h4 class="text-center">Quên Mật Khẩu</h4>
                            <p class="text-center">Vui lòng nhập email tài khoản của bạn để lấy lại mật khẩu</p>
                            <div class="from-group">
                                <label for="inputEmailAddress" class="form-label">Email tài khoản</label>
                                <input type="email" class="form-control" id="email" placeholder="Email tài khoản...">
                            </div>
                            <br>
                            <button class="btn btn-primary btn-block w-100" type="button" onclick="send_code()" id="button_code">Gửi Code</button>
                            <div class="col-12">
                                <span id="mail_code"></span>
                            </div>
                            <p class="mt-4 mb-0 text-center">Bạn đã có tài khoản?<a class="ms-2" href="login.php">Đăng nhập ngay</a></p>
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
        function send_code() {
            $('#button_code')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
            $("#button_code").prop("disabled", true);
            $.ajax({
                url: "/api/forgot_password.php?act=send_code",
                type: "post",
                dataType: "json",
                data: {
                    email: $('#email').val(),
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#button_code").prop("disabled", true);
                        swal("Thông Báo", response.message, "success");
                        $('#button_code').remove();
                        $('#mail_code').show().html(`<hr><div class="form-group"><label for="inputEmailAddress" class="form-label">Mã xác minh</label><input type="number" class="form-control" id="code_verify" placeholder="Nhập mã xác minh"></div><br><button class="btn btn-secondary btn-block w-100" type="button" onclick="verify()" id="button_verify">Xác Nhận</button>`);
                    } else {
                        swal("Thông Báo", response.message, "warning");
                    }
                    $('#button_code')['html']('Gửi Code');
                    $("#button_code").prop("disabled", false);
                }
            });
        }

        function verify() {
            $('#button_verify')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
            $("#button_verify").prop("disabled", true);
            $.ajax({
                url: "/api/forgot_password.php?act=verify_code",
                type: "post",
                dataType: "json",
                data: {
                    email: $('#email').val(),
                    code: $('#code_verify').val(),
                },
                success: function(response) {
                    if (response.status == 200) {
                        swal("Thông Báo", response.message, "success");
                        $('#button_verify')['html']('Xác Nhận');
                        $("#button_verify").prop("disabled", false);
                        setTimeout(function() {
                            window.location.href = '/login.php';
                        }, 3000);
                    } else {
                        swal("Thông Báo", response.message, "warning");
                        $('#button_verify')['html']('Xác Nhận');
                        $("#button_verify").prop("disabled", false);
                    }
                }
            });
        }
    </script>
    <script async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <noscript><img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>
</body>

</html>