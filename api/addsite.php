<?php

require_once('../_System/db.php');
require_once('../module/cloudflare.php');
if (isset($_POST['domain'])) {
    $domain = mysqli_real_escape_string($db, $_POST['domain']);
    if ($row['rule'] < '66') {
        echo "<script>swal('OOPS!','Bạn không phải đại lý nên không thể thực hiện tạo SITE con!','warning');</script>";
    } elseif (empty($_POST['domain'])) {
        echo "<script>swal('OOPS!','Vui lòng nhập Domain!','warning');</script>";
    } elseif (filter_var($domain, FILTER_VALIDATE_URL) == true) {
        echo "<script>swal('OOPS!','Vui lòng tên miền đúng định dạng!','warning');</script>";
    } else {
        $quan = json_decode(cloudflare($domain));
        if ($quan->success == false) {
            echo "<script>swal('OOPS!','Đã xẩy ra lỗi khi thêm tên miền của bạn vui lòng thử lại hoặc liên hệ admin để biết thêm chi tiết!','warning');</script>";
        } else {
            $ns1 = $quan->result->name_servers[0];
            $ns2 = $quan->result->name_servers[1];
            $t = count($quan->result->original_name_servers);
            $ne = '';
            for ($i = 0; $i <= ($t - 1); $i++) {
                $ne .= $quan->result->original_name_servers[$i];
            }
            $nsgoc = $ne;
            $domain = $quan->result->name;
            $time = time();
            $zone = $quan->result->id;
            $addzone = cloudflare_dns($zone, $domain);
            if ($addzone) {
                $api = new bt_api();
                $api->domain = $domain;
                $r_data = $api->GetLogs();
            }
            mysqli_query($db, "INSERT INTO `sitecon` (`user`, `noti`, `ck`, `notick`, `notiref`, `minref`, `ckref`, `idfb`, `site`, `ns1`, `ns2`, `nsgoc`, `trangthai`, `time`) VALUES ('$login', '', '', '', '', '', '', '', '$domain', '$ns1', '$ns2', '$nsgoc', '1', '$time')");
            $chec = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '$login' AND `site` = '$site'");
            $check = mysqli_num_rows($chec);
            if($check == 0) {
                mysqli_query($db, "INSERT INTO `setgia` (`id`, `fbl_1`, `fbl_2`, `fbl_3`, `fbl_4`, `fbl_5`, `fbl_6`, `fbl_7`, `fbl_8`, `fblv2_1`, `fblv2_2`, `fblv2_3`, `fblv2_4`, `fbcx_1`, `fbcx_2`, `fbcmt_1`, `fblikecmt_1`, `fblikecmt_2`, `fbshare_1`, `fbshare_2`, `fbshare_3`, `fblive_1`, `fblive_2`, `fblive_3`, `fblive_4`, `fbview_1`, `fbview_2`, `fbfollow_1`, `fbfollow_2`, `fbfollow_3`, `fbfollow_4`, `fbfollow_5`, `fbfollow_6`, `fbfollow_7`, `fbfollow_8`, `fbfollow_9`, `fbfollow_10`, `fbpage_1`, `fbpage_2`, `fbpage_3`, `fbpage_4`, `fbgroup_1`, `fbgroup_2`, `fbgroup_3`, `fbviplike_1`, `fbstory_1`, `iglike_1`, `iglike_2`, `iglike_3`, `igfollow_1`, `igfollow_2`, `igfollow_3`, `igview_1`, `igview_2`, `igcmt_1`, `ttlike_1`, `ttlike_2`, `ttlike_3`, `ttfollow_1`, `ttfollow_2`, `ttview_1`, `ttview_2`, `ttview_3`, `ttlive_1`, `ttshare_1`, `ttcmt_1`, `otweb_1`, `ytbview_1`, `ytbview_2`, `ytbview_3`, `ytbsub_1`, `ytbsub_2`, `ytblike_1`, `user`, `site`) VALUES (NULL, '8', '12', '19', '20', '22', '22', '6', '7', '5', '7', '9', '12', '12', '11', '50', '30', '50', '150', '10', '400', '4', '1.5', '2.5', '1.8', '7', '19', '28', '22', '17', '100', '100', '100', '100', '23', '17', '15', '45', '38', '15', '30', '50', '40', '25', '7', '10', '50', '15', '13', '92', '15', '20', '6', '2', '500', '20', '25', '20', '50', '60', '0.8', '5', '1', '100', '80', '800', '20', '34', '45', '30', '700', '800', '100', '$login', 'mlike.vn')");
            }
            $chec = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$login' AND `site` = '$site'");
            $si = mysqli_fetch_assoc($chec);
            $user = $si['username'];
            $pass = $si['password'];
            mysqli_query($db, "INSERT INTO `member` (`id`, `password`, `username`, `idfb`, `hoten`, `sdt`, `email`, `rule`, `vnd`, `sd`, `active`, `mgt`, `vndgt`, `ref`, `otp`, `very`, `time`, `last_ip_login`, `browse`, `last_time_login`, `site`) VALUES (NULL, '$pass', '$user', '4', '', '', '', '99', '0', '0', '1', '88888888', '0', '0', '0', '0', '$time', '1.1.1.1', '0', '$time', '$domain')");
            mysqli_query($db, "INSERT INTO `gia_sitecon` (`id`, `fbl_1`, `fbl_2`, `fbl_3`, `fbl_4`, `fbl_5`, `fbl_6`, `fbl_7`, `fbl_8`, `fblv2_1`, `fblv2_2`, `fblv2_3`, `fblv2_4`, `fbcx_1`, `fbcx_2`, `fbcmt_1`, `fblikecmt_1`, `fblikecmt_2`, `fbshare_1`, `fbshare_2`, `fbshare_3`, `fblive_1`, `fblive_2`, `fblive_3`, `fblive_4`, `fbview_1`, `fbview_2`, `fbfollow_1`, `fbfollow_2`, `fbfollow_3`, `fbfollow_4`, `fbfollow_5`, `fbfollow_6`, `fbfollow_7`, `fbfollow_8`, `fbfollow_9`, `fbfollow_10`, `fbpage_1`, `fbpage_2`, `fbpage_3`, `fbpage_4`, `fbgroup_1`, `fbgroup_2`, `fbgroup_3`, `fbviplike_1`, `fbstory_1`, `iglike_1`, `iglike_2`, `iglike_3`, `igfollow_1`, `igfollow_2`, `igfollow_3`, `igview_1`, `igview_2`, `igcmt_1`, `ttlike_1`, `ttlike_2`, `ttlike_3`, `ttfollow_1`, `ttfollow_2`, `ttview_1`, `ttview_2`, `ttview_3`, `ttlive_1`, `ttshare_1`, `ttcmt_1`, `otweb_1`, `ytbview_1`, `ytbview_2`, `ytbview_3`, `ytbsub_1`, `ytbsub_2`, `ytblike_1`, `site`) VALUES (NULL, '10', '100', '100', '100', '100', '24', '6', '7', '5', '7', '9', '15', '100', '100', '100', '30', '50', '100', '100', '100', '100', '100', '2.5', '1.8', '100', '15', '100', '100', '100', '100', '100', '100', '100', '23', '17', '15', '100', '100', '100', '30', '100', '100', '100', '100', '100', '100', '100', '20', '100', '100', '100', '1', '1', '500', '100', '19', '20', '100', '20', '100', '5', '1', '100', '80', '800', '100', '45', '70', '30', '700', '800', '100', '$domain')
            ");

            echo "<script>swal('OOPS!','Tạo SITE con thành công vui lòng trỏ NS theo hướng dẫn','success');</script>";
            echo '<script>setTimeout(function(){
                window.location="' . $r . '";
            }, 3000);</script>';
        }
    }
}
