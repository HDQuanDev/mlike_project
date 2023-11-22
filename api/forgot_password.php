<?php
$u = 'login';
require_once('../_System/db.php');
switch ($_GET['act']) {
    case 'send_code':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = mysqli_real_escape_string($db, $_POST['email']);
            if (empty($email)) {
                echo json_encode(array('status' => '400', 'message' => 'Vui lòng nhập email!'));
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('status' => '400', 'message' => 'Email không hợp lệ!'));
            } else {
                $query = "SELECT * FROM member WHERE email='$email' AND `site`='$site'";
                $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results) == 1) {
                    $check = mysqli_query($db, "SELECT * FROM `member` WHERE `email` = '$email' AND `is_verify_mail` = 'true' AND `site`='$site'");
                    if (mysqli_num_rows($check) == 1) {
                        $row = mysqli_fetch_assoc($check);
                        $code = rand(100000, 999999);
                        $query = "UPDATE member SET is_code_verify_mail='$code' WHERE email='$email' AND `site`='$site' AND `is_verify_mail` = 'true'";
                        $results = mysqli_query($db, $query);
                        if ($results) {
                            $to = $email;
                            $title = "Yêu cầu lấy lại mật khẩu";
                            $content = "Mã xác nhận của bạn là: " . $code;
                            $name = $row['hoten'];

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://mlike.vn/module/send_mail.php',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => 'email=' . $to . '&title=' . $title . '&content=' . $content . '&name=' . $name . '',
                                CURLOPT_HTTPHEADER => array(
                                    'Referer: huaducquan',
                                    'Content-Type: application/x-www-form-urlencoded',
                                ),
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $result = json_decode($response);
                            if ($result->status == '200') {
                                echo json_encode(array('status' => '200', 'message' => 'Đã gửi email, vui lòng kiểm tra hộp thư đến/spam để lấy code xác nhận!'));
                            } else {
                                echo json_encode(array('status' => '400', 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau!'));
                            }
                        } else {
                            echo json_encode(array('status' => '400', 'message' => 'Có lỗi xảy ra vui lòng thử lại!'));
                        }
                    } else {
                        echo json_encode(array('status' => '400', 'message' => 'Email của bạn chưa được xác minh!'));
                    }
                } else {
                    echo json_encode(array('status' => '400', 'message' => 'Email không tồn tại ở bất kỳ tài khoản nào!'));
                }
            }
        }
        break;
    case 'verify_code':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $code = mysqli_real_escape_string($db, $_POST['code']);
            if (empty($email)) {
                echo json_encode(array('status' => '400', 'message' => 'Vui lòng nhập email!'));
            } elseif (empty($code)) {
                echo json_encode(array('status' => '400', 'message' => 'Vui lòng nhập mã xác nhận!'));
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('status' => '400', 'message' => 'Email không hợp lệ!'));
            } else {
                $query = "SELECT * FROM member WHERE email='$email' AND `site`='$site'";
                $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results) == 1) {
                    $check = mysqli_query($db, "SELECT * FROM `member` WHERE `email` = '$email' AND `is_verify_mail` = 'true' AND `site`='$site'");
                    if (mysqli_num_rows($check) == 1) {
                        $row = mysqli_fetch_assoc($check);
                        if ($code != $row['is_code_verify_mail']) {
                            echo json_encode(array('status' => '400', 'message' => 'Mã xác nhận không chính xác!'));
                        } else {
                            $pass = incrementalHash(12);
                            $to = $email;
                            $title = "Xác nhận lấy lại mật khẩu";
                            $content = "Mật khẩu mới của tài khoản bạn là: " . $pass . "\nVui lòng đăng nhập và thay đổi mật khẩu ngay lập tức!";
                            $name = $row['hoten'];

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://mlike.vn/module/send_mail.php',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => 'email=' . $to . '&title=' . $title . '&content=' . $content . '&name=' . $name . '',
                                CURLOPT_HTTPHEADER => array(
                                    'Referer: huaducquan',
                                    'Content-Type: application/x-www-form-urlencoded',
                                ),
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $result = json_decode($response);
                            if ($result->status == '200') {
                                mysqli_query($db, "UPDATE `member` SET `password` = '" . md5($pass) . "' WHERE `email` = '$email' AND `site`='$site' AND `is_code_verify_mail` = '0'");
                                echo json_encode(array('status' => '200', 'message' => 'Lấy lại mật khẩu thành công, vui lòng kiểm tra email để lấy mật khẩu mới!'));
                            } else {
                                echo json_encode(array('status' => '400', 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau!'));
                            }
                        }
                    } else {
                        echo json_encode(array('status' => '400', 'message' => 'Email của bạn chưa được xác minh!'));
                    }
                } else {
                    echo json_encode(array('status' => '400', 'message' => 'Email không tồn tại ở bất kỳ tài khoản nào!'));
                }
            }
        }
        break;
}
