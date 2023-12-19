<?
$hdq = "ok";
$page = 'group_fb';
require_once('../../../_System/db.php');
require_once('../../../module/autofbpro.php');
require_once('../../../module/telegram.php');
require_once('../../../module/tlc.php');
$min = '1000';
$max = '20000';
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
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
                $result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `user` = '" . $login . "' AND `dv` = 'fb_group' ORDER BY id DESC LIMIT $limit");
                while ($ro = mysqli_fetch_assoc($result1)) {
                    if ($_GET['type'] == 'id_order') {
                        $id = $ro['id'];
                    } else {
                        $id = $ro['profile'];
                    }
                    $sl = $ro['sl'];
                    $done = $ro['done'];
                    $start = $ro['idgd'];
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
                $check = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv`='fb_group' AND `id` = '$id_order' AND `user` = '$login' AND `trangthai` = '7' AND `nse` = 'Server Group 4'");
                $c = mysqli_num_rows($check);
                if ($c == '1') {
                    $get = mysqli_fetch_assoc($check);
                    $sotien = $get["sotien"];
                    $time = time();
                    $dd = $row['vnd'];
                    $nd1 = 'Hoàn tiền mua member group facebook ID (' . $id_order . '):';
                    $gtls = '+';
                    $bd = $sotien;
                    $array["status"] = 'success';
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                    mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '8' WHERE `id` = '$id_order' AND `dv` = 'fb_group'");
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
                    $gt = time();
                    $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
                    $tko = mysqli_num_rows($tko);
                    if ($tko == 1) {
                        $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                        $u = mysqli_fetch_assoc($u);
                        $dis = $u['dis'];
                        if ($sv == 1) {
                            $tongtien = ($sl * $gia1) - (($sl * $gia1) / 100 * $dis);
                            $nse = 'Server Group 1';
                        } elseif ($sv == 2) {
                            $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                            $nse = 'Server Group 2';
                        } elseif ($sv == 3) {
                            $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                            $nse = 'Server Group 3';
                        } elseif ($sv == 4) {
                            $tongtien = ($sl * $gia4) - (($sl * $gia4) / 100 * $dis);
                            $nse = 'Server Group 4';
                        }
                    } else {

                        if ($sv == 1) {
                            $tongtien = ($sl * $gia1);
                            $nse = 'Server Group 1';
                        } elseif ($sv == 2) {
                            $tongtien = ($sl * $gia2);
                            $nse = 'Server Group 2';
                        } elseif ($sv == 3) {
                            $tongtien = ($sl * $gia3);
                            $nse = 'Server Group 3';
                        } elseif ($sv == 4) {
                            $tongtien = ($sl * $gia4);
                            $nse = 'Server Group 4';
                        }
                    }
                }
                if (empty($id)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số ID Group Facebook!';
                } elseif (empty($sl)) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng nhập số lượng Memner!';
                } elseif ($sl < $min) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
                } elseif ($sl > $max) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Số lượng tối đa ' . $max . '!';
                } elseif ($row['vnd'] < $tongtien) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Bạn không đủ tiền!';
                } else {
                    if ($sv == 1) {
                        $send_tlc = json_decode(tlc_memgroup($id, $sl));
                        if ($send_tlc->success == 'true') {
                            $nd1 = 'Tăng Member Group Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_group',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '2', `nse` = '$nse', `idgd` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Member Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại hoặc liên hệ admin!!';
                        }
                    } elseif ($sv == 2 || $sv == 3) {
                        $buff = group("$id", "$sl", "$sv");
                        $buff = json_decode($buff);
                        if ($buff->status == 200) {
                            $nd1 = 'Tăng Member Group Facebook ID:';
                            $bd = $tongtien;
                            $gt = '-';
                            $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                            $goc = $row['vnd'];
                            $time = time();
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_group',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '2', `nse` = '$nse', `idgd` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua Member Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = '' . $buff->message . '';
                        }
                    } elseif ($sv == 4) {
                        $cres = mysqli_query($db, "SELECT sum(`sl`) FROM `dv_other` WHERE `dv` = 'fb_group' AND `nse` = 'Server Group 4' AND `profile` = '$id'");
                        $crow = mysqli_fetch_row($cres);
                        $lcheckl = $crow[0];
                        $lcheck = $lcheckl + $sl;
                        $mcheck = 20000 - $lcheckl;
                        if ($lcheck > '20000') {
                            $array["status"] = 'error';
                            $array["msg"] = 'Số lượng tối đa của 1 ID có thể mua là 20000 Member (Bạn có thể mua thêm ' . $mcheck . ' Member cho ID này!) hoặc bạn đã spam nhiều lần vui lòng dùng server khác';
                        } else {
                            $tg = date("G:i:s d/m/Y", time());
                            $send_tlc = json_decode(telegram_send('32075', '<b>***Bạn vừa có một đơn hàng Member Group Facebook Mới***</b>%0A- ID: <a href="https://facebook.com/' . $id . '">' . $id . '</a>%0A- Số lượng: ' . $sl . ' Member%0A- Người mua: <a href="https://mlike.vn/admin/user.php?edit=' . $login . '">' . $login . '</a>%0A- Thời Gian: ' . $tg . '%0A- Để kiểm tra vui lòng: <a href="https://mlike.vn/service/group.php">ấn vào đây</a>%0A(<b>QBOT Notification</b>)'));
                            if ($send_tlc->ok == 'true') {
                                $nd1 = 'Tăng Member Group Facebook ID:';
                                $bd = $tongtien;
                                $gt = '-';
                                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                                $goc = $row['vnd'];
                                $time = time();
                                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_group',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '2', `nse` = '$nse', `idgd` = '0'");
                                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                                $array["status"] = 'success';
                                $array["msg"] = 'Mua Member Thành Công! Cảm ơn bạn!!';
                                $r = mysqli_query($db, "SELECT * FROM `dv_other` ORDER BY `dv_other`.`id` DESC");
                                $rr = mysqli_fetch_assoc($r);
                                $array["id_order"] = $rr['id'];
                            } else {
                                $array["status"] = 'error';
                                $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại hoặc liên hệ admin!!';
                            }
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi Server Tăng Member Không Đúng!';
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
