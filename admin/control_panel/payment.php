<?php
function CheckFileExist($username)
{
    $username = strtolower($username);
    if (file_exists("$username.json")) {
        return true;
    } else {
        return false;
    }
}
if (CheckFileExist('payment')) {
    header("location: https://mlike.vn/admin/control_panel/index.php?status=success&message=Thanh toán thành công, hệ thống đang tối ưu lại hết thống file mlike.vn trong vòng 24h");
} else {
    header("location: https://mlike.vn/admin/control_panel/index.php?status=error&message=Thanh toán thất bại, vui lòng liên hệ admin để được hỗ trợ");
}
