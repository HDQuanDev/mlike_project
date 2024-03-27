<?php

$hdq = "ok";
$page = 'tim_tt_tay';
require_once('../../../_System/config.php');
require_once('../../../_System/db.php');
require_once('../../../module/tiktok.php');
$gia = $gia1;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
$array = [];
switch ($_GET['act']) {
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
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'tiktok_like_tay' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['profile'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['iddon'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
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
    case 'getlist':
        if (isset($_POST['token']) && isset($_POST['limit'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $limit = mysqli_real_escape_string($db, $_POST['limit']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `rule` = '99' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $array["status"] = 'success';
                $quan = [];
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like_tay' AND `trangthai` != '2' AND `trangthai` != '4' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    $id = $ro['cmt'];
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['iddon'];
                    $profile = $ro['profile'];
                    $tt = $ro['trangthai'];
                    $sv = $ro['nse'];
                    $user = $ro['user'];
                    $t = $ro['time'];
                    $quan["id"] = "$id";
                    $quan["number"] = "$sl";
                    $quan["start"] = "$start";
                    $quan["done"] = "$done";
                    $quan["server"] = "$sv";
                    $quan["user"] = "$user";
                    $quan["time"] = "$t";
                    $quan["status"] = "$tt";
                    $quan["id_order"] = $ro['id'];
                    $array["data"][] = $quan;
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
    case 'updatedata':
        if (isset($_POST['token']) && isset($_POST['id_order'])) {
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $id_order = mysqli_real_escape_string($db, $_POST['id_order']);
            $done = mysqli_real_escape_string($db, $_POST['done']);
            $status = mysqli_real_escape_string($db, $_POST['status']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `rule` = '99' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                $check = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv`='tiktok_like_tay' AND `id` = '$id_order'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $array["status"] = 'success';
                    mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done', `trangthai` = '$status' WHERE `id` = '$id_order' AND `dv` = 'tiktok_like_tay'");
                    $array["msg"] = 'Update thành công!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID_ORDER không tồn tại!';
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
            $token = mysqli_real_escape_string($db, $_POST['token']);
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $row = mysqli_fetch_assoc($uu);
                $login = $row['username'];
                if ($sv == 1) {
                    $tongtien = $sl * $gia1;
                    $nse = 'Server Like 1';
                    $min = 300;
                    $max = 100000;
                }
                if (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                    $tt = json_decode(check_tt($id, "view"));
                    $ttid = $tt->id;
                    $ttview = $tt->tim;
                    $ttlink = $tt->link;
                    $usertt = $tt->user;
                } else {
                    $ttid = $id;
                    $ttview = '0';
                }
                $lim = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$ttid' AND `dv` = 'tiktok_like_tay' AND (`trangthai` = '1' OR `trangthai` = '3')");
                $lim = mysqli_num_rows($lim);
                $ma = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like_tay' AND (`trangthai` = '1' OR `trangthai` = '3')");
                $ma = mysqli_num_rows($ma);
                $utt = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like_tay' AND `bh` = '$usertt' AND (`trangthai` = '1' OR `trangthai` = '3')");
                $utt = mysqli_num_rows($utt);
                if (empty($id)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số ID!';
                } elseif (empty($sl)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số lượng!';
                } elseif ($sl < $min) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
                } elseif ($sl > $max) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng tối đa ' . $max . '!';
                } elseif ($lim > 0) {
                    $array["status"] = 'error';
                    $array["msg"] = 'ID này đang chạy, vui lòng chờ hoàn thành để mua tiếp!';
                } elseif ($utt > 0) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Đang có 1 Video thuộc user '.$usertt.' đang chạy, vui lòng chờ hoàn thành và tiếp tục!';
                } elseif ($sv1 == 'off') {
                    $array["status"] = 'error';
                    $array["msg"] = 'Hệ thống đang quá tải, vui lòng thử lại sau!';
                } elseif ($row['vnd'] < $tongtien) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Bạn không đủ tiền!';
                } else {
                    if ($sv == 1) {
                        if ($tt->success == '200') {
                            $nd1 = '(1) Tăng Tim TikTok V2 ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_like_tay',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttlink', `iddon` = '$ttview', `bh` = '$usertt'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                            $rr = mysqli_fetch_assoc($r);
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Tim Thành Công! Cảm ơn bạn!!';
                            $array["id_order"] = $rr['id'];
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Lỗi link tăng like vui lòng kiểm tra link và thử lại!';
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi Server Tăng Tim Không Đúng!';
                    }
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
