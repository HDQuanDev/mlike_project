<?php

require_once('../_System/db.php');
require '../vendor/autoload.php';
if (isset($login)) {
    function sendMail($to, $name, $subject, $content)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.mailgun.org';  // Thay thế bằng địa chỉ SMTP của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@mlike.vn';  // Thay thế bằng tên đăng nhập của bạn
        $mail->Password = '60ae4a09e49884453be9d590457a8b79-5d2b1caa-3afd7f39';  // Thay thế bằng mật khẩu của bạn
        $mail->SMTPSecure = 'tls';  // Có thể sử dụng 'ssl' hoặc 'tls'
        $mail->Port = 587;  // Thay thế bằng cổng SMTP của bạn
        $mail->CharSet = 'UTF-8';
        // Địa chỉ email của người gửi
        $mail->setFrom('no-reply@mlike.vn', 'MLIKE Support');

        // Địa chỉ email của người nhận
        $mail->addAddress($to, $name);
        $mail->addReplyTo('hdquandev@qdevs.tech', 'HDQuanDev');
        // Tiêu đề email
        $mail->Subject = $subject;

        // Nội dung email
        $mail->Body = $content;

        // Kiểm tra xem email có được gửi thành công hay không
        if ($mail->send()) {
            return json_encode(array('status' => '200', 'message' => 'Đã gửi email, vui lòng kiểm tra hộp thư đến/spam để lấy code xác nhận!'));
        } else {
            return json_encode(array('status' => '400', 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau!'));
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $code = rand(100000, 999999);
        if (empty($email) || empty($name)) {
            echo json_encode(array('status' => '400', 'message' => 'Vui lòng nhập đầy đủ thông tin!'));
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('status' => '400', 'message' => 'Địa chỉ email không hợp lệ!'));
        } else {
            $content = 'Bạn đang thực hiện xác minh địa chỉ email trên hệ thống MLIKE, để xác minh email này hãy nhập mã xác nhận của bạn là: ' . $code;
            mysqli_query($db, "UPDATE `member` SET `is_code_verify_mail` = '$code' WHERE `username` = '$login'");
            echo sendMail($email, $name, 'Xác minh địa chỉ email của bạn', $content);
        }
    }
}
