<?php
require_once('../vendor/autoload.php');
function sendMail($to, $name, $subject, $content)
{

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Cấu hình để sử dụng SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';  // Thay thế bằng địa chỉ SMTP của bạn
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@mlike.vn';  // Thay thế bằng tên đăng nhập của bạn
    $mail->Password = '60ae4a09e49884453be9d590457a8b79-5d2b1caa-3afd7f39';  // Thay thế bằng mật khẩu của bạn
    $mail->SMTPSecure = 'tls';  // Có thể sử dụng 'ssl' hoặc 'tls'
    $mail->Port = 587;  // Thay thế bằng cổng SMTP của bạn

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
        return json_encode(array('status' => 'success', 'message' => 'Email sent!'));
    } else {
        return json_encode(array('status' => 'failed', 'message' => 'Something went wrong: ' . $mail->ErrorInfo));
    }
}

function checkMail($email)
{
    $curl = curl_init();
    $data = [
        'email' => $email,
    ];
    $post_data = http_build_query($data);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.disify.com/api/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post_data,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
