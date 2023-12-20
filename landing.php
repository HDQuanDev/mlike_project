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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap css -->

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="<?= $cdn; ?>/css/style.css">
    <link id="color" rel="stylesheet" href="<?= $cdn; ?>/css/color-1.css">


    <!-- Tiêu đề trang -->
    <title>MLIKE.VN - Nhà cung cấp dịch vụ mạng xã hội hàng đầu Việt Nam</title>
    <style>
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0))
        }

        *,
        *::before,
        *::after {
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        h1,
        .h1,
        h2,
        .h2,
        h3,
        .h3,
        h4,
        .h4,
        h5,
        .h5,
        h6,
        .h6 {
            margin-top: 0;
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2
        }

        h2,
        .h2 {
            font-size: calc(1.325rem + .9vw)
        }

        h3,
        .h3 {
            font-size: calc(1.3rem + .6vw)
        }

        h4,
        .h4 {
            font-size: calc(1.275rem + .3vw)
        }

        h6,
        .h6 {
            font-size: 1rem
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        ol,
        ul {
            padding-left: 2rem
        }

        ol,
        ul,
        dl {
            margin-top: 0;
            margin-bottom: 1rem
        }

        b,
        strong {
            font-weight: bolder
        }

        a {
            color: #0d6efd;
            text-decoration: underline
        }

        img,
        svg {
            vertical-align: middle
        }

        label {
            display: inline-block
        }

        button {
            border-radius: 0
        }

        input,
        button,
        select,
        optgroup,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit
        }

        button,
        select {
            text-transform: none;
        }

        button,
        [type="button"],
        [type="reset"],
        [type="submit"] {
            -webkit-appearance: button
        }

        button:not(:disabled),
        [type="button"]:not(:disabled),
        [type="reset"]:not(:disabled),
        [type="submit"]:not(:disabled) {
            cursor: pointer
        }

        .img-fluid {
            max-width: 100%;
            height: auto
        }

        .container,
        .container-fluid,
        .container-sm,
        .container-md,
        .container-lg,
        .container-xl,
        .container-xxl {
            width: 100%;
            padding-right: var(--bs-gutter-x, .75rem);
            padding-left: var(--bs-gutter-x, .75rem);
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width: 576px) {

            .container,
            .container-sm {
                max-width: 540px
            }
        }

        @media (min-width: 768px) {

            .container,
            .container-sm,
            .container-md {
                max-width: 720px
            }
        }

        @media (min-width: 992px) {

            .container,
            .container-sm,
            .container-md,
            .container-lg {
                max-width: 960px
            }
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y) * -1);
            margin-right: calc(var(--bs-gutter-x) / -2);
            margin-left: calc(var(--bs-gutter-x) / -2)
        }

        .row>* {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) / 2);
            padding-left: calc(var(--bs-gutter-x) / 2);
            margin-top: var(--bs-gutter-y)
        }

        .col-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100%
        }

        .col-sm-6 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 50%
        }

        .col-sm-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100%
        }

        @media (min-width: 992px) {
            .col-lg {
                -webkit-box-flex: 1;
                -ms-flex: 1 0 0%;
                flex: 1 0 0%
            }

            .row-cols-lg-auto>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-lg-1>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-lg-2>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-lg-3>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 33.33333%
            }

            .row-cols-lg-4>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-lg-5>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-lg-6>* {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 16.66667%
            }

            .col-lg-auto {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto
            }

            .col-lg-1 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 8.33333%
            }

            .col-lg-2 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 16.66667%
            }

            .col-lg-3 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 25%
            }

            .col-lg-4 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 33.33333%
            }

            .col-lg-5 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 41.66667%
            }

            .col-lg-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 50%
            }

            .col-lg-7 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 58.33333%
            }

            .col-lg-8 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 66.66667%
            }

            .col-lg-9 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 75%
            }

            .col-lg-10 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 83.33333%
            }

            .col-lg-11 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 91.66667%
            }

            .col-lg-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 100%
            }

            .offset-lg-0 {
                margin-left: 0
            }

            .offset-lg-1 {
                margin-left: 8.33333%
            }

            .offset-lg-2 {
                margin-left: 16.66667%
            }

            .offset-lg-3 {
                margin-left: 25%
            }

            .offset-lg-4 {
                margin-left: 33.33333%
            }

            .offset-lg-5 {
                margin-left: 41.66667%
            }

            .offset-lg-6 {
                margin-left: 50%
            }

            .offset-lg-7 {
                margin-left: 58.33333%
            }

            .offset-lg-8 {
                margin-left: 66.66667%
            }

            .offset-lg-9 {
                margin-left: 75%
            }

            .offset-lg-10 {
                margin-left: 83.33333%
            }

            .offset-lg-11 {
                margin-left: 91.66667%
            }

            .g-lg-0,
            .gx-lg-0 {
                --bs-gutter-x: 0
            }

            .g-lg-0,
            .gy-lg-0 {
                --bs-gutter-y: 0
            }

            .g-lg-1,
            .gx-lg-1 {
                --bs-gutter-x: .25rem
            }

            .g-lg-1,
            .gy-lg-1 {
                --bs-gutter-y: .25rem
            }

            .g-lg-2,
            .gx-lg-2 {
                --bs-gutter-x: .5rem
            }

            .g-lg-2,
            .gy-lg-2 {
                --bs-gutter-y: .5rem
            }

            .g-lg-3,
            .gx-lg-3 {
                --bs-gutter-x: 1rem
            }

            .g-lg-3,
            .gy-lg-3 {
                --bs-gutter-y: 1rem
            }

            .g-lg-4,
            .gx-lg-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-lg-4,
            .gy-lg-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-lg-5,
            .gx-lg-5 {
                --bs-gutter-x: 3rem
            }

            .g-lg-5,
            .gy-lg-5 {
                --bs-gutter-y: 3rem
            }
        }

        .form-label {
            margin-bottom: .5rem
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out
        }

        @media (prefers-reduced-motion: reduce) {
            .form-control {
                -webkit-transition: none;
                transition: none
            }
        }

        .form-control::-webkit-input-placeholder {
            color: #6c757d;
            opacity: 1
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 1
        }

        .input-group {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%
        }

        .input-group>.form-control,
        .input-group>.form-select {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0
        }

        .input-group-text {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: .25rem
        }

        .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu),
        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: -1px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            border-radius: .25rem;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                -webkit-transition: none;
                transition: none
            }
        }

        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-success {
            color: #fff;
            background-color: #198754;
            border-color: #198754
        }

        .btn-warning {
            color: #000;
            background-color: #ffc107;
            border-color: #ffc107
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545
        }

        .btn-lg,
        .btn-group-lg>.btn {
            padding: .5rem 1rem;
            font-size: 1.25rem;
            border-radius: .3rem
        }

        .nav {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .nav-link {
            display: block;
            padding: .5rem 1rem;
            text-decoration: none;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out
        }

        @media (prefers-reduced-motion: reduce) {
            .nav-link {
                -webkit-transition: none;
                transition: none
            }
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6
        }

        .nav-tabs .nav-link {
            margin-bottom: -1px;
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff
        }

        .nav-pills .nav-link {
            border-radius: .25rem
        }

        .navbar {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding-top: .5rem;
            padding-bottom: .5rem
        }

        .navbar-brand {
            padding-top: .3125rem;
            padding-bottom: .3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            text-decoration: none;
            white-space: nowrap
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: .25rem
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem 1rem
        }

        .border-end-0 {
            border-right: 0 !important
        }

        .w-100 {
            width: 100% !important
        }

        .mt-3 {
            margin-top: 1rem !important
        }

        .mt-4 {
            margin-top: 1.5rem !important
        }

        .mb-0 {
            margin-bottom: 0 !important
        }

        .text-end {
            text-align: right !important
        }

        .text-center {
            text-align: center !important
        }

        .text-dark {
            color: #212529 !important
        }

        .bg-light {
            background-color: #f8f9fa !important
        }

        .bg-white {
            background-color: #fff !important
        }

        .bg-transparent {
            background-color: rgba(0, 0, 0, 0) !important
        }
    </style>
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
                        <div class="btn-footer"><a class="btn btn-lg btn-primary" href="/login.php" data-bs-original-title="" title="">Đăng Nhập</a><a class="btn btn-lg btn-secondary" href="/reg.php" data-bs-original-title="" title="">Đăng Ký</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--footer end-->
    </div>
    <!-- latest jquery-->
    <script async defer src="<?= $cdn; ?>/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap js-->
    <script async defer src="<?= $cdn; ?>/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- Sidebar jquery-->
    <script async defer src="<?= $cdn; ?>/js/config.js"></script>
    <script async defer src="<?= $cdn; ?>/js/landing_sticky.js"></script>
    <script async defer src="<?= $cdn; ?>/js/landing.js"></script>
    <!-- SweetAlert js-->
    <script async defer src="<?= $cdn; ?>/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Template js-->
    <script async defer src="<?= $cdn; ?>/js/script.js"></script>

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