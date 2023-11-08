<?
$hdq = 'ok';
$page = "like_fb";
require_once('../../../_System/db.php');
include('../../../module/mfb.php');
include('../../../module/tds.php');
include('../../../module/tlc.php');
include('../../../module/autocc.php');
include('../../../module/liketds.php');
include('../../../module/baostar.php');
include('../../../module/autofb88.php');
require_once('../../../module/telegram.php');
require_once('../../../module/facebook.php');
require_once('../../../module/subgiare.php');
$tokena = file_get_contents('https://huaducquan.id.vn/mlike/tokenfb.txt');
$tokena = explode("\n", $tokena);
$ctoken = count($tokena);
$tokenn = $ctoken - 1;
$tokenf = rand(0, $tokenn);
$tokenfb = $tokena[$tokenf];
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
switch ($_GET["act"]) {
    case 'history':
        if (isset($_POST['token']) && isset($_POST['limit'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Like' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['id'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['bh'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['sve'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["$id"]["id"] = "$profile";
                    $array["data"]["$id"]["number"] = "$sl";
                    $array["data"]["$id"]["start"] = "$start";
                    $array["data"]["$id"]["done"] = "$done";
                    $array["data"]["$id"]["server"] = "$sv";
                    $array["data"]["$id"]["user"] = "$user";
                    $array["data"]["$id"]["time"] = "$t";
                    $array["data"]["$id"]["status"] = "$tt";
                    $array["data"]["$id"]["id_order"] = $ro['id'];
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;
    case 'history_id':
        if (isset($_POST['token']) && isset($_POST['limit']) && isset($_POST['id'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `user` = '" . $login . "' AND `dv` = 'Like' AND `id` = '$id' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['id'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['bh'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['sve'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $array["data"]["id"] = "$profile";
                    $array["data"]["number"] = "$sl";
                    $array["data"]["start"] = "$start";
                    $array["data"]["done"] = "$done";
                    $array["data"]["server"] = "$sv";
                    $array["data"]["user"] = "$user";
                    $array["data"]["time"] = "$t";
                    $array["data"]["status"] = "$tt";
                    $array["data"]["id_order"] = $ro['id'];
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;

    case 'cancel_order':
        if (isset($_POST['token']) && isset($_POST['id_order'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $id_order = mysqli_real_escape_string($db, $_POST['id_order']);
            $done = mysqli_real_escape_string($db, $_POST['done']);
            $status = mysqli_real_escape_string($db, $_POST['status']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $check = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv`='Like' AND `id` = '$id_order' AND `user` = '$login' AND `trangthai` = '7'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $sotien = $get["sotien"];
                    $time = time();
                    $dd = $row['vnd'];
                    $nd1 = 'Hoàn tiền mua like facebook ID (' . $id_order . '):';
                    $gtls = '+';
                    $bd = $sotien;
                    $array["status"] = 'success';
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '8' WHERE `id` = '$id_order' AND `dv` = 'Like'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$sotien' WHERE `username` = '$login'");
                    $array["msg"] = 'Hủy và hoàn tiền đơn hàng ' . $id_order . ' thành công!';
                    $array["sotien"] = $bd;
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại, hoặc trạng thái đơn không hợp lệ để hủy!';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;
    default:
        if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv'])) {
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $sl = mysqli_real_escape_string($db, $_POST['sl']);
            $sv = mysqli_real_escape_string($db, $_POST['sv']);
            $cd = mysqli_real_escape_string($db, $_POST['gift']);
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if (isset($cd)) {
                    if (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                        $get_id = json_decode(getid($id));
                        if ($get_id->success == 200) {
                            $id = $get_id->id;
                        } else {
                            echo '{"status":"error","msg":"Đã xảy ra lỗi khi phân tích ID Post, vui lòng thử lại"}';
                            exit();
                        }
                    }
                    $gt = time();
                    $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
                    $tko = mysqli_num_rows($tko);
                    if ($tko == 1) {
                        $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                        $u = mysqli_fetch_assoc($u);
                        $dis = $u['dis'];
                        if ($sv == 1) {
                            $tongtien = ($sl * $gia1) - (($sl * $gia1) / 100 * $dis);
                        } elseif ($sv == 2) {
                            $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                        } elseif ($sv == 3) {
                            $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                        } elseif ($sv == 4) {
                            $tongtien = ($sl * $gia4) - (($sl * $gia4) / 100 * $dis);
                        } elseif ($sv == 5) {
                            $tongtien = ($sl * $gia5) - (($sl * $gia5) / 100 * $dis);
                        } elseif ($sv == 6) {
                            $tongtien = ($sl * $gia6) - (($sl * $gia6) / 100 * $dis);
                        } elseif ($sv == 7) {
                            $tongtien = ($sl * $gia7) - (($sl * $gia7) / 100 * $dis);
                        } elseif ($sv == 8) {
                            $tongtien = ($sl * $gia8) - (($sl * $gia8) / 100 * $dis);
                        } elseif ($sv == 9) {
                            $tongtien = ($sl * $gia9) - (($sl * $gia9) / 100 * $dis);
                        } elseif ($sv == 10) {
                            $tongtien = ($sl * $gia10) - (($sl * $gia10) / 100 * $dis);
                        } elseif ($sv == 11) {
                            $tongtien = ($sl * $gia11) - (($sl * $gia11) / 100 * $dis);
                        } elseif ($sv == 12) {
                            $tongtien = ($sl * $gia12) - (($sl * $gia12) / 100 * $dis);
                        }
                    } else {
                        if ($sv == 1) {
                            $tongtien = $sl * $gia1;
                        } elseif ($sv == 2) {
                            $tongtien = $sl * $gia2;
                        } elseif ($sv == 3) {
                            $tongtien = $sl * $gia3;
                        } elseif ($sv == 4) {
                            $tongtien = $sl * $gia4;
                        } elseif ($sv == 5) {
                            $tongtien = $sl * $gia5;
                        } elseif ($sv == 6) {
                            $tongtien = $sl * $gia6;
                        } elseif ($sv == 7) {
                            $tongtien = $sl * $gia7;
                        } elseif ($sv == 8) {
                            $tongtien = $sl * $gia8;
                        } elseif ($sv == 9) {
                            $tongtien = $sl * $gia9;
                        } elseif ($sv == 10) {
                            $tongtien = $sl * $gia10;
                        } elseif ($sv == 11) {
                            $tongtien = $sl * $gia11;
                        } elseif ($sv == 12) {
                            $tongtien = $sl * $gia12;
                        }
                    }
                }
                if ($sv == '1') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min1']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min1'] . ' Like';
                    } elseif ($sl > $s['max1']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $s['max1'] . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } elseif (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng sử dụng ID Post không sử dụng LINK!';
                    } else {
                        $quan = $s['tds_or_xule'];
                        $t = $s['tlc'];
                        if ($quan == 'tds') {
                            $nd1 = 'Mua Like Bài Viết ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(1) ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            $user = $s['user'];
                            $pass = $s['pass'];
                            $login_tds = json_decode(login($user, urlencode($pass)));
                            if ($login_tds->success == 'true') {
                                $date_create =  date("Y-m-d H:i:s");
                                $send_api = send_tds(trim($id), trim($sl), 'hdq1', $date_create);
                                if (strpos($send_api, 'nh công') !== false) {
                                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1', `site` = '$site'");
                                    $sve = 'Server Like 1';
                                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '1', `bh`='1', `sttdone` = '0'");
                                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                    $array["status"] = 'success';
                                    $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                    $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                                    $rr = mysqli_fetch_assoc($r);
                                    $array["id_order"] = $rr['id'];
                                } else {
                                    $array["status"] = 'error';
                                    $array["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                                }
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Lỗi server tăng like vui lòng liên hệ admin!!';
                            }
                        } elseif ($quan == 'xule') {

                            $nd1 = 'Mua Like Bài Viết ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(1) ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 1';
                            $cod = rand(1000, 999999999);
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `code` = '$cod', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '1', `bh`='19', `sttdone` = '0', `iddon` = '2005'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } elseif ($quan == 'bao') {
                            $quann = json_decode(baostar($id, $sl));
                            if ($quann->status == '200') {
                                $nd1 = 'Mua Like Bài Viết ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                $sve = 'Server Like 1';
                                $cod = rand(1000, 999999999);
                                mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '2', `code` = '$cod', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '$sl', `nse` = '1', `bh`='1', `sttdone` = '0', `iddon` = '2005'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $quann->message . '';
                            }
                        } elseif ($quan == 'tlc') {
                            $send_tlc = json_decode(sv2_7d($id, $sl, $t));
                            if ($send_tlc->success == 'true') {
                                $nd1 = 'Mua Like Bài Viết ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(1) ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                $sve = 'Server Like 1';
                                $cod = rand(1000, 999999999);
                                mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `code` = '$cod', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='98', `sttdone` = '0', `iddon` = '2005'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = '' . $send_tlc->message . '';
                            }
                        }
                    }
                } elseif ($sv == '2') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min2'] . ' Like';
                    } elseif ($sl > $s['max2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải NHỎ hơn ' . $s['max2'] . ' Like';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(2) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        if ($s['tlc6_or_tlc10'] == 'tlc6') {
                            $send_tlc = json_decode(sv2_low($id, $sl, $t));
                        } elseif ($s['tlc6_or_tlc10'] == 'tlc10') {
                            $send_tlc = json_decode(sv2($id, $sl, $t));
                        }
                        if ($send_tlc->success == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 2';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '5') {

                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min2'] . ' Like';
                    } elseif ($sl > $s['max2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $s['max2'] . ' Like!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(5) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        $send_tlc = json_decode(sv2_speed($id, $sl, $t));
                        if ($send_tlc->success == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 5';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '3') {

                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min3']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min3'] . ' Like';
                    } elseif ($sl > $s['max3']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $s['max3'] . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(3) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $user = $s['user'];
                        $pass = $s['pass'];
                        $login_tds = json_decode(login($user, urlencode($pass)));
                        if ($login_tds->success == 'true') {
                            $date_create =  date("Y-m-d H:i:s");
                            $send_api = send_tds(trim($id), trim($sl), 'hdq3', $date_create);
                            if (strpos($send_api, 'nh công') !== false) {
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                                $sve = 'Server Like 3';
                                mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '3', `bh`='2', `sttdone` = '0'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                            }
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Lỗi server tăng like vui lòng liên hệ admin!!';
                        }
                    }
                } elseif ($sv == '4') {
                    $cres = mysqli_query($db, "SELECT sum(`sl`) FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '444' AND `profile` = '$id'");
                    $crow = mysqli_fetch_row($cres);
                    $lcheckl = $crow[0];
                    $lcheck = $lcheckl + $sl;
                    $mcheck = 3000 - $lcheckl;
                    $fbapi = json_decode(file_get_contents("https://graph.facebook.com/$id?fields=likes.summary(true)&access_token=" . $tokenfb));
                    $fbapi = $fbapi->likes->summary->total_count;
                    $check_order_count = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '444' AND `profile` = '$id'");
                    $check_order_count = mysqli_num_rows($check_order_count);
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min4']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min4'] . ' Like';
                    } elseif ($sl > $s['max4']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $s['max4'] . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
                    } elseif ($lcheck > '3000') {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa của 1 ID có thể mua là 3000 Like (Bạn có thể mua thêm ' . $mcheck . ' Like cho ID nay)!';
                    } elseif ($check_order_count >= 1) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn chỉ được phép mua tối đa mỗi ID 1 đơn, vui lòng mua cho ID khác!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } elseif ($sv4 == 'off') {
                        $array["status"] = 'error';
                        $array["msg"] = 'Server quá tải vùi lòng thử lại sau 12h trưa hoặc dùng server khác ';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(4) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();

                        //start send mail

                        $tg = date("G:i:s d/m/Y", time());
                        $send_tele = telegram_send('', '<b>***Bạn vừa có một đơn hàng Like Facebook Mới***</b>%0A- ID: <a href="https://www.facebook.com/' . $id . '">' . $id . '</a>%0A- Số lượng: ' . $sl . ' Like%0A- Người mua: <a href="https://mlike.vn/admin/user.php?edit=' . $login . '">' . $login . '</a>%0A- Thời Gian: ' . $tg . '%0A- Để kiểm tra vui lòng: <a href="https://mlike.vn/admin/like_sv4.php">ấn vào đây</a>%0A(<b>QBOT Notification</b>)');
                        $send_tele = json_decode($send_tele);
                        if ($send_tele->ok == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like Tay';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '444', `bh`='$fbapi', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại 100!!';
                        }
                    }
                } elseif ($sv == '6') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min2'] . ' Like';
                    } elseif ($sl > $s['max2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải NHỎ hơn ' . $s['max2'] . ' Like';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(6) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        $send_tlc = json_decode(sv2_re($id, $sl));
                        if ($send_tlc->success == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 6';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '7') {
                    require_once('../../../module/autofbpro.php');
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min2'] . ' Like';
                    } elseif ($sl > $s['max2']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải NHỎ hơn ' . $s['max2'] . ' Like';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(7) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $send_tlc = json_decode(autofb_like($id, $sl));
                        if ($send_tlc->status == '200') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 7';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '7', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '8') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < $s['min1']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min4'] . ' Like';
                    } elseif ($sl > $s['max1']) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa ' . $s['max4'] . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(8) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $send_tlc = json_decode(sv2_7d($id, $sl, $t));
                        if ($send_tlc->success == 'true') {
                            $nd1 = 'Mua Like Bài Viết ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(1) ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 8';
                            $cod = rand(1000, 999999999);
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `code` = '$cod', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='98', `sttdone` = '0', `iddon` = '2005'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '9') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < 100) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn 100 Like';
                    } elseif ($sl > 100000) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa 100K Like!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(9) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        $send_tlc = json_decode(likett88($id, $sl));
                        if ($send_tlc->status == '200') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 9';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '10') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < 100) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn 100 Like';
                    } elseif ($sl > 100000) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng tối đa 100K Like!';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(10) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $send_tlc = json_decode(mfb_like($id, $sl));
                        if ($send_tlc->status == '200') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 10';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '11') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < 100) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn 100 Like';
                    } elseif ($sl > 10001) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải NHỎ hơn 10000 Like';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(11) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        $send_tlc = json_decode(sv2_re($id, $sl));
                        if ($send_tlc->success == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 11';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } elseif ($sv == '12') {
                    if (empty($id)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
                    } elseif (empty($sl)) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Vui lòng nhập số lượng Like!';
                    } elseif ($sl < 100) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải lớn hơn 100 Like';
                    } elseif ($sl > 100000) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Số lượng phải NHỎ hơn 100.000 Like';
                    } elseif ($row['vnd'] < $tongtien) {
                        $array["status"] = 'error';
                        $array["msg"] = 'Bạn không đủ tiền!';
                    } else {
                        $nd1 = 'Mua Like Bài Viết ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(12) ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        $t = $s['tlc'];
                        $send_tlc = json_decode(sgr_likenew($id, $sl));
                        if ($send_tlc->status == 'true') {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            $sve = 'Server Like 12';
                            mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sve` = '$sve', `sotien` = '$tongtien', `done` = '0', `nse` = '2', `bh`='1', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                            $r = mysqli_query($db, "SELECT * FROM `dichvu` ORDER BY `dichvu`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $send_tlc->message . '';
                        }
                    }
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng chọn Server Like và thử lại!';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Token không tồn tại!';
            }
            echo json_encode($array);
        } else {
            echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
        }
        break;
}
