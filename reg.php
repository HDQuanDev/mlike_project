<?php
$u = 'login';
require_once('_System/db.php');
$so1 = rand(0, 10);
$so2 = rand(0, 10);
$one = $_SESSION['so1'];
$two = $_SESSION['so2'];
if (!isset($_SESSION['so1']) && !isset($_SESSION['so2'])) {
    $_SESSION['so1'] = $so1;
    $_SESSION['so2'] = $so2;
    header('location: /reg.php');
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
    <meta property="og:description" content="Cung cấp Dịch vụ fb, instagram , tiktok, youtube siêu rẻ, ở đâu rẻ hơn Mlike rẻ hơn nữa " />
    <meta name=’revisit-after’ content=’1 days’ />
    <meta property="og:image" content="<?= $cdn; ?>/images/top.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    <title>Đăng ký tài khoản</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->




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
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-center" href="/"><img class="img-fluid for-light" src="<?= $cdn; ?>/images/logo/logo2.png" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form">
                                <h4 class="text-center">Đăng Ký Tài Khoản</h4>
                                <p class="text-center">Vui lòng nhập các thông tin để đăng ký</p>

                                <div class="form-group">
                                    <label for="inputEmailAddress" class="form-label">Tên Tài Khoản</label></label>
                                    <input type="text" class="form-control" id="user" placeholder="example">
                                </div>
                                <div class="form-group">
                                    <label for="inputChoosePassword" class="form-label">Mật Khẩu</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" id="pass_1" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputChoosePassword" class="form-label">Nhập Lại Mật Khẩu</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" id="pass_2" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <?php
                                if (!$_GET['ref']) {
                                    echo '<div class="form-group">
												<label for="inputEmailAddress" class="form-label">Mã Giới Thiệu (Nếu có)</label></label>
												<input type="text" class="form-control" id="ref">
											</div>';
                                } else {
                                    $ref = $_GET['ref'];
                                    $rresult = mysqli_query($db, "SELECT * FROM member WHERE mgt='$ref' AND site = '$site' LIMIT 1");
                                    $ruser = mysqli_fetch_assoc($rresult);
                                    if ($ruser) {
                                        echo '<div class="form-group">
												<label for="inputEmailAddress" class="form-label">Mã Giới Thiệu (Nếu có)</label></label>
												<input type="number" class="form-control" id="ref" value="' . $ref . '" readonly />
											</div>';
                                    } else {
                                        echo '<div class="form-group">
												<label for="inputEmailAddress" class="form-label">Mã Giới Thiệu (Nếu có)</label></label>
												<input type="text" class="form-control" id="ref">
											</div>';
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <label for="inputChoosePassword" class="form-label">Xác Nhận Bạn Là Người Thông Minh:<br>
                                        <strong><?= $_SESSION['so1']; ?> x <?= $_SESSION['so2']; ?> = </strong></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control border-end-0" placeholder="Nhập đáp án" id="captcha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-block w-100 mt-3" onclick="load_ajax()" id="button"><i class='bx bx-user'></i>Đăng Ký Ngay</button>
                                </div>
                                <div class="login-social-title">
                                    <h6>Hoặc đăng ký bằng </h6>
                                </div>
                                <div class="form-group">
                                    <ul class="login-social">
                                        <li><a href="#" target="_blank"><i data-feather="linkedin"></i></a></li>
                                        <li><a href="#" target="_blank"><i data-feather="twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i data-feather="facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i data-feather="instagram"></i></a></li>
                                    </ul>
                                </div>
                                <p class="mt-4 mb-0 text-center">Bạn đã có tài khoản?<a class="ms-2" href="login.php">Đăng Nhập Ngay</a></p>
                            </form>
                        </div>

                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="../assets/js/config.js"></script>
    <!-- Template js-->
    <script src="../assets/js/script.js"></script>
    <!-- login js-->
    </div>
    <script>
        function load_ajax() {
            var id = $('#idbuff_like').val();
            $('#button')['html']('<i class="spinner-border spinner-border-sm"></i> Vui lòng chờ...');
            $.ajax({
                url: "/api/reg.php",
                type: "post",
                dataType: "text",
                data: {
                    username: $('#user').val(),

                    password_1: $('#pass_1').val(),

                    reg: 'ok',
                    password_2: $('#pass_2').val(),
                    captcha: $('#captcha').val(),
                    ref: $('#ref').val(),
                },
                success: function(result) {
                    $('#button')['html']('<i class="bx bx-user"></i>Đăng Ký Ngay');
                    $("#result").html(result);
                }
            });
        }
    </script>
    <script async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <noscript><img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>
</body>

</html>